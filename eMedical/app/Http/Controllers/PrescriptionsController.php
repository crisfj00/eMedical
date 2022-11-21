<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use PDF;

/**
 * Class PrescriptionController
 * @package App\Http\Controllers
 */
class PrescriptionsController extends Controller
{

    public function fetchDoctors(Request $request)
    {
        $data['doctors'] = Doctor::where("specialty",$request->specialty)->get(["id"]);

        foreach ($data['doctors'] as $doctor) {   
            $aux=Doctor::where("id",$doctor->id)->first();
            $user=User::where("email",$aux->email)->get('name')->first();
            $doctor->push('name',$user->name);
        }
        
        //$data['doctors'] = Doctor::select('doctors.*')->join('users', 'users.email', '=', 'doctors.email')->where('doctor.specialty', $request->specialty)->get(["doctors.id, users.name"]);

        return response()->json($data);
    }

    public function downloadPDF($id)
    {

        $pat=Patient::where('email',Auth::user()->email)->get()->first();
    
        $prescription = Prescription::where('id',$id)->where('patient_id',$pat->id)->get()->first();

        if($prescription!=null){
  
            $pdf = PDF::loadView('prescription.pdf', compact('prescription') );
            return $pdf->download('prescription.pdf');
        }

        else
            return redirect()->route('prescriptions.index');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->isDoctor()){
            $doc=Doctor::where('email',Auth::user()->email)->get()->first();
            $prescriptions = Prescription::where('doctor_id',$doc->id)->orderBy('state','asc')->paginate(5);
        }

        else if (Auth::user()->isPatient()){

            $pat=Patient::where('email',Auth::user()->email)->get()->first();
            $prescriptions = Prescription::where('patient_id',$pat->id)->orderBy('state','desc')->paginate(5);
        }

        return view('prescription.index', compact('prescriptions'))
            ->with('i', (request()->input('page', 1) - 1) * $prescriptions->perPage());
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prescription = new Prescription();
        $specialties = Doctor::select('specialty')->distinct()->get();

        return view('prescription.create', compact('prescription','specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $patient= Patient::where('email',Auth::user()->email)->get()->first();

        $prescription = Prescription::create([
            'patient_id' => $patient->id,
            'doctor_id'  => $request->doctor_id,
            'consultation' => $request->consultation,
            'diagnosis' => '',
            'state' => 0
        ]);


        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prescription = Prescription::find($id);

        if($prescription==null)
            return redirect('prescriptions');
        else{
            if(Auth::user()->isPatient()){
                $pat=Patient::where("email",Auth::user()->email)->get()->first();
                if($prescription->patient_id != $pat->id)
                return redirect('prescriptions');
            }
            else if(Auth::user()->isDoctor()){
                $doc=Doctor::where("email",Auth::user()->email)->get()->first();
                if($prescription->doctor_id != $doc->id)
                return redirect('prescriptions');      
            }
        }

        return view('prescription.show', compact('prescription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prescription = Prescription::find($id);

        if($prescription==null)
         return redirect('prescriptions');
        else{
            if(Auth::user()->isPatient()){
                $pat=Patient::where("email",Auth::user()->email)->get()->first();
                if($prescription->patient_id != $pat->id)
                return redirect('prescriptions');
            }
            else if(Auth::user()->isDoctor()){
                $doc=Doctor::where("email",Auth::user()->email)->get()->first();
                if($prescription->doctor_id != $doc->id)
                return redirect('prescriptions');      
            }
        }

        return view('prescription.edit', compact('prescription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Prescription $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prescription $prescription)
    {
        request()->validate(Prescription::$rules);

        $prescription->update($request->all());
        $prescription->state=1;
        $prescription->save();

        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $prescription = Prescription::find($id)->delete();

        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription deleted successfully');
    }
}

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
            $user=User::where("email",$aux->email)->select('name')->get()->first();
            $doctor['name']=$user->name;
        }
        
        //$data['doctors'] = Doctor::select('doctors.*')->join('users', 'users.email', '=', 'doctors.email')->where('doctor.specialty', $request->specialty)->get(["doctors.id, users.name"]);

        return response()->json($data);
    }

    public function downloadPDF($id)
    {

        $data['patient']=Patient::where('email',Auth::user()->email)->select(array('id','birthday','healthcare_number'))->get()->first();
    
        $data['prescription'] = Prescription::where('id',$id)->where('patient_id',$data['patient']->id)->get()->first();

        if($data['prescription']!=null){

            $data['doctor']=Doctor::where('id',$data['prescription']->doctor_id)->select(array('specialty','email'))->get()->first();
            $data['doctor_user']=User::where('email',$data['doctor']->email)->get('name')->first();

            $data['patient_user']=User::where('email',Auth::user()->email)->get('name')->first();

            PDF::setOptions(['isRemoteEnabled' => TRUE, 'enable_javascript' => TRUE]);
            PDF::set_base_path( __DIR__ );
            $pdf = new PDF();
            //$html = view('prescription.pdf',compact('data'))->render();
            //$pdf->loadHtml($html);
            //$pdf->render();

            $pdf = PDF::loadView('prescription.pdf', compact('data') );
            $pdf->render();
            return $pdf->download('eMedical-'.$data['prescription']->id.'.pdf');

            //return view('prescription.pdf', compact('data'));

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
        $data['prescription'] = Prescription::find($id);

        if($data['prescription']==null)
            return redirect('prescriptions');
        else{
            if(Auth::user()->isPatient()){
                $data['patient']=Patient::where("email",Auth::user()->email)->get()->first();
                $data['doctor']=Doctor::where('id',$data['prescription']->doctor_id)->select(array('specialty','email'))->get()->first();
                $data['doctor_user']=User::where('email',$data['doctor']->email)->get('name')->first();
                $data['patient_user']=User::where('email',Auth::user()->email)->get('name')->first();
                if($data['prescription']->patient_id != $data['patient']->id)
                return redirect('prescriptions');
            }
            else if(Auth::user()->isDoctor()){
                $data['doctor']=Doctor::where("email",Auth::user()->email)->get()->first();
                $data['patient']=Patient::where('id',$data['prescription']->patient_id)->select(array('id','birthday','email','healthcare_number'))->get()->first();
                $data['doctor_user']=User::where('email',Auth::user()->email)->get('name')->first();
                $data['patient_user']=User::where('email',$data['patient']->email)->get('name')->first();


                if($data['prescription']->doctor_id != $data['doctor']->id)
                return redirect('prescriptions');      
            }
        }

        return view('prescription.show', compact('data'));
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

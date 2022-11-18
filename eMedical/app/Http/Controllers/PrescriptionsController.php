<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Doctor;
use App\Models\User;

use Illuminate\Http\Request;

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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prescriptions = Prescription::paginate();

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
        request()->validate(Prescription::$rules);

        $prescription = Prescription::create($request->all());

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
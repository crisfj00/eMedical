<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

/**
 * Class PatientController
 * @package App\Http\Controllers
 */
class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::paginate();

        return view('patient.index', compact('patients'))
            ->with('i', (request()->input('page', 1) - 1) * $patients->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patient = new Patient();
        return view('patient.create', compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Patient::$rules);

        $patient = Patient::create($request->all());

        return redirect()->route('patients.index')
            ->with('success', 'Patient created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::where('id',$id)->get()->first();

        return view('patient.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::where('id',$id)->get()->first();

        return view('patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        request()->validate(Patient::$rules);

        $patient->update($request->all());

        return redirect()->route('patients.index')
            ->with('success', 'Patient updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $patient = Patient::where('id',$id)->get()->first()->delete();

        $user = User::where('email',$patient->email)->get()->first();

        $patient->delete();

        $user->delete();
        #TODO delete user too

        return redirect()->route('patients.index')
            ->with('success', 'Patient deleted successfully');
    }
}

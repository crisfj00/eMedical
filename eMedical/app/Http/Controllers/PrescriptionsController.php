<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;


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

        if(Auth::user()->isDoctor()){
            $doc=Doctor::where('email',Auth::user()->email)->get()->first();
            $prescriptions = Prescription::where('doctorId',Auth::user()->username)->orderBy('state','asc')->paginate(5);

        }

        else if (Auth::user()->isPatient()){


        }

        $prescriptions = Prescription::paginate();

        return view('prescription.index', compact('prescriptions'))
            ->with('i', (request()->input('page', 1) - 1) * $prescriptions->perPage());
    }


    public function index()
    {
        if(Auth::check() and (Auth::user()->type==2 or Auth::user()->type==3)){


        if(Auth::user()->type==2){
        $notifications = Notification::where('codAsociation',Auth::user()->username)->orderBy('state','asc')->paginate(5);

        }

        if(Auth::user()->type==3){
            $notifications = Notification::where('admin',Auth::user()->username)->orderBy('state','desc')->paginate(5);

        }

        return view('notification.index', compact('notifications'))
            ->with('i', (request()->input('page', 1) - 1) * $notifications->perPage());
        }
        else
        return view('errors.404');
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
   
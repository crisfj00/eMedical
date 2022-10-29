<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;


/**
 * Class DoctorController
 * @package App\Http\Controllers
 */
class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::paginate();

        return view('doctor.index', compact('doctors'))
            ->with('i', (request()->input('page', 1) - 1) * $doctors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctor = new Doctor();
        return view('doctor.create', compact('doctor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        echo "hola estoy aqui";

        $request->validate(Doctor::$rules);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2
        ]);

        $doctor=Doctor::create([
            'email' => $request['email'],
            'id' => $request['id'],
            'specialty' => $request['specialty'],

        ]);

        event(new Registered($user));
        event(new Registered($doctor));

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::where('id',$id)->get()->first();

        return view('doctor.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = Doctor::where('id',$id)->get()->first();

        return view('doctor.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Doctor $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        request()->validate(Doctor::$rules);

        $doctor->update($request->all());

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $doctor = Doctor::where('id',$id)->get()->first();

        $user= User::where('email',$doctor->email)->get()->first();

        $doctor->delete();

        $user->delete();

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor deleted successfully');
    }
}

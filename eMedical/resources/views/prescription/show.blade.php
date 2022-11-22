@extends('layouts.app')

@section('template_title')
    {{ $prescription->name ?? 'Show Prescription' }}
@endsection

@section('content')
<section class="content container-fluid">
<div class="card">
                    <div class="card-header" style="display: flex;
                                                    flex-direction: row;
                                                    justify-content: space-between;
                                                    align-items: center;">
                        <div class="float-left">
                            <span class="card-title">Show Prescription</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('prescriptions.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
    <div class="pres-header" 
            style=" width:auto; 
                    display:flex;
                    flex-direction:row;
                    justify-content: space-between;
                    margin: 5% 10%;">

        <div class="patient-info" style="display:flex; flex-direction:column;">
        <div style="display: flex;flex-direction: row;align-items: baseline;"><h4 style="margin-right: 1em;"><b>Patient Name</b>: </h4><h6>{{$data['patient_user']['name']}}</h6></div>
        <div style="display: flex;flex-direction: row;align-items: baseline;"><h4 style="margin-right: 1em;"><b>Id Number</b>: </h4><h6>{{$data['prescription']->patient_id}}</h6></div>
        <div style="display: flex;flex-direction: row;align-items: baseline;"><h4 style="margin-right: 1em;"><b>Health Care Number</b>: </h4><h6>{{$data['patient']->healthcare_number}}</h6></div>
        <div style="display: flex;flex-direction: row;align-items: baseline;"><h4 style="margin-right: 1em;"><b>Birthday Date</b>: </h4><h6>{{ \Carbon\Carbon::parse($data['patient']->birthday)->format('d/m/Y')}}</h6></div>
        <div style="display: flex;flex-direction: row;align-items: baseline;"><h4 style="margin-right: 1em;"><b>Consultation Date</b>: </h4><h6>{{ \Carbon\Carbon::parse($data['prescription']->created_at)->format('d/m/Y')}}</h6></div>
    </div>

        <div class="doctor-info" style="display:flex; flex-direction:column;">
        <div style="display: flex;flex-direction: row;align-items: baseline;"><h4 style="margin-right: 1em;"><b>Doctor</b>: </h4><h6>{{$data['doctor_user']['name']}}</h6></div>
        <div style="display: flex;flex-direction: row;align-items: baseline;"><h4 style="margin-right: 1em;"><b>Professional Number</b>: </h4><h6>{{$data['prescription']->doctor_id}}</h6></div>
        <div style="display: flex;flex-direction: row;align-items: baseline;"><h4 style="margin-right: 1em;"><b>Specialty</b>: </h4><h6>{{$data['doctor']->specialty}}</h6></div>
        </div>

    </div>

    <div class="pres-info"
    style=" width:auto; 
                    display:flex;
                    flex-direction:column;
                    justify-content: space-between;
                    margin: 5% 10%;">
    <h4><b>Consultation</b>:</h4>
    <h6 style="text-align: justify;">{{ $data['prescription']->consultation }}</h6>

    @if(Auth::user()->isDoctor() && $data['prescription']->diagnosis!="")
    <h4 style="margin-top: 2%;"><b>Diagnosis</b>:</h4>
    <h6 style="text-align: justify;">{{ $data['prescription']->diagnosis }}</h6>
    @endif

    </div>
</div></div>
</section>
@endsection

@extends('layouts.app')

@section('template_title')
    {{ $patient->name ?? 'Show Patient' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Patient</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('patients.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $patient->email }}
                        </div>
                        <div class="form-group">
                            <strong>Id Number:</strong>
                            {{ $patient->id_number }}
                        </div>
                        <div class="form-group">
                            <strong>Healthcare Number:</strong>
                            {{ $patient->healthcare_number }}
                        </div>
                        <div class="form-group">
                            <strong>Birthday:</strong>
                            {{ $patient->birthday }}
                        </div>
                        <div class="form-group">
                            <strong>Occupation:</strong>
                            {{ $patient->occupation }}
                        </div>
                        <div class="form-group">
                            <strong>Address:</strong>
                            {{ $patient->address }}
                        </div>
                        <div class="form-group">
                            <strong>Phone Number:</strong>
                            {{ $patient->phone_number }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

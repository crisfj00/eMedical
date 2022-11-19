@extends('layouts.app')

@section('template_title')
    {{ $prescription->name ?? 'Show Prescription' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Prescription</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('prescriptions.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Patient Id:</strong>
                            {{ $prescription->patient_id }}
                        </div>
                        <div class="form-group">
                            <strong>Doctor Id:</strong>
                            {{ $prescription->doctor_id }}
                        </div>
                        <div class="form-group">
                            <strong>Consultation:</strong>
                            {{ $prescription->consultation }}
                        </div>
                        <div class="form-group">
                            <strong>Diagnosis:</strong>
                            {{ $prescription->diagnosis }}
                        </div>
                        <div class="form-group">
                            <strong>State:</strong>
                            @if( $prescription->state )SOLVED @else PENDING @endif
                        </div>

                        <div class="form-group">
                            <strong>Created:</strong>
                            {{ $prescription->created_at }}
                        </div>

                        @if( $prescription->state )

                        <div class="form-group">
                            <strong>Solved:</strong>
                            {{ $prescription->updated_at }}
                        </div>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

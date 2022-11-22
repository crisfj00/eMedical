@extends('layouts.app')

@section('template_title')
    {{ $doctor->name ?? 'Show Doctor' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Doctor</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('doctors.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $doctor->email }}
                        </div>
                        <div class="form-group">
                            <strong>Specialty:</strong>
                            {{ $doctor->specialty }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

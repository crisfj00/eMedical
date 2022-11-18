<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('patient_id') }}
            {{ Form::text('patient_id', $prescription->patient_id, ['class' => 'form-control' . ($errors->has('patient_id') ? ' is-invalid' : ''), 'placeholder' => 'Patient Id']) }}
            {!! $errors->first('patient_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('doctor_id') }}
            {{ Form::text('doctor_id', $prescription->doctor_id, ['class' => 'form-control' . ($errors->has('doctor_id') ? ' is-invalid' : ''), 'placeholder' => 'Doctor Id']) }}
            {!! $errors->first('doctor_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('consultation') }}
            {{ Form::text('consultation', $prescription->consultation, ['class' => 'form-control' . ($errors->has('consultation') ? ' is-invalid' : ''), 'placeholder' => 'Consultation']) }}
            {!! $errors->first('consultation', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('diagnosis') }}
            {{ Form::text('diagnosis', $prescription->diagnosis, ['class' => 'form-control' . ($errors->has('diagnosis') ? ' is-invalid' : ''), 'placeholder' => 'Diagnosis']) }}
            {!! $errors->first('diagnosis', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('state') }}
            {{ Form::text('state', $prescription->state, ['class' => 'form-control' . ($errors->has('state') ? ' is-invalid' : ''), 'placeholder' => 'State']) }}
            {!! $errors->first('state', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
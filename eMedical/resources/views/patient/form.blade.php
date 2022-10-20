<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $patient->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('id_number') }}
            {{ Form::text('id_number', $patient->id_number, ['class' => 'form-control' . ($errors->has('id_number') ? ' is-invalid' : ''), 'placeholder' => 'Id Number']) }}
            {!! $errors->first('id_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('healthcare_number') }}
            {{ Form::text('healthcare_number', $patient->healthcare_number, ['class' => 'form-control' . ($errors->has('healthcare_number') ? ' is-invalid' : ''), 'placeholder' => 'Healthcare Number']) }}
            {!! $errors->first('healthcare_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('birthday') }}
            {{ Form::text('birthday', $patient->birthday, ['class' => 'form-control' . ($errors->has('birthday') ? ' is-invalid' : ''), 'placeholder' => 'Birthday']) }}
            {!! $errors->first('birthday', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('occupation') }}
            {{ Form::text('occupation', $patient->occupation, ['class' => 'form-control' . ($errors->has('occupation') ? ' is-invalid' : ''), 'placeholder' => 'Occupation']) }}
            {!! $errors->first('occupation', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('address') }}
            {{ Form::text('address', $patient->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => 'Address']) }}
            {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('phone_number') }}
            {{ Form::text('phone_number', $patient->phone_number, ['class' => 'form-control' . ($errors->has('phone_number') ? ' is-invalid' : ''), 'placeholder' => 'Phone Number']) }}
            {!! $errors->first('phone_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
<div class="box box-info padding-1">
    <div class="card-body">


    <div class="row mb-3" id="div-patient">
        <label for="patient_id" class="col-md-4 col-form-label text-md-end">{{ __('Patient ID') }}</label>

        <div class="col-md-6">
            <input readonly id="patient_id" type="text" class="form-control @error('patient_id') is-invalid @enderror" name="patient_id" value="{{ $prescription->patient_id }}" required autocomplete="patient_id" autofocus>

            @error('patient_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3" id="div-doctor">
        <label for="doctor_id" class="col-md-4 col-form-label text-md-end">{{ __('Doctor ID') }}</label>

        <div class="col-md-6">
            <input readonly id="doctor_id" type="text" class="form-control @error('doctor_id') is-invalid @enderror" name="doctor_id" value="{{ $prescription->doctor_id }}" required autocomplete="doctor_id" autofocus>

            @error('patient_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3" id="div-consultation">
        <label for="consultation" class="col-md-4 col-form-label text-md-end">{{ __('Consultation') }}</label>

        <div class="col-md-6">
            <textarea readonly minlength="50" id="consultation" type="text" class="form-control @error('consultation') is-invalid @enderror" name="consultation" autofocus>{{$prescription->consultation}}</textarea>
            @error('consultation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3" id="div-diagnosis">
        <label for="diagnosis" class="col-md-4 col-form-label text-md-end">{{ __('Diagnosis') }}</label>

        <div class="col-md-6">
            <textarea minlength="50" id="diagnosis" placeholder="Describe here the prescription for the patient..." type="text" class="form-control @error('diagnosis') is-invalid @enderror" name="diagnosis" autofocus></textarea>
            @error('diagnosis')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>


   
    </div>
    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Submit') }}
            </button>
        </div>
    </div>
</div>
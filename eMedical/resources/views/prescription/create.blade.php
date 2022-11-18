@extends('layouts.app')

@section('template_title')
    Create Prescription
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Prescription</span>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('prescriptions.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3" id="div-specialty" >
                            <label for="specialty" class="col-md-4 col-form-label text-md-end">{{ __('Specialty field') }}</label>

                            <div class="col-md-6">

                                <select class="form-select @error('specialty') is-invalid @enderror" id="specialty" name="specialty" required>
                                    <option value="" selected>Choose specialty</option>
                                    @foreach($specialties as $specialty)
                                        <option value="{{$specialty->specialty}}">{{ ucfirst($specialty->specialty)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    <div class="row mb-3" id="div-doctor" style="display:none;">
                        <label for="doctor" class="col-md-4 col-form-label text-md-end">{{ __('Doctor to consult') }}</label>

                        <div class="col-md-6">

                            <select class="form-select @error('doctor') is-invalid @enderror" id="doctor" name="doctor" >
                            </select>
                        </div>
                    </div>


                    <div class="row mb-3" id="div-consultation" style="display:none;">
                            <label for="consultation" class="col-md-4 col-form-label text-md-end">{{ __('Consultation') }}</label>

                            <div class="col-md-6">
                                <textarea minlength="50" maxlength ="5000" placeholder="Describe your consultation..." id="consultation" type="text" class="form-control @error('consultation') is-invalid @enderror" name="consultation" value="{{ old('consultation') }}" autofocus></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
            $('#specialty').on('change', function () {
                var specialty = this.value;
                $("#doctor").html('');
                $.ajax({
                    url: "{{url('api/fetch-doctors')}}",
                    type: "POST",
                    data: {
                        specialty: specialty,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        if(result.doctors.length>0 ){                 
                        $('#doctor').html('<option value="">Select Doctor</option>');
                        $.each(result.doctors, function (key, value) {
                            $("#doctor").append('<option value="' + value
                                .id + '">'+ value.id+ " - " + value.name + '</option>');
                        });
                        $('#div-doctor').show(150);
                        }

                        if(result.doctors.length<=0 )
                        $('#div-doctor').hide();

                    }
                })
            });


        });

</script>





@endsection

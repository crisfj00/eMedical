@extends('layouts.app')

<style>
    .landing{
    height: 20%;
    width: 100%;
    text-align: center;
    padding: 10%;
    display: flex;
    flex-direction: column;
    align-items: center;

}

    #landing-introduction{
    color: $color4;
    *{
        margin: 2% 0em;
    }
    }

</style>

@section('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('eMedical') }}
        </h2>
@endsection

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(auth()->user()->isAdmin())
                    You're logged in as ADMIN!
                    @elseif(auth()->user()->isPatient())
                    <div class="landing" id="landing-introduction">
                        <h1>eMedical is the platform where you can connect directly to your doctor.</h1>
                        <h3>Place a consultation to an specified specialty and you will be contacted when it's solved.</h3>
                    </div>
                    @elseif(auth()->user()->isDoctor())
                      <div class="landing" id="landing-introduction">
                        <h1>Welcome Doctor {{auth()->user()->name}}</h1>
                        <h3>Check your patients' consultations and answer them directly on this app.</h3>
                    </div>                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection

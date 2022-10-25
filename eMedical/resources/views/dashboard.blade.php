@extends('layouts.app')


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
                    @else
                    You're logged in!
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection

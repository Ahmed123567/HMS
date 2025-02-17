@extends('layouts.master')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="">
                <div class="p-6 text-gray-900">
                    @if (auth()->user()->isDoctor())
                        @include('admin.dashboard.doctorDashboard')
                    @endif
                    
                    @if (auth()->user()->isLabAnalyst())
                        @include('admin.dashboard.labDashboard')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

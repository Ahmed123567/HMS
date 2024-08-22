@extends('layouts.master')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Doctor</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Patient Profile</span>
            </div>
        </div>
        
    </div>
@endsection
@section('content')
    <div class="card">

        <div class="card-body pb-3">
            <div class="row text-center">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <img  style="border-radius: 10px;" width="120"
                                src="{{ asset($patient->user?->imageUrl() ?? defaultImage()) }}" alt="">
                        </div>
                        <div class="col-6 text-left">
                            <input class="form-control "  style="background: #ffffff" disabled type="text" value="Name : {{$patient->name}}">
                            <input class="form-control mt-2" style="background: #ffffff" disabled type="text" value="Age : {{now()->diffInYears($patient->date_of_birth)}}">
                            <input class="form-control mt-2" style="background: #ffffff" disabled type="text" value="Gender : {{ $patient->gender() }}">
                        </div>
                    </div>
                </div>  
                
                <div class="col-6">
                    <button class="modal_btn btn btn-primary mt-4" data-title="Medical History" data-url="{{ route("patient.medicalHistory", $patient->id) }}">Medical History</button>
                </div>

            </div>

        </div>

    </div>

    <div class="row row-sm">
        <div class="col-xl-12">
            <livewire:medical-profile-table :patient="$patient" />
        </div>
    </div>
        <!--/div-->
    @endsection
    @section('js')
    @endsection

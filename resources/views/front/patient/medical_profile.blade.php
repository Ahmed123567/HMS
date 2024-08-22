@extends('layouts.front_master')


@section('content')
    <div class="container">
        <div class="card shadow">

            <div class="card-body pb-3">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-6 ">
                                <img style="border-radius: 10px;" width="120"
                                    src="{{ asset(auth()->user()->imageUrl() ?? defaultImage()) }}" alt=""
                                    class="rounded-circle img-raised rounded-circle thumbnail img-fluid image">
                            </div>
                            <div class="col-6 text-left">
                                <input class="form-control form-control-shadow " style="background: #ffffff" disabled
                                    type="text" value="Name : {{ auth()->user()->patient?->name }}">
                                <input class="form-control mt-2" style="background: #ffffff" disabled type="text"
                                    value="Age : {{ now()->diffInYears(auth()->user()->patient?->date_of_birth) }}">
                                <input class="form-control mt-2" style="background: #ffffff" disabled type="text"
                                    value="Gender : {{ auth()->user()->patient?->gender() }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <button class="modal_btn btn btn-primary mt-4" data-title="Medical History"
                            data-url="{{ route('patient.view.medical_history') }}">Medical History</button>
                    </div>

                </div>

            </div>

        </div>

        <div class="row row-sm">
            <div class="col-xl-12">
                </livewire:medical-profile-table :patient="auth()->user()?->patient" />
            </div>

        </div>

    </div>
@endsection

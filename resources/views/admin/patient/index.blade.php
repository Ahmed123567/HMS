@extends('layouts.master')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Management</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/Patients</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" data-url="{{ route('patient.create') }}" data-title="Create Patient"
                    class="modal_btn btn btn-info btn-icon ml-2"><i class="mdi mdi-plus"></i></button>
            </div>

        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Patients</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Date Of Birth</th>
                                    <th>National Id</th>
                                    <th>Insurance Number</th>
                                    <th>Has Account</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($patients as $patient)
                                    <tr>
                                        <td>{{ $patient->name }}</td>
                                        <td>{{ $patient->gender() ?? '-' }}</td>
                                        <td>{{ getCarbon($patient->date_of_birth)->format("Y-m-d") ?? '-' }}</td>
                                        <td>{{ $patient->national_id ?? '-'}}</td>
                                        <td>{{ $patient->insurance_number }}</td>
                                        <td>{{ $patient->user ? "Yes" : "No" }}</td>
                                        <td class="d-flex">
                                            <x-crud :model="$patient"/>
                                            {{-- @if (!$patient->user)
                                                <button data-toggle="tooltip" title="Create Account" class="btn btn-sm badge btn-secondary"><i class="fa fa-user"></i></button>
                                            @endif --}}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    @endsection
    @section('js')
    @endsection

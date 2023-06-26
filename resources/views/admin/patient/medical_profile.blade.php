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
                

            </div>

        </div>

    </div>

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Patient Records</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table text-md-nowrap" id="exampl">
                            <thead>
                                <tr>
                                    <th>Diagnosis</th>
                                    <th>Description</th>
                                    <th>Files</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($patient->records as $record)
                                    <tr>
                                        <td>{{ $record->diagnosis }}</td>
                                        <td>{{ $record->description }}</td>
                                        <td>
                                            @if ($record->files)
                                                <a href="{{ route('patient.files', $record->id) }}">Download Files</a>
                                            @endif
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

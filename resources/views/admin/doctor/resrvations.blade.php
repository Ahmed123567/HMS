@extends('layouts.master')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Tables</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Data
                    Tables</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">


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
                        <h4 class="card-title mg-b-0">Department TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Day</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $resrvation)
                                    <tr>
                                        <td>{{ $resrvation?->patient?->name }}</td>
                                        <td>{{ $resrvation?->time?->format('l') }}</td>
                                        <td>{{ $resrvation?->time?->format('Y-m-d') }}</td>
                                        <td>{{ $resrvation?->time?->format('H:i') }}</td>
                                        <td class="d-flex">
                                            <a class="badge btn btn-info mx-2" data-toggle="tooltip"
                                            title="patient profile">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                           
                                            @if (!$resrvation?->isClosed() && $resrvation?->isConfirmed())
                                                <button data-title="Appointmet Report"
                                                    data-url="{{ route('appointment.reserve.report', $resrvation->id) }}"
                                                    class=" modal_btn badge btn btn-primary mx-1" data-toggle="tooltip"
                                                    title="close">
                                                    <i class="mdi mdi-close"></i>
                                                </button>
                                            @endif

                                            @if (!$resrvation?->isConfirmed())
                                                <form action="{{ route('appointment.reserve.confirm', $resrvation->id) }}"
                                                    method="post" class="mx-1">
                                                    @csrf
                                                    <button data-button_name="Approve"
                                                        class="delete_button badge btn btn-primary" data-toggle="tooltip"
                                                        title="Confirm" type="submit">
                                                        <i data-button_name="Approve" class="mdi mdi-pen"></i>
                                                    </button>
                                                </form>
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

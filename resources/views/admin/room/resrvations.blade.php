@extends('layouts.master')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Management</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Reservations </span>
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
                        <h4 class="card-title mg-b-0">Departments</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="resrvations">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Is Confirmed</th>
                                    <th>Is Expired</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resrvaions as $resrvation)
                                    <tr>
                                        <td>{{ $resrvation->patient?->name ?? "-"}}</td>
                                        <td>{{ $resrvation->from->format("Y-m-d") }}</td>
                                        <td>{{ $resrvation->to->format("Y-m-d") }}</td>
                                        <td>
                                            @if ($resrvation->isConfirmed())
                                                <span class="badge bg-success text-white">Confirmed</span>
                                            @else
                                                <span class="badge bg-danger text-white">Not Confirmed</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($resrvation->isExpired())
                                                <span class="badge bg-danger text-white">Expired</span>
                                            @else
                                                <span class="badge bg-success text-white">Not Expired</span>
                                            @endif
                                        </td>

                                        <td class="d-flex">
                                            @if (!$resrvation->isConfirmed() && !$resrvation->isExpired())
                                                <form action="{{route("room.reserve.confirm", $resrvation->id)}}" method="post" class="mx-1">
                                                    @csrf
                                                    <button data-button_name="Approve" class="delete_button badge btn btn-primary" data-toggle="tooltip" title="Confirm" type="submit">
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


    @push("js")
    <script>
        $('#resrvations').DataTable({
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_',
                },

                "ordering": false,
        });

    </script>

    @endpush

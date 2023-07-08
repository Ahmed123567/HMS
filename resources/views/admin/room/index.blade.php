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
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" data-url="{{ route('room.create') }}" data-title="Create Room"
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
                        <h4 class="card-title mg-b-0">Department TABLE</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th>Room Id</th>
                                    <th>Number Of Beds</th>
                                    <th>Bed Price</th>
                                    <th>Is Sepcial</th>
                                    <th>Avilable Beds</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>{{ $room->room_id }}</td>
                                        <td>{{ $room->number_of_beds }}</td>
                                        <td>{{ $room->one_night_bed_price }} $</td>
                                        <td>
                                            {{ $room->is_special == 1 ? "sepcial" : "-"  }}
                                        </td>
                                        <td>
                                            {{$room->number_of_beds}}
                                        </td>
                                        <td class="d-flex">

                                            <a  href="{{route("room.showResrvations", $room->id)}}" data-toggle="tooltip" title="Rservations" class=" mx-1 badge btn btn-info ">
                                               	<i class="icon ion-ios-stats"></i>
                                            </a>

                                            <x-Crud :model="$room" />

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
    
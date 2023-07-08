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
        {{-- <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" data-url="{{ route('room.create') }}" data-title="Create Room"
        class="modal_btn btn btn-info btn-icon ml-2"><i class="mdi mdi-plus"></i></button>
    </div> --}}

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
                    <h4 class="card-title mg-b-0">Resrvations</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body">
                <form class="validate" action="{{route("room.reserve.store")}}" method="post">
                    @csrf
                    <div class="row">

                        <div class="form-group col-3">
                            <label for="">Room</label>
                            <select name="room_id" class="form-control" id="room_select">
                                <option disabled selected value="">choose room</option>
                                @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->room_id }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group col-3">
                            <label for="">Patient</label>
                            <select name="patient_id" class="form-control" id="patient_select">
                                <option value="">choose patient</option>
                                @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-3">
                            <label for="">From</label>
                            <input type="date" min="{{now()->format("Y-m-d")}}"
                                value="{{request("from", now()->format("Y-m-d"))}}" name="from" id="from"
                                class="form-control">
                        </div>

                        <div class="form-group col-3">
                            <label for="">To</label>
                            <input type="date" min="{{now()->format("Y-m-d")}}"
                                value="{{request("to", now()->format("Y-m-d"))}}" name="to" id="to"
                                class="form-control">
                        </div>

                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary button-icon "> 
                        <i class="fe fe-check-square me-2"></i>
                            Reserve
                        </button>
                    </div>
                </form>

                <div class="reservations" id="reservations">

                </div>
            </div>
        </div>
    </div>
    <!--/div-->
    @endsection
    @push('js')
    <script>
    let roomSelect = document.getElementById("room_select");
    let from = document.getElementById("from");
    let to = document.getElementById("to");

    let resrvationAction = function(event) {
        let reservationDiv = document.getElementById("reservations");
        let roomUrl = '{{route("room.json", ":id")}}';

        roomUrl = roomUrl.replace(":id", roomSelect.value) + `?from=${from.value}&to=${to.value}`;

        fetch(roomUrl).then(async response => {
                let room = await response.json();
                let html = `
                        <h5 class = "pt-3">Room Informations :</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">Room Beds : ${room.number_of_beds}</div>
                                    <div class="col-3">Avilable Beds : ${room.avilable_beds}</div>
                                    <div class="col-3">Total Price : ${room.total_price}</div>
                                    <div class="col-3">
                                        ${room.is_special == 1 ? `<span class="badge bg-success text-white">Special</span>` : `<span class="badge bg-danger text-white">Not Special</span>`}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5>Reservations :</h5>
                    `;

                if (room.reservatoins.length !== 0) {

                    room.reservatoins.forEach(resrvation => {
                        html += `
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-3">patient : ${resrvation.patient.name}</div>
                                            <div class="col-3">from : ${resrvation.from}</div>
                                            <div class="col-3">to : ${resrvation.to}</div>
                                            <div class="col-3">     
                                               ${resrvation.is_confirmed == 1 ? `<span class="badge bg-success text-white">Confirmed</span>` : `<span class="badge bg-danger text-white">Not Confirmed</span>`}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                    });

                } else {
                    html += `
                            <div style="text-align:center">
                                No Resrvations In The Selected Period    
                            </div>
                        `;
                }

                reservationDiv.innerHTML = html;

            })
            .catch(err => {
                console.log(err);
            })
    }

    roomSelect.addEventListener("change", resrvationAction);
    from.addEventListener("change", resrvationAction);
    to.addEventListener("change", resrvationAction);
    </script>
    @endpush
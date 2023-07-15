@extends('layouts.master')
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Management</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Reservations</span>
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
                    <h4 class="card-title mg-b-0">Reservations</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <div class="card-body">
                    <form action="{{ route('room.reserve.store') }}" method="post">
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

                                @error('room_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-3">
                                <label for="">Patient</label>
                                <select name="patient_id" class="form-control" id="patient_select">
                                    <option value="">choose patient</option>
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                    @endforeach
                                </select>

                                @error('patient_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-3">
                                <label for="">From</label>
                                <input type="date" min="{{ now()->format('Y-m-d') }}"
                                    value="{{ request('from', now()->format('Y-m-d')) }}" name="from" id="from"
                                    class="form-control">

                                @error('from')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-3">
                                <label for="">To</label>
                                <input type="date" min="{{ now()->format('Y-m-d') }}"
                                    value="{{ request('to', now()->format('Y-m-d')) }}" name="to" id="to"
                                    class="form-control">

                                @error('to')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="text-left">
                            <button type="submit" class="btn btn-primary button-icon ">
                            <i class="fe fe-check-square me-2"></i>
                                Reserve
                            </button>
                        </div>

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
            const roomSelect = document.getElementById("room_select");
            const from = document.getElementById("from");
            const to = document.getElementById("to");
            const resrvationAction = event => {

                const roomUrl = urlFor(`{{ route('room.ajax', ':id') }}?from=${from.value}&to=${to.value}`, {id: roomSelect.value});

                fetch(roomUrl).then(async response => {
                    document.getElementById("reservations").innerHTML = await response.text();
                });
            }

            roomSelect.addEventListener("change", resrvationAction);
            from.addEventListener("change", resrvationAction);
            to.addEventListener("change", resrvationAction);
        </script>
    @endpush

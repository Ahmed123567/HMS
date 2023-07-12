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
                <button type="button" data-url="{{ route('doctor.create') }}" data-title="Create Room"
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
                    <form  action="{{route("appointment.reserve.store")}}" method="post">
                        @csrf
                        <div class="row">

                            <div class="form-group col-3">
                                <label for="">Deprtment</label>
                                <select data-target="#doctor_select"  class="form-control" id="deparmtent_select">
                                    <option disabled selected value="">choose Department</option>
                                    @foreach ($departments as $deparmtent)
                                        <option value="{{ $deparmtent->id }}">{{ $deparmtent->name }}</option>
                                    @endforeach
                                </select>
                                @error("deparmtent_id")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group col-3">
                                <label for="">Doctor</label>
                                <select name="doctor_id" class="form-control" id="doctor_select">
                                    <option value="">choose doctor</option>
                                </select>
                                @error("doctor_id")
                                    <span class="text-danger">{{$message}}</span>
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
                                @error("patient_id")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group col-3">
                                <label for="">Time</label>
                                <input type="datetime-local" min="{{now()->format("Y-m-d H:i:s")}}" value="{{request("from", now()->format("Y-m-d H:i:s"))}}" name="time" id="time" class="form-control">
                                @error("time")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                           
                        </div>
                        <div class="text-left">
                        <button type="submit" class="btn btn-primary button-icon">
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
            const doctorSelect = document.getElementById("doctor_select");
            const time = document.getElementById("time");
            const departmentSelect = document.getElementById("deparmtent_select");
          
            const changeDepartmentAction = event => {

                const url = urlFor("{{ route('deparmtent.doctors', ':id') }}", { id: event.target.value })

                fetch(url).then(async function(res) {
                    document.querySelector(event.target.dataset.target).innerHTML = await res.text();
                });
            }

            const resrvationAction = function (event) {
             
                const doctorUrl = urlFor(`{{route("doctor.ajax", ":id")}}?time=${time.value}`, { id: doctorSelect.value });

                fetch(doctorUrl).then(async function (response)  {
        
                    document.getElementById("reservations").innerHTML = await response.text();
                })
            }

            doctorSelect.addEventListener("change", resrvationAction);
            time.addEventListener("change", resrvationAction);
            departmentSelect.addEventListener("change", changeDepartmentAction);
        </script>
    @endpush

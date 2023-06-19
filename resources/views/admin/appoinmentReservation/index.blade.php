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
                                <label for="">Doctor</label>
                                <select name="doctor_id" class="form-control" id="doctor_select">
                                    <option disabled selected value="">choose doctor</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @endforeach
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
                        <button type="submit" class="btn btn-primary">
                            Reserve
                        </button>
                    </form>

                    <div class="reservations" id="reservations">
                        <h5 class = "pt-3">Doctor Rerservations :</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">Number Of Resrvations : </div>
                                    <div class="col-3">From : </div>
                                    <div class="col-3">To : </div>
                                </div>
                            </div>
                        </div>
                        <h5>Reservations :</h5>

                        <div class="card">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-4">patient : </div>
                                    <div class="col-4">Time : </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    @endsection
    @push('js')
        <script>
            let doctorSelect = document.getElementById("doctor_select");
            let time = document.getElementById("time");
            
            let resrvationAction = function (event) {  
                let reservationDiv = document.getElementById("reservations");   
                let doctorUrl = '{{route("doctor.json", ":id")}}';

                doctorUrl = doctorUrl.replace(":id", doctorSelect.value) + `?time=${time.value}`;

                fetch(doctorUrl).then(async response => {
                    let doctor = await response.json();
                    console.log(doctor);
                    let html = `
                        <h5 class = "pt-3">Doctor Rerservations :</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">Number Of Resrvations : ${doctor.reservatoins.length} </div>
                                    <div class="col-2">From : ${doctor.shift.from}</div>
                                    <div class="col-2">To : ${doctor.shift.to} </div>
                                    <div class="col-6">Avilable Days : ${doctor.shift.days} </div>
                                </div>
                            </div>
                        </div>
                        <h5>Reservations :</h5>
                    `;
                    
                    console.log(doctor);
                    if(doctor.reservatoins.length !== 0) {

                        doctor.reservatoins.forEach(resrvation => {
                            let dateTime = new Date(resrvation.time);
                            html += `
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-4">patient : ${resrvation.patient.name} </div>
                                            <div class="col-4">Time : ${dateTime.getHours()}:${dateTime.getMinutes()}  </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                        
                    }else {
                        html += `
                            <div style="text-align:center">
                                No Resrvations In The Selected Day    
                            </div>
                        `; 
                    }

                    reservationDiv.innerHTML = html;
                    
                })
                .catch(err => {
                    console.log(err);
                })
            }

            doctorSelect.addEventListener("change", resrvationAction);
            time.addEventListener("change", resrvationAction);
            
        </script>
    @endpush

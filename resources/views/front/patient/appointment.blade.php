@extends('layouts.front_master')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="heading-section mb-4">Appointment Reservation</h2>

                <div class="tabulation">
							<ul class="nav nav-pills nav-fill">
								<li class="nav-item">
									<a class="nav-link active py-3" data-toggle="tab" href="#new"><span
											class="ion-ios-calendar mr-2"></span> Make New</a>
								</li>
								<li class="nav-item">
									<a class="nav-link py-3 mx-md-3" data-toggle="tab" href="#pending"><span
											class="ion-ios-paper mr-2"></span> Previous Appointments</a>
								</li>
							</ul>

               
                    <div class="tab-content rounded mt-4">
                        <div class="tab-pane container p-4 active " id="new">
                            <div class=" py-5 mt-md-5">
                                <div class="container py-md-5">
                                    <form action="{{ route('patient.view.reserve') }}" method="post">
                                        @csrf
                                        <div class="row">

                                            <div class="form-group col-4">
                                                <label for="">Deprtment</label>
                                                <select data-target="#doctor_select" class="form-control"
                                                    id="deparmtent_select">
                                                    <option disabled selected value="">choose Department</option>
                                                    @foreach ($departments as $deparmtent)
                                                        <option value="{{ $deparmtent->id }}">{{ $deparmtent->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('deparmtent_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="">Doctor</label>
                                                <select name="doctor_id" class="form-control shadow" id="doctor_select">
                                                    <option value="">choose doctor</option>
                                                </select>
                                                @error('doctor_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="">Time</label>
                                                <input type="datetime-local" min="{{ now()->format('Y-m-d H:i:s') }}"
                                                    value="{{ request('from', now()->format('Y-m-d H:i:s')) }}"
                                                    name="time" id="time" class="form-control form-control-shadow">
                                                @error('time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="text-right">
                                        <button type="submit" class="btn btn-primary mt-3">
                                            Reserve
                                        </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="reservations" id="reservations">
                                
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane container p-4 fade" id="pending">
									<p>Far far away, behind the word mountains, far from the countries Vokalia and
										Consonantia, there live the blind texts. Separated they live in Bookmarksgrove
										right at the coast of the Semantics, a large language ocean.</p>
						</div>
                    </div>
                </div>
            </div>
        @endsection
        @push('js')
            <script>
                let doctorSelect = document.getElementById("doctor_select");
                let time = document.getElementById("time");


                let resrvationAction = function(event) {
                    let reservationDiv = document.getElementById("reservations");
                    let doctorUrl = '{{ route('doctor.json', ':id') }}';

                    doctorUrl = doctorUrl.replace(":id", doctorSelect.value) + `?time=${time.value}`;

                    fetch(doctorUrl).then(async response => {
                            let doctor = await response.json();
                            let html = `
                                        <h5 class = "pt-3">Doctor Rerservations :</h5>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-2" style="font-size:11px; font-weight:bold;"  >Number Of Resrvations : ${doctor.reservatoins.length} </div>
                                                    <div class="col-2" style="font-size:11px; font-weight:bold;" >From : ${doctor.shift.from}</div>
                                                    <div class="col-2" style="font-size:11px; font-weight:bold;" >To : ${doctor.shift.to} </div>
                                                    <div class="col-6" style="font-size:11px; font-weight:bold;" >Avilable Days : ${doctor.shift.days} </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="mt-3">Reserved Times :</h5>
                                        <div class="card">
                                            <div class="card-body">
                                    `;

                            if (doctor.reservatoins.length !== 0) {
                                        
            
                                doctor.reservatoins.forEach(resrvation => {
                                    let dateTime = new Date(resrvation.time);
                                  
                                    const authId = '{{ auth()->user()->patient->id }}';
                                    let className = "btn-info";
                                    if(authId == resrvation.patient_id) {
                                        className =  "btn-primary";
                                    }
                                    console.log();
                                    html += `
                                        <button class="btn ${className} mx-3" >${dateTime.getHours()}:${dateTime.getMinutes()}</button>
                                    `;
                                });

                                html +=`
                                    <p style="font-weight:bold" class="mt-5">my reservations : <span style="border-radius:0px !important" class="btn-sm btn btn-primary p-2"></span></p>
                                `;

                            } else {
                                html += `
                                            
                                    <div style="text-align:center">
                                        No Resrvations In The Selected Day    
                                    </div>
                                `;
                            }

                            html += ` 
                                </div>
                            </div>
                            `;

                            reservationDiv.innerHTML = html;

                        })
                        .catch(err => {
                            console.log(err);
                        })
                }

                doctorSelect.addEventListener("change", resrvationAction);
                time.addEventListener("change", resrvationAction);

                const departmentSelect = document.getElementById("deparmtent_select");

                departmentSelect.addEventListener("change", event => {

                    let url = "{{ route('deparmtent.doctors', ':id') }}";

                    url = url.replace(":id", event.target.value);

                    const targetSelect = document.querySelector(event.target.dataset.target);

                    fetch(url).then(async function(res) {
                        const html = await res.text();
                        targetSelect.innerHTML = html;
                    });
                });
              
            </script>
        @endpush

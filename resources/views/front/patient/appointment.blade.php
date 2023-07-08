@extends('layouts.front_master')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="heading-section mb-4">Appointment Reservation</h2>

                <div class="tabulation">
							{{-- <ul class="nav nav-pills nav-fill">
								<li class="nav-item">
									<a class="nav-link active py-3" data-toggle="tab" href="#new"><span
											class="ion-ios-calendar mr-2"></span> Make New</a>
								</li>
								<li class="nav-item">
									<a class="nav-link py-3 mx-md-3" data-toggle="tab" href="#pending"><span
											class="ion-ios-paper mr-2"></span> Previous Appointments</a>
								</li>
							</ul> --}}

               
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
                const doctorSelect = document.getElementById("doctor_select");
                const time = document.getElementById("time");
                const departmentSelect = document.getElementById("deparmtent_select");
                
                const resrvationAction = event => {

                    const doctorUrl = urlFor(`{{ route('doctor.patientView.ajax', ':id') }}?time=${time.value}`, {id : doctorSelect.value});
                    
                    fetch(doctorUrl).then(async function(response) {
                        document.getElementById("reservations").innerHTML = await response.text();
                    });
                }

                const changeDepartmentAction = event => {

                    const url = urlFor("{{ route('deparmtent.doctors', ':id') }}", { id: event.target.value })

                    fetch(url).then(async function(response) {
                        document.querySelector(event.target.dataset.target).innerHTML = await response.text();
                    });
                }

                doctorSelect.addEventListener("change", resrvationAction);
                time.addEventListener("change", resrvationAction);
                departmentSelect.addEventListener("change", changeDepartmentAction);
            </script>
        @endpush

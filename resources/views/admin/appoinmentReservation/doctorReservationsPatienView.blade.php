<h5 class="pt-3">Doctor Rerservations :</h5>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div style="font-size:10px; font-weight:bold" class="col-2">Number Of Resrvations : {{ $doctor->reservatoins?->count() }}</div>
            <div  style="font-size:10px; font-weight:bold" class="col-2">From : {{ $doctor->shift?->from->format('g:i A') }}</div>
            <div style="font-size:10px; font-weight:bold" class="col-2">To : {{ $doctor->shift?->to->format('g:i A') }} </div>
            <div style="font-size:10px; font-weight:bold" class="col-6">Avilable Days : {{ $doctor->shift?->days?->implode(',') }} </div>
        </div>
    </div>
</div>
<h5>reservatoins :</h5>
<div class="card">
    <div class="card-body ">

        @forelse($doctor->reservatoins as $reservation)
            
            <button class="btn btn-sm {{ auth()->user()->patient?->id == $reservation->patient_id ? "btn-primary" : "btn-info" }} mx-3">{{$reservation->time?->format("g:i A")}}</button>
        @empty
            <div style="text-align:center">
                No Resrvations In The Selected Day
            </div>
        @endforelse

        @if ($doctor->reservatoins)
            <p style="font-weight:bold" class="mt-5">my reservations : <span style="border-radius:0px !important" class="btn-sm btn btn-primary p-2"></span></p>
        @endif

    </div>
</div>

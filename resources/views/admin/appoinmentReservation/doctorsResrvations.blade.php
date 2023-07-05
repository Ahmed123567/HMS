<h5 class = "pt-3">Doctor Rerservations :</h5>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-2">Number Of Resrvations :  {{ $doctor->reservatoins?->count() }}</div>
            <div class="col-2">From : {{ $doctor->shift?->from?->format("g:i A") }}</div>
            <div class="col-2">To : {{ $doctor->shift?->to?->format("g:i A") }} </div>
            <div class="col-6">Avilable Days : {{ $doctor->shift?->days?->implode(",") }} </div>
        </div>
    </div>
</div>
<h5>reservatoins :</h5>

@forelse($doctor->reservatoins as $reservation)
<div class="card">
    <div class="card-body ">
        <div class="row">
            <div class="col-4">patient : {{ $reservation->patient?->name }} </div>
            <div class="col-4">Time : {{ $reservation->time?->format("g:i A") }} </div>
        </div>
    </div>
</div>

@empty
<div style="text-align:center">
    No Resrvations In The Selected Day    
</div>
@endforelse

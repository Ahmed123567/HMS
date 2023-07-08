<h5 class="pt-3">Room Informations :</h5>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-3">Room Beds : {{ $room->number_of_beds }}</div>
            <div class="col-3">
                Avilable Beds : {{ $room->avilableBeds(request('from', now()), request('to', now())) }}
            </div>
            <div class="col-3">
                Total Price : {{ $room->priceInPeriod(request('from', now()), request('to', now())) }}
            </div>
            <div class="col-3">
                @if ($room->isSpecial())
                    <span class="badge bg-success text-white">Special</span>
                @else
                    <span class="badge bg-danger text-white">Not Special</span>
                @endif
            </div>
        </div>
    </div>
</div>
<h5>Reservations :</h5>

@forelse ($room->reservatoins as $reservation)
    <div class="card">
        <div class="card-body ">
            <div class="row">
                <div class="col-3">patient : {{ $reservation->patient->name }}</div>
                <div class="col-3">from : {{ $reservation->from->format('Y-m-d') }}</div>
                <div class="col-3">to : {{ $reservation->to->format('Y-m-d') }}</div>
                <div class="col-3">
                    @if ($reservation->isConfirmed())
                        <span class="badge bg-success text-white">Confirmed</span>
                    @else
                        <span class="badge bg-danger text-white">Not Confirmed</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@empty
    <div style="text-align:center">
        No Resrvations In The Selected Period
    </div>
@endforelse

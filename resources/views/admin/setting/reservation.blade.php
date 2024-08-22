<div class="card " style="width: 80%">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Reservation Settings</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('setting.reservation') }}" method="post" enctype="multipart/form-data">
            @csrf



            <div class="form-group">
                <label for="">Patient Daily Resrvation Limit</label>
                <input type="number" name="reservation_patient_reservation_limit_per_day" class="form-control"
                    value="{{ settings('reservation_patient_reservation_limit_per_day') }}">

                    @error("reservation_patient_reservation_limit_per_day")
                        <p class="text-danger">{{$message}}</p>
                    @enderror
            </div>

            <div class="form-group">
                <label for="">Is Reservation At The Same Time Allowed</label>

                <select class="form-control" name="reservation_is_reservation_at_the_same_time_allowed" id="">
                    @if (settings('reservation_is_reservation_at_the_same_time_allowed') == 0)
                        <option selected value="0">Not Allowed</option>
                        <option value="1">Allowed</option>
                    @else
                        <option value="0">Not Allowed</option>
                        <option selected value="1">Allowed</option>
                    @endif
                </select>
                @error('reservation_is_reservation_at_the_same_time_allowed')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Resrvation Time Slots</label>
                <p class="my-0" style="font-size: 12px; font-weight: 100; opacity: .9;"> - only works if the resrevation at the same
                    time is not allowed </p>
                <p class="mt-0" style="font-size: 12px; font-weight: 100; opacity: .9;"> - patient wont be able to reserve time before and after any resrved time by this time amount</p>

                <input type="number" name="reservation_time_slots_for_appointment" class="form-control"
                    value="{{ settings('reservation_time_slots_for_appointment') }}">

                @error('reservation_time_slots_for_appointment')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

            </div>

            <div>
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </div>

        </form>

    </div>
</div>

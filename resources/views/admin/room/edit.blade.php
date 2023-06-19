<form  class="validate" action="{{ route('room.update', $room->id ) }}" method="post">
    @csrf
    @method("put")
    
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-12 ">
                <label for="">Room Id</label>
                <input type="text" name="room_id" value="{{$room->room_id}}" class="form-control">
            </div>

            <div class="form-group col-12 ">
                <label for="">Number Of Beds</label>
                <input type="number" name="number_of_beds" value="{{$room->number_of_beds}}" class="form-control">
            </div>

            <div class="form-group col-12 ">
                <label for="">One Night Bed Price</label>
                <input type="number" name="one_night_bed_price" value="{{$room->one_night_bed_price}}" class="form-control">
            </div>

            <div class="form-check">
                <input name="is_special" @checked($room->is_special == 1) class="form-check-input" type="checkbox"value="1"  id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Is Special
                </label>
              </div>
           
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn ripple btn-primary" type="submit" id="submit_btn">Save changes</button>
        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
    </div>

</form>

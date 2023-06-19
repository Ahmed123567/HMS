<form  class="validate" action="{{ route('shift.update', $shift->id ) }}" method="post">
    @csrf
    @method("put")
    
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-12 ">
                <label for="">Name</label>
                <input type="text" name="name" value="{{$shift->name}}" class="form-control">
            </div>
            
            <div class="col-6 form-group">
                <label for="">From Time</label>
                <input type="time" class="form-control" name="from" value="{{$shift->from->format   ("H:i")}}">
            </div>
            
            <div class="col-6 form-group">
                <label for="">To Time</label>
                <input type="time" class="form-control" name="to" value="{{$shift->to->format('H:i')}}">
            </div>

            <div class="form-group col-12">
                <label for="">Days</label>
                <select class="form-control" multiple name="days[]">
                    <option @selected($shift->days->contains('sunday')) value="sunday">sunday</option>
                    <option @selected($shift->days->contains('monday')) value="monday">monday</option>
                    <option @selected($shift->days->contains('tuesday')) value="tuesday">tuesday</option>
                    <option @selected($shift->days->contains('wednesday')) value="wednesday">wednesday</option>
                    <option @selected($shift->days->contains('thursday')) value="thursday">thursday</option>
                    <option @selected($shift->days->contains('friday')) value="friday">friday</option>
                    <option @selected($shift->days->contains('saturday')) value="saturday">saturday</option>
                </select>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn ripple btn-primary" type="submit" id="submit_btn">Save changes</button>
        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
    </div>

</form>

<form  class="validate" action="{{ route('shift.store') }}" method="post">
    @csrf
    
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-12 ">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            
            <div class="col-6 form-group">
                <label for="">From Time</label>
                <input type="time" class="form-control" name="from">
            </div>

            <div class="col-6 form-group">
                <label for="">To Time</label>
                <input type="time" class="form-control" name="to">
            </div>

            <div class="form-group col-12">
                <label for="">Days</label>
                <select multiple="multiple" class="form-control" name="days[]">
                    <option value="sunday">sunday</option>
                    <option value="monday">monday</option>
                    <option value="tuesday">tuesday</option>
                    <option value="wednesday">wednesday</option>
                    <option value="thursday">thursday</option>
                    <option value="friday">friday</option>
                    <option value="saturday">saturday</option>
                </select>
            </div>

        </div>
    </div>

    <div class="modal-footer">
        <button class="btn ripple btn-primary" type="submit" id="submit_btn">Save changes</button>
        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
    </div>

</form>

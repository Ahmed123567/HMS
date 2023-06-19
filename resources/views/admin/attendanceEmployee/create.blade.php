<form  class="validate" action="{{ route('attendance.store') }}" method="post">
    @csrf
    
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-12 ">
                <label for="">Transactions File</label>
                <input type="file" name="file" class="form-control">
            </div>
          
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn ripple btn-primary" type="submit" id="submit_btn">Import</button>
        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
    </div>

</form>

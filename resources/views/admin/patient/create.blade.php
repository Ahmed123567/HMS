<form  class="validate" action="{{ route('patient.store') }}" method="post">
    @csrf
    
    <div class="modal-body">
        <div class="row">
            
            <div class="form-group col-6">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control">
            </div>


            <div class="form-group col-6">
                <label for="national_id">National Id</label>
                <input type="integer" name="national_id" class="form-control">
            </div>

            <div class="form-group col-6">
                <label for="national_id">Insurance Number</label>
                <input type="integer" name="insurance_number" class="form-control">
            </div>


            <div class="form-group col-6">
                <label for="">Date Of Birth</label>
                <input type="date" name="date_of_birth" class="form-control">
            </div>

        </div>
    </div>

    <div class="modal-footer">
        <button class="btn ripple btn-primary" type="submit" id="submit_btn">Save changes</button>
        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
    </div>

</form>

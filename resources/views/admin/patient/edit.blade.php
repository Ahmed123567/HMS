<form class="validate" action="{{ route('patient.update', $patient->id ?? 1) }}" method="post">
    @csrf
    @method('put')

    <div class="modal-body">
        <div class="row">
            <div class="form-group col-6">
                <label for="">Name</label>
                <input type="text" name="name" value="{{ $patient->name }}" class="form-control">
            </div>

         

            <div class="form-group col-6">
                <label for="national_id">National Id</label>
                <input type="text" name="national_id" value="{{ $patient->national_id }}" class="form-control">
            </div>

            <div class="form-group col-6">
                <label for="national_id">Insurance Number</label>
                <input type="integer" name="insurance_number" value="{{$patient->insurance_number}}" class="form-control">
            </div>

            
            <div class="form-group col-6">
                <label for="">Date Of Birth</label>
                <input type="date" name="date_of_birth" value="{{ getCarbon($patient->date_of_birth)->format("Y-m-d") }}" class="form-control">
            </div>

            <div class="form-group col-12">
                <label for="">Medical History</label>
                <textarea name="medical_history" class="form-control"  cols="30" rows="5">{{$patient->medical_history}}</textarea>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn ripple btn-primary" type="submit" id="submit_btn">Save changes</button>
        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
    </div>

</form>

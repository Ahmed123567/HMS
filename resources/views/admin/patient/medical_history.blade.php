<form class="validate" action="{{ route('patient.updateHistory', $patient->id) }}" method="post">
    @csrf
    @method('put')

    <div class="modal-body">
        <div class="row">
            <div class="form-group col-12">
                <label for="">Medical History</label>
                <textarea name="medical_history" class="form-control"  cols="30" rows="10">{{$patient->medical_history}}</textarea>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn ripple btn-primary" type="submit" id="submit_btn">Save changes</button>
        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
    </div>

</form>

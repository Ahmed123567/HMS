<form   action="{{ route("appointment.reserve.close", $appointmentResrvation->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="row">
            
            <div class="form-group col-12">
                <label>Patient Diagnosis</label>
                <input name="diagnosis"  class="form-control">
            </div>

            <div class="form-group col-12">
                <label for="">Patient Status Description</label>
                <textarea name="description" class="form-control" id="" cols="30" rows="5"></textarea>
            </div>
         
            <div class="form-group col-12">
                <label>Patient Files</label>
                <input name="files[]" type="file"  class="form-control" multiple>
            </div>

        </div>
    </div>

    <div class="modal-footer">
        <button class="btn ripple btn-primary" type="submit" id="submit_btn">Save changes</button>
        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
    </div>

</form>



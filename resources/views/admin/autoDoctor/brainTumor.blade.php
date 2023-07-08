<form id="covid_form" action="{{ route('autoDoctor.brainTumorCheck') }}" method="post" enctype="multipart/form-data">
    @csrf
    
    <div class="modal-body">
        <div class="row">
            
            <div class="form-group col-6">
                <label for="">X-Ray Image</label>
                <input type="file" name="image" class="form-control">
            </div>

        </div>

        <div class="d-flex justify-content-center"  >
            <div class="spinner-border spinner-border-sm" id="spinner" style="display: none" role="status">
              <span class="sr-only">Loading...</span>
            </div>
        </div>


    </div>


    <div class="modal-footer">
        <button class="btn ripple btn-primary" type="submit" id="submit_btn">Check</button>
        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
    </div>

</form>


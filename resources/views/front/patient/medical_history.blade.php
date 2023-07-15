<div class="modal-body">
    <div class="row">
        <div class="form-group col-12">
            <label for="">Medical History</label>
            <textarea class="mt-3 form-control" disabled   name="" style="font-weight: bold; height: default !important;" id="" cols="30" rows="10">
                {!! auth()->user()->patient?->medical_history ? auth()->user()->patient?->medical_history : "No History" !!}
            </textarea>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
</div>

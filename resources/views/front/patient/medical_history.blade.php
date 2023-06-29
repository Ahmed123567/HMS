<div class="modal-body">
    <div class="row">
        <div class="form-group col-12">
            <label for="">Medical History</label>
            <p class="mt-3" style="font-weight: bold" >{{ auth()->user()->patient?->medical_history ? auth()->user()->patient?->medical_history : "No History" }}</p>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
</div>

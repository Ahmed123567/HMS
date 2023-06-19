<form  class="validate" action="{{ route('role.update', $role->id) }}" method="post">
    @csrf
    @method("put")
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-12">
                <label for="">Name</label>
                <input type="text" name="name" value="{{$role->name}}" class="form-control">
            </div>
            
            @php($permissions = $role->permissions?->pluck("id")->toArray())
            
            <x-permission-componenet :values="$permissions"/>

        </div>
    </div>

    <div class="modal-footer">
        <button class="btn ripple btn-primary" type="submit" id="submit_btn">Save changes</button>
        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
    </div>

</form>

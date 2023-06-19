<form  class="validate" action="{{ route('user.update', $user->id) }}" method="post">
    @csrf
    @method("put")
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-6">
                <label for="">Name</label>
                <input type="text" name="name" value="{{$user->name}}" class="form-control">
            </div>

            <div class="form-group col-6">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" autocomplete="new-password">
            </div>


            <div class="form-group col-6">
                <label for="">Email</label>
                <input type="text" name="email" value="{{$user->email}}" class="form-control">
            </div>

            <div class="form-group col-6">
                <label for="">Phone Number</label>
                <input type="text" name="phone_number" value="{{$user->phone_number}}" class="form-control">
            </div>

            @if ($user->role?->isPatient())
                <div class="form-group col-6">
                    <label for="">Role</label>
                    <select name="role" id="" class="form-control">
                        <option selected value="{{$user->role_id}}">{{$user->role?->name}}</option>
                    </select>
                </div>
            @else
                <x-role-select value="{{$user->role_id}}" :withoutPatient='true' class="col-6" />
            @endif

            
            @if ($user->role?->isPatient())
                <x-employee-select value="{{$user->employee_id}}" class="col-6"  patients='true'/>
            @else
                <x-employee-select value="{{$user->employee_id}}" class="col-6" />
            @endif



            <div class="form-group col-12">
                <label>Profile Picture</label>
                <input name="image" type="file"  class="form-control">
            </div>

        </div>
    </div>

    <div class="modal-footer">
        <button class="btn ripple btn-primary" type="submit" id="submit_btn">Save changes</button>
        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
    </div>

</form>



<form  class="validate" action="{{ route('employee.store') }}" method="post">
    @csrf
    
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-6">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="form-group col-6">
                <label for="job_title">Job Title</label>
                <input type="text" name="job_title" class="form-control">
            </div>

            <div class="form-group col-6">
                <label for="national_id">National Id</label>
                <input type="integer" name="national_id" class="form-control">
            </div>

            <div class="form-group col-6">
                <label for="">Date Of Birth</label>
                <input type="date" name="date_of_birth" class="form-control">
            </div>

            <div class="form-group col-6">
                <label for="">Department</label>
                @if (auth()->user()->isManager())
                    <select class="form-control" name="department_id">
                        <option selected value="{{auth()->user()->managedDepartment()?->id}}">{{auth()->user()->managedDepartment()?->name}}</option>
                    </select>
                @else
                    <x-select-component name="department_id" :models="$departments" > </x-select-component>
                @endif
                
            </div>

            
            <div class="form-group col-6">
                <label for="">Shifts</label>
                <x-select-component name="shift_id" :models="$shifts"> </x-select-component>
            </div>


        </div>
    </div>

    <div class="modal-footer">
        <button class="btn ripple btn-primary" type="submit" id="submit_btn">Save changes</button>
        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
    </div>

</form>

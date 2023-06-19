<form  class="validate" action="{{ route('user.store') }}" method="post">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-6">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="form-group col-6">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" autocomplete="new-password">
            </div>


            <div class="form-group col-6">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control">
            </div>

            <div class="form-group col-6">
                <label for="">Phone Number</label>
                <input type="text" name="phone_number" class="form-control">
            </div>

            <x-role-select class="col-6" />
            <x-employee-select class="col-6" />

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



<script>
    var roleSelect = document.getElementById("role_select");   
    roleSelect.onchange = event => {
        let role = event.target.value;
        let url = '{{route("employee.employeeOrPatient", ":id")}}';

        url = url.replace(":id", role);

        fetch(url).then( async function(response)  {
            let employeesOrPatients = await response.json(); 
            
            let employeeSelect = document.getElementById("employee_select");
            employeeSelect.innerHTML = '';

            employeeSelect.insertAdjacentHTML("beforeend",`<option value="">Select Person</option>`);

            employeesOrPatients.forEach(person => {
                
                employeeSelect.insertAdjacentHTML("beforeend",`<option value="${person.id}">${person.name}</option>`);
            });

        }) 
        .catch(err => {
            console.log(err);
        })

    } 
</script>
<div {{ $attributes->merge(['class' => '']) }}>

    <div class="form-check ml-1">
        <input class="form-check-input" type="checkbox" id="select_permissions">
        <label class="form-check-label" for="select_permissions">Select All</label>
    </div>

    <div class="row" style="justify-content: space-around">
        @foreach ($permissions as $permission)
            <div class="form-check ml-3">

                @if ($values && in_array($permission->id, $values))
                    <input type="checkbox" checked id="{{ $permission->name }}-{{ $permission->id }}"
                        class="form-check-input" name="permissions[]" value="{{ $permission->id }}">
                @else
                    <input type="checkbox" class="form-check-input" id="{{ $permission->name }}-{{ $permission->id }}"
                        name="permissions[]" value="{{ $permission->id }}">
                @endif

                <label class="form-check-label"
                    for="{{ $permission->name }}-{{ $permission->id }}">{{ $permission->name }}</label>
            </div>
        @endforeach
    </div>

    <script>
        var select_all = document.getElementById("select_permissions");

        select_all.onclick = () => {
            let inputs = document.querySelectorAll("input[type=checkbox]");
            inputs.forEach(input => {
                input.checked = select_all.checked;
            });
        }

        var inputs = document.querySelectorAll("input[type=checkbox]");

        inputs.forEach(input => {
            if (input.id == "select_permissions")
                return;

            input.onclick = () => {
                select_all.checked = false;
            }

        })
    </script>

</div>

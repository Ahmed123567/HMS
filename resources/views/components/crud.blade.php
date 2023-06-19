<div style="display:flex">
    <button type="button" data-url="{{ route($editUrl, $model->id) }}" data-toggle="tooltip" title="Edit"
        data-title="Edit" class="modal_btn badge btn btn-primary ">
        <i class="mdi mdi-pen"></i>
    </button>
    @if ($hasDelete === true)
        <form action="{{ route($deleteUrl, $model->id) }}" method="post" class="mx-1">
            @method('delete')
            @csrf
            <button class="delete_button badge btn btn-danger" data-toggle="tooltip" title="Delete" type="submit">
                <i class="mdi mdi-delete"></i>
            </button>
        </form>
    @endif
</div>

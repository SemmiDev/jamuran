<div class="btn-group" role="group" aria-label="Action Buttons">
    <a href="{{ route('admin.shipping_costs.edit', ['id' => $row->id]) }}"
        class="btn btn-sm btn-primary btn-action">Edit</a>
    <form action="{{ route('admin.shipping_costs.destroy', $row->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger btn-action">
            Delete
        </button>
    </form>
</div>

<div class="btn-group" role="group" aria-label="Action Buttons">
    <a href="{{ route('admin.orders.show', ['id' => $row->id, 'status' => request('status')]) }}"
        class="btn btn-sm btn-info">Detail</a>
    <a href="{{ route('admin.orders.edit', ['id' => $row->id, 'status' => request('status')]) }}"
        class="btn btn-sm btn-primary btn-action">Edit</a>
    <form action="{{ route('admin.orders.destroy', ['id' => $row->id, 'status' => request('status')]) }}" method="POST"
        style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger btn-action">
            Hapus
        </button>
    </form>
</div>

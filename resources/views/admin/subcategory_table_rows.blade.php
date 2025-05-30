@foreach($subcategory as $index => $subcat)
<tr>
    <td>{{ $index + 1 }}</td>
    <td>{{ $subcat->heading }}</td>
    <td>{{ $subcat->name }}</td>
    <td>
        <img src="{{ asset('public/upload/subcategory/' . $subcat->image) }}" class="img-thumbnail" style="height: 60px;">
    </td>
    <td>
        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal{{ $subcat->id }}">
            <i class="fa fa-edit"></i>
        </button>
        <a href="{{ route('delete_subcategory', $subcat->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this?')">
            <i class="fa fa-trash"></i>
        </a>
    </td>
</tr>
@endforeach
<div class="d-flex justify-content-center">
    {{ $subcategory->links('pagination::bootstrap-4') }}
</div>

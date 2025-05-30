@extends('admin.layout')

@section('content')
@include('admin.flash')
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Premium</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container mt-5">
        <!-- Tab Navigation -->
        <ul class="nav nav-pills mb-4" id="premiumTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="points-tab" data-bs-toggle="pill" href="#points" role="tab" aria-controls="points" aria-selected="true">
                    <i class="bi bi-coin"></i> Points
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="package-tab" data-bs-toggle="pill" href="#package" role="tab" aria-controls="package" aria-selected="false">
                    <i class="bi bi-box"></i> Package
                </a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="premiumTabContent">
            <!-- Points Tab -->
            <div class="tab-pane fade show active" id="points" role="tabpanel" aria-labelledby="points-tab">
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPointsModal">
                        <i class="bi bi-plus-circle"></i> Add Premium Points
                    </button>
                </div>

                <!-- Points Table -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Premium Points List</h5>
                    </div>
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white">Sl. No.</th>
                                    <th class="text-white">Point</th>
                                    <th class="text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($premium as $key => $val)
                                    <tr>
                                        <td> {{$key + 1}} </td>
                                        <td> {{$val->name}} </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" onclick="delet({{$val->id}})">
                                                <i class="bi bi-trash" onclick="cunfirm('Are you sure to delete?')"></i> Delete
                                            </button>
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="update({{$val->id}})">
                                                <i class="bi bi-pencil"></i> Edit
                                            </button>
                                        </td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Package Tab -->
            <div class="tab-pane fade" id="package" role="tabpanel" aria-labelledby="package-tab">
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPackageModal">
                        <i class="bi bi-plus-circle"></i> Add Premium Package
                    </button>
                </div>

                <!-- Package Table -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Premium Package List</h5>
                    </div>
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white">Sl. No.</th>
                                    <th class="text-white">Name</th>
                                    <th class="text-white">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($prices as $key => $val)
                                    <tr>
                                        <td> {{$key + 1}} </td>
                                        <td> {{$val->name}} </td>
                                        <td> {{$val->price}} </td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Points Modal -->
<div class="modal fade" id="addPointsModal" tabindex="-1" aria-labelledby="addPointsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('premium_points_store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white" id="addPointsLabel">Add Premium Points</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="points" class="form-label">Points</label>
                        <input type="text" placeholder="Enter Points" name="points" id="points" class="form-control rounded-0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Points</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Package Modal -->
<div class="modal fade" id="addPackageModal" tabindex="-1" aria-labelledby="addPackageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('premium_price_store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white" id="addPackageLabel">Add Premium Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Type of Package</label>
                        <select name="name" id="name" class="form-select form-control rounded-0" required>
                            @foreach($prices as $val)
                                <option value="{{$val->id}}"> {{ucfirst($val->name)}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" placeholder="Enter Price" name="price" id="price" class="form-control rounded-0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Package</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Points Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('premium_points_update') }}" method="POST">
                @csrf
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="exampleModalLabel">Update Premium Points</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="updateId" required>
                    <div class="mb-3">
                        <label for="UpdatePoints" class="form-label">Points</label>
                        <input type="text" name="points" id="UpdatePoints" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update Points</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function update(id) {
        fetch("{{ route('premium_id') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            $('#UpdatePoints').val(data.data.name);
            $('#updateId').val(data.data.id);
        })
        .catch(error => {
            console.error("Error fetching premium point:", error);
        });
    }

    function delet(id) {
        fetch("{{ route('premium_points_delete') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                title: "Successfully Deleted!",
                icon: "success",
                draggable: true
            }).then(() => {
                location.reload();
            });
        })
        .catch(error => {
            console.error("Error deleting premium point:", error);
        });
    }
</script>

<!-- Bootstrap & Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

@endsection

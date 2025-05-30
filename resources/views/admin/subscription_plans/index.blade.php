@extends('admin.layout')

@section('content')
@include('admin.flash')
<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Subscription Plan</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
    </div>

    <div class="main-wrapper container mt-5">
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addPackageModal">
                <i class="bi bi-plus-circle"></i> Add Subscription Plan
            </button>
        </div>

        <!-- Package Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">Subscription List</h5>
            </div>
            <div class="card-body">
                <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-white">Sl. No.</th>
                            <th class="text-white">Plan Type</th>
                            <th class="text-white">Price</th>
                            <th class="text-white">Users Allowed</th>
                            <th class="text-white">Duration</th>
                            <!-- <th class="text-white">Created At</th>
                            <th class="text-white">Updated At</th> -->
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subscriptionPlans as $key => $val)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $val->plan_type }}</td>
                            <td>₹{{ $val->price }}</td>
                            <td>{{ $val->no_of_user_allowed }}</td>
                            <td>{{ $val->duration }}</td>
                            <!-- <td>{{ $val->created_at }}</td>
                            <td>{{ $val->updated_at }}</td> -->
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editPackageModal{{ $val->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>

                                <!-- Delete Button -->
                                <form action="{{ route('subscription_plans.destroy', $val->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('Are you sure you want to delete this plan?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>

                        </tr>
                        <!-- Edit Package Modal -->
                        <div class="modal fade" id="editPackageModal{{ $val->id }}" tabindex="-1"
                            aria-labelledby="editPackageLabel{{ $val->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('subscription_plans.update', $val->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header bg-primary text-dark">
                                            <h5 class="modal-title text-white" id="editPackageLabel{{ $val->id }}">Edit
                                                Subscription Plan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="{{ $val->id }}" required>

                                            <div class="mb-3">
                                                <label for="update_plan_type" class="form-label">Plan Type</label>
                                                <select name="plan_type" class="form-select form-control" required>
                                                    <option value="">Select Plan Type</option>
                                                    <option value="Yearly"
                                                        {{ $val->plan_type == 'Yearly' ? 'selected' : '' }}>Yearly
                                                    </option>
                                                    <option value="Quarterly"
                                                        {{ $val->plan_type == 'Quarterly' ? 'selected' : '' }}>Quarterly
                                                    </option>
                                                    <option value="Monthly"
                                                        {{ $val->plan_type == 'Monthly' ? 'selected' : '' }}>Monthly
                                                    </option>
                                                    <option value="Free"
                                                        {{ $val->plan_type == 'Free' ? 'selected' : '' }}>Free
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="update_price" class="form-label">Price</label>
                                                <input type="text" name="price" value="{{ $val->price }}"
                                                    class="form-control" required placeholder="Enter Price">
                                            </div>

                                            <div class="mb-3">
                                                <label for="update_no_of_user_allowed" class="form-label">No. of Users
                                                    Allowed</label>
                                                <input type="number" name="no_of_user_allowed"
                                                    value="{{ $val->no_of_user_allowed }}" class="form-control" required
                                                    placeholder="Enter Number of Users Allowed">
                                            </div>

                                            <div class="mb-3">
                                                <label for="update_duration" class="form-label">Duration
                                                    (Days/Months)</label>
                                                <input type="text" name="duration" value="{{ $val->duration }}"
                                                    class="form-control" required placeholder="e.g. 30 days or 1 month">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Update Plan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>


<!-- Add Package Modal -->
<div class="modal fade" id="addPackageModal" tabindex="-1" aria-labelledby="addPackageLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('subscription_plans.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white" id="addPackageLabel">Add Subscription Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="plan_type" class="form-label">Plan Type</label>
                        <select name="plan_type" id="plan_type" class="form-select rounded-0 form-control" required>
                            <option value="">Select Plan Type</option>
                            <option value="Yearly">Yearly</option>
                            <option value="Quarterly">Quarterly</option>
                            <option value="Monthly">Monthly</option>
                            <option value="Free">Free</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="price" id="price" class="form-control rounded-0" required
                            placeholder="Enter Price">
                    </div>
                    <div class="mb-3">
                        <label for="no_of_user_allowed" class="form-label">No. of Users Allowed</label>
                        <input type="number" name="no_of_user_allowed" id="no_of_user_allowed"
                            class="form-control rounded-0" required placeholder="Enter Number of Users Allowed">
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration (Days/Months)</label>
                        <input type="text" name="duration" id="duration" class="form-control rounded-0" required
                            placeholder="e.g. 30 days or 1 for month and for free 0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add Package</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Bootstrap & Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

@endsection
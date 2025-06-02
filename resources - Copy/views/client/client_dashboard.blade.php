@extends('client.layout')

@section('content')

<div class="page-content py-5" style="background-color: #f8f9fa; min-height: 100vh;">
    <div class="container">

        <!-- Breadcrumb -->
        <div class="row mb-4">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white p-3 rounded shadow-sm">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-2">Total Contact Details</h6>
                            <h4 class="fw-bold mb-0">0</h4>
                        </div>
                        <div class="ms-3 text-primary">
                            <i class="material-icons" style="font-size: 40px;">contacts</i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-2">Total Higher Professional Details</h6>
                            <h4 class="fw-bold mb-0">0</h4>
                        </div>
                        <div class="ms-3 text-success">
                            <i class="material-icons" style="font-size: 40px;">school</i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-2">Total Products Details</h6>
                            <h4 class="fw-bold mb-0">0</h4>
                        </div>
                        <div class="ms-3 text-warning">
                            <i class="material-icons" style="font-size: 40px;">inventory</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Row -->
        <div class="row g-4">
            
            <!-- Left Side -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Savings</h5>
                        <p class="text-muted small">Total savings</p>
                        <h3 class="fw-bold">₹0</h3>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">Popular Products <small class="text-muted">Today</small></h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item small text-muted">No products available</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title fw-bold mb-0">Transactions</h5>
                            <a href="#" class="btn btn-outline-primary btn-sm" title="Refresh">
                                <i class="material-icons">refresh</i>
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Product</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">No transactions found.</td>
                                    </tr>
                                    <!-- Dynamically loop transactions here -->
                                </tbody>
                            </table>
                        </div>     
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection

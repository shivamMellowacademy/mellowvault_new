@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:40px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Customer Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
	                        <tbody>
                                <?php $i=1;
                                foreach($customer as $c) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $c->fname; ?>  <?php echo $c->lname; ?></td>
                                        <td><?php echo $c->email; ?></td>
                                        <td><?php echo $c->phone; ?></td>
                                        <td><?php echo $c->address_one; ?></td>
                                    </tr>
                                <?php $i++;
                                } ?>
	                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
       	</div>
    </div>
</div>
@endsection
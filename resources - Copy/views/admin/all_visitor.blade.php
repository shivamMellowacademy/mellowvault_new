@extends('admin.layout')
@section('content')

<br><br>
<div class="page-content" style="padding-top:30px;">
    <div class="page-info container">       
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Visitor Details</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="complex-header" class="table table-striped table-bordered" style="width:100%">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white">Sl. No.</th>
                                    <th class="text-white">IP Address</th>
                                    <th class="text-white">Date</th>
                                    
                                </tr>
                            </thead>
	                        <tbody>
                                <?php $i=1;
                                    foreach($details as $c) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><p class="btn btn-info"><?php echo $c->ip; ?></p></td>

                                            <td><?php echo $c->date; ?></td>
                                            
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
</div>
@endsection
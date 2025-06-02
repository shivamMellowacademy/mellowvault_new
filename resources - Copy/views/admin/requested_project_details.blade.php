@extends('admin.layout')
@section('content')




<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Requested Developer Details</a></li>
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
                            <thead>
                                <tr>
                                    
                                    <th>Project Image</th>
                                    <th>Project Link</th>
                                    
                                </tr>
                            </thead>
	                        <tbody>
                               <?php
                                    foreach($requested_project_details as $s) { ?>
                                    <tr>
                                        <td><?php echo $s->screenshot_image; ?></td>
                                        <td><?php echo $s->project_link; ?></td>
                                    </tr>
                                <?php } ?>
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
@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Short Message Details</a></li>
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
                                    
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
	                        <tbody>
                                <?php $i=1;
                                    foreach($short_message_details as $sm) { ?>
                                         <tr>
                                            <td><?php echo $i; ?></td>
                                            
                                            <td><?php echo $sm->subject; ?></td>
                                            <td><?php echo $sm->description; ?></td>
                                           
                                            <td><?php echo $sm->date; ?></td>
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
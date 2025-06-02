@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All SOW Details</a></li>
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
                                    <th>SOW DOC</th>
                                    <th>SOW Status</th>
                                    <th>Project Details</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
	                        <tbody>
                                <?php $i=1;
                                    foreach($sow_details as $s) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            
                                            <td>
                                                <?php echo $s->subject; ?>
                                            </td>

                                            <td>
                                                <a href="{{route('sow_download', $s->id )}}" type="button" class="btn btn-danger"><i class="fa fa-download"></i>  Download</a>
                                            </td> 

                                            <?php 
                                                if($s->sow_status == ''){
                                            ?>
                                                <td></td>
                                                <td></td>
                                            <?php }elseif($s->sow_status == '1'){ ?>
                                                <td><p class="btn btn-success">Accept</p></td>
                                                <td><a href="{{ route('sow_project_details',['sow_id'=>''.$s->id.'']) }}" class="btn btn-success">View</a></td>
                                            <?php }elseif($s->sow_status == '2'){ ?>
                                                <td><p class="btn btn-success">Reject</p></td>
                                                <td></td>
                                            <?php } ?>

                                            
                                            
                                            
                                            <td><?php echo $s->date; ?></td>
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
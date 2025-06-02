@extends('admin.layout')
@section('content')

<div class="page-content" style="padding-top:30px;">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Require Docs Details</a></li>
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
                                    <th>Require Docs</th>
                                    
                                    <th>Date</th>
                                </tr>
                            </thead>
	                         <tbody>
                                <?php $i=1;
                                    foreach($require_docs_details as $rd) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            
                                           <td><?php echo $rd->subject; ?></td>
                                           
                                            <td><a href="{{route('require_download', $rd->id )}}" type="button" class="btn btn-danger"><i class="fa fa-download"></i>  Download</a></td>
                                            
                                            <td><?php echo $rd->date; ?></td>
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
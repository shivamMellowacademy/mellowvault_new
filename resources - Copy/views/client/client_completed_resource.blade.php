@extends('client.layout')
@section('content')



<div class="page-content">
    <div class="row">
        <div class="col-lg-8 ml-auto mr-auto">
            @if(Session::has('errmsg'))                 
                <div class="alert alert-{{Session::get('message')}} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>  
                       <strong>{{Session::get('errmsg')}}</strong>
                </div>
                {{Session::forget('message')}}
                {{Session::forget('errmsg')}}
            @endif
            <br><br>
        </div>
    </div>
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Completed Resource Details</a></li>
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
                                        <th>Sl. No.</th>
                                        <th>Developer Name</th>
                                        
                                        <th>Status</th>
                                     
                                    </tr>
                                </thead>
    	                        <tbody>
                                   <?php $i=1;
                                    foreach($client_completed_resource_details as $s) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $s->name; ?> <?php echo $s->last_name; ?></td>
                                            
                                            <td><b style="color:#1e8d26; font-weight: 700; border-color: #3c5570; background-color: #f9f6f6; border: 2px solid transparent; padding: 0.375rem 2.75rem; border-radius: 11px;">COMPLETED</b></td>
                                            
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
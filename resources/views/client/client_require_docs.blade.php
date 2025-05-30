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
                <li class="breadcrumb-item"><a href="#">Require Docs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </nav>
        <nav aria-label="breadcrumb" style="float:right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item back"><a href="{{route('client_resource')}}" class="btn btn-primary">Back</a></li>
                
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
                                    <th>Download</th>
                                    
                                </tr>
                            </thead>
	                        <tbody>
                               <?php $i=1;
                                foreach($client_require_docs_details as $s) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $s->subject; ?></td>
                                        <td><?php echo $s->require_docs; ?></td>
                                        <td>
                                            <a href="{{route('client_require_download', $s->id )}}" type="button" class="btn btn-danger"><i class="fa fa-download"></i>  Download</a>
                                        </td>
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
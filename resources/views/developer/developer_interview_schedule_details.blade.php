@extends('developer.layout')
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
                <li class="breadcrumb-item"><a href="#">Interview Details</a></li>
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
                                   
                                    <th>Client Name</th>
                                    <!--<th>Phone</th>-->
                                    <!--<th>Email</th>-->
                                    <th>Interview Date&Time</th>
                                    <th>Interview Link</th>
                                </tr>
                            </thead>
	                        <tbody>
                               <?php $i=1;
                                foreach($developer_details_interview_schedule as $s) { ?>
                                    <tr>
                                       
                                        <td><?php echo $s->fname; ?> <?php echo $s->lname; ?></td>
                                        <!--<td>< ?php echo $s->phone; ?></td>-->
                                        <!--<td>< ?php echo $s->email; ?></td>-->
                                        <td><?php echo $s->schinterviewdatetime; ?></td>
                                        <td><?php echo $s->interviewlink; ?></td>
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
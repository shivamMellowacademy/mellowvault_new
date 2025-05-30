@extends('developer.layout')
@section('content')

<div class="page-content">
        <div class="page-info container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Created Project</a></li>
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
                                <div class="table-responsive">
                                    <table id="complex-header" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Project Name</th>
                                                <th>Project Duration</th>
                                                <th>Project Price</th>
                                                
                                                <th>Milestone Details</th>
                                                <th>Project Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                            foreach($milestone_project as $s) { ?>
                                                <tr>
                                                    <td><?php echo $s->project_name; ?></td>
                                                    <td><?php echo $s->project_duration; ?></td>
                                                    <td><?php echo $s->project_price; ?></td>
                                                   
                                                    <td><a class="btn btn-success" href="<?php echo route('developer_milestone_details',['project_id'=>''.$s->id.'']) ?>"><i class="fa fa-eye"></i> View</a></td>
                                                     <td><p class="btn btn-warning"><?php echo $s->project_status; ?></p></td>
                                                </tr>
                                            <?php
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
    </div>
@endsection
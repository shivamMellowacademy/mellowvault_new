@extends('admin.layout')
@section('content')

<div class="page-content">
    <div class="page-info container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">All Rating Details</a></li>
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
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                    <th>Rating</th>
                                    <th>IP</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
	                        <tbody>
                                <?php
                                $i=1;
                                foreach($info_details as $info_d) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $info_d->name; ?></td>
                                        <td><img src="<?php echo URL::asset('public/upload/product/'.$info_d->image.'') ?>" alt="Alternate Text" height="50" /></td>
                                        <td><?php echo $info_d->rating; ?></td>
                                        <td><?php echo $info_d->ip; ?></td>
                                        <td><?php echo $info_d->date; ?></td>
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
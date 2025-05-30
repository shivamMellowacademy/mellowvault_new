@extends('front.layout')
@section('content')


<!-- ========================  Blog article ======================== -->

        <section class="blog">

            <!--Header-->

            <header>
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Blogs</a></li>
                    </ol>
                </div>
            </header>

            <!--Blog content-->

            <div class="container">

                <div class="row">

                    <div class="col-lg-9">

                        <?php 
                    		foreach($blog_by_details as $b) { 
                    	?>
                        <div class="blog-post">

                            <div class="blog-post-content">

                                <div class="blog-post-title">

                                    <h2 class="blog-subtitle h5">
                                        <?php echo $b->heading; ?>
                                    </h2>

                                    <hr />

                                    <div class="blog-info">
                                        <div class="entry">
                                            <i class="fa fa-calendar"></i>
                                            <span><?php echo $b->month; ?> <?php echo $b->day; ?> <?php echo $b->year; ?></span>
                                        </div>
                                        
                                    </div>

                                    <hr />

                                </div>

                                <div class="blog-image-main">
                                    <img src="<?php echo URL::asset('public/upload/blog/'.$b->image.'') ?>" alt="" />
                                </div>

                                <div class="blog-post-text">
                                    <p>
                                        <?php echo $b->description; ?>
                                    </p>
                                </div>

                            </div> 

                        </div>
                        
                        <?php
                    		} ?>

                    </div>
                    
                    <!--Blog menu-->

                    <div class="col-lg-3">

                        <aside>

                            <!--Box posts-->

                            <div class="box box-animated box-posts">
                                <h5 class="title">Popular posts</h5>
                                <ul>
                                    <?php
                                        $i=1;
                                        foreach($blogbydetails as $b) {
                                        
                                    ?>
                                    <li>
                                        <a href="<?php echo route('blog_details',['id'=>''.$b->id.'']) ?>">
                                            <span class="date">
                                                <span><?php echo $b->month ?></span>
                                                <span><?php echo $b->day ?></span>
                                            </span>
                                            <span class="text"><?php echo $b->heading ?></span>
                                        </a>
                                    </li>
                                    
                                    <?php } ?>
                          
                                </ul>
                            </div>

                        </aside>

                    </div><!--/col-lg-3-->

                </div> <!--/row-->

            </div><!--/container-->

        </section>


@endsection

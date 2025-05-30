@extends('front.layout')
@section('content')

<!-- ========================  Blog ======================== -->

        <section class="blog blog-category blog-animated">

            <!--Header-->

            <header>
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Blogs</a></li>
                    </ol>
                    <h2 class="title">Blog grid</h2>
                    <div class="text text-dark">
                        <p class="text-dark">Suspendisse scelerisque odio eu felis eleifend</p>
                    </div>
                </div>
            </header>
            <br>

            <div class="container">

                <div class="row">

                    <!--Blog content-->

                    <div class="col-lg-9">

                        <div class="row">

                            <?php
                                $i=1;
                                foreach($blogdetails as $b) {
                                
                            ?>
                            
                            <div class="col-md-6">
                                <article>
                                        <a href="<?php echo route('blog_details',['id'=>''.$b->id.'']) ?>">
                                        <div class="image" style="background-image:url(<?php echo URL::asset('public/upload/blog/'.$b->image.'') ?>)">
                                            <img src="<?php echo URL::asset('public/upload/blog/'.$b->image.'') ?>" alt="" />
                                        </div>
                                        </a>
                                        <div class="entry entry-table">
                                            <div class="date-wrapper">
                                                <a href="<?php echo route('blog_details',['id'=>''.$b->id.'']) ?>">
                                                <div class="date">
                                                    <span class="text-dark"><?php echo $b->month; ?></span>
                                                    <strong class="text-dark"><?php echo $b->day; ?></strong>
                                                    <span class="text-dark"><?php echo $b->year; ?></span>
                                                </div>
                                                </a>
                                            </div>
                                            <div class="title">
                                                <a href="<?php echo route('blog_details',['id'=>''.$b->id.'']) ?>"><h2 class="h5" class="text-dark"><?php echo $b->heading; ?></h2></a>
                                            </div>
                                        </div>
                                </article>
                            </div>
                            
                            <?php 
                               $i++; 
                                } 
                            ?>  

                        </div>

                        <!--Pagination-->

                        
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 pagination-wrapper">
                                    <div class="pagination justify-content-center">
                                        <?php echo $blogpag->links("pagination::bootstrap-4"); ?> 
                                    </div>      
                                </div>
                            </div>
                        

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
                                        foreach($blogdetails as $b) {
                                
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
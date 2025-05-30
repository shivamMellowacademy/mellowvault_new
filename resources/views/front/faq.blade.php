@extends('front.layout')
@section('content')

    <section class="blog blog-category blog-animated">

        <header>
            <div class="container">
                <h2 class="title">Frequently Asked Questions</h2>
            </div>
        </header>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="clearfix">
                        <div class="accordion" id="accordionExample">
                            <?php
                            $i=1;
                            foreach($faq_details as $f) { ?>
                            
                            <div class="card">
                                <div class="card-header" id="heading<?php echo $i; ?>">
                                    <a class="card-link<?php if($i>1) echo "collapsed"; ?> text-dark" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="<?php echo ($i==1) ? 'true': 'false'; ?>" aria-controls="collapse<?php echo $i; ?>">
                                        <?php echo $f->heading; ?>
                                    </a>
                                </div>
                                <div id="collapse<?php echo $i; ?> text-dark" class="panel-collapse collapse show text-justify" aria-labelledby="heading<?php echo $i; ?>" data-parent="#accordionExample">
                                    <div class="card-body text-dark">
                                        <?php echo $f->description; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <?php $i++;
                            } ?>  
                        </div>
                    </div>
                </div>                  
            </div> 
        </div>
    </section>
        
@endsection
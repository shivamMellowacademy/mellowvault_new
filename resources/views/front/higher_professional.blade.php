@extends('front.layout')
@section('content')

    <section class="products">
        <br><br>
        <header>
            <div class="container">
                <h2 class="title">Hire Professional</h2>
                <div class="text text-justify">
                    <p>Hire in Hours. Mellow Elements helps you hire experienced and Trained professionals from over 60,000 people across 10+ categories.</p>
                </div>
            </div>
        </header>

        <div class="container">
            <div class="row">
                <?php
                foreach($higher_professional as $hp) {
                $url = route('dev_details',['id'=>''.$hp->id.'']); ?>
                <div class="col-6 col-lg-3 col-sm-3 col-md-3">
                    <article>
                        <div class="figure-grid">
                            <div class="image">
                                <a href="<?php echo $url; ?>">
                                   <img src="<?php echo URL::asset('public/upload/hig_prof/'.$hp->image.'') ?>" alt=""/> 
                                </a>
                            </div>
                            <div class="text">
                                <h2 class="title h6">
                                    <a href="<?php echo $url; ?>"><?php echo $hp->heading; ?></a>
                                </h2>
                                
                            </div>
                        </div>
                    </article>
                </div>
                <?php
                } ?>
            </div>
        </div>
    </section>

@endsection
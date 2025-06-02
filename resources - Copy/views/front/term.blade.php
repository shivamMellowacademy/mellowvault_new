@extends('front.layout')
@section('content')

<br>

<section class="about">
    <?php 
    foreach($term as $t) { ?>
        <header>
            <div class="container"><h2 class="title"><?php echo $t->heading; ?></h2></div>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="color: #000 !important;">
                    <!--<h4>Divano Store</h4>-->
                    <p class="text-dark"><?php echo $t->description; ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</section>

@endsection
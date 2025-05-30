@extends('front.layout')
@section('content')

<br>

<section class="about">     
    <?php 
    foreach($privacy as $pri) { ?>
        <header>
            <div class="container"><h2 class="title"><?php echo $pri->heading; ?></h2></div>
        </header>
        <div class="container">
            <div class="row">
                  <div class="col-md-12" style="color: #000 !important;">
                    <!--<h4>Divano Store</h4>-->
                    <p><?php echo $pri->description; ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</section>
    
@endsection
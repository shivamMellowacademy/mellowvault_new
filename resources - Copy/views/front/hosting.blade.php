@extends('front.layout')
@section('content')



    <!--Main Navigation-->
  <header>
    <!-- Intro settings -->
    <style>
      #intro {
        /* Margin to fix overlapping fixed navbar */
        margin-top: 58px;
      }

      @media (max-width: 991px) {
        #intro {
          /* Margin to fix overlapping fixed navbar */
          margin-top: 45px;
        }
      }
    </style>


    <!-- Jumbotron -->
    <div id="intro" class="p-3 text-center">
      
    </div>
    <!-- Jumbotron -->
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class="my-4">
    <div class="container">
      <!--Section: Content-->
      <section class="text-center">
        <h4 class="mb-4"><strong>Pricing</strong></h4>

        <div class="btn-group mb-4" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary active">Web Hosting</button>
          <!--<button type="button" class="btn btn-primary">-->
          <!--  Annual billign <small>(2 months FREE)</small>-->
          <!--</button>-->
        </div>

        <div class="row">
        
        <?php 
            foreach($hosting as $host) { ?>
          <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4">

            <!-- Card -->
            <div class="card border border-primary">

              <div class="card-header bg-white py-3">
                <p class="text-uppercase small mb-2"><strong><?php echo $host->hostingname; ?></strong></p>
                <h5 class="mb-0">₹ <?php echo $host->hostingprice; ?>/mo</h5>
              </div>

              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><?php echo $host->feature; ?></li>
                  <!--<li class="list-group-item"><b>20 GB</b> Space</li>-->
                  <!--<li class="list-group-item"><b>100 GB</b> Transfer</li>-->
                  <!--<li class="list-group-item"><b>FREE SSL</b> Certificate</li>-->
                  <!--<li class="list-group-item"><b>5</b> Email(s)</li>-->
                </ul>
              </div>

             
                <div class="card-footer bg-white py-3">
                  <a href="{{ url('buy_now',['id'=>''.$host->id.'']) }}" type="button" class="btn btn-success btn-sm">Buy Now</a>
                </div>
            
            </div>
            <!-- Card -->

          </div>
          
        <?php 
        } ?>


          <!--Grid column-->

          <!--Grid column-->
          <!--<div class="col-lg-3 col-md-6 mb-4">-->

            <!-- Card -->
          <!--  <div class="card border border-primary">-->

          <!--    <div class="card-header bg-white py-3">-->
          <!--      <p class="text-uppercase small mb-2"><strong>Advanced</strong></p>-->
          <!--      <h5 class="mb-0">₹179/mo</h5>-->
          <!--    </div>-->

          <!--    <div class="card-body">-->
          <!--      <ul class="list-group list-group-flush">-->
          <!--        <li class="list-group-item">Host One Website</li>-->
          <!--        <li class="list-group-item"><b>Unmetered</b> Space</li>-->
          <!--        <li class="list-group-item"><b>Unmetered</b> Transfer</li>-->
          <!--        <li class="list-group-item"><b>FREE SSL</b> Certificate</li>-->
          <!--        <li class="list-group-item"><b>Unlimited</b> Email(s)</li>-->
          <!--      </ul>-->
          <!--    </div>-->

          <!--    <div class="card-footer bg-white py-3">-->
          <!--      <button type="button" class="btn btn-info btn-sm">Buy Now</button>-->
          <!--    </div>-->

          <!--  </div>-->
            <!-- Card -->

          <!--</div>-->
          <!--Grid column-->

          <!--Grid column-->
          <!--<div class="col-lg-3 col-md-6 mb-4">-->

            <!-- Card -->
          <!--  <div class="card border border-primary">-->

          <!--    <div class="card-header bg-white py-3">-->
          <!--      <p class="text-uppercase small mb-2"><strong>Pro</strong></p>-->
          <!--      <h5 class="mb-0">₹319/mo</h5>-->
          <!--    </div>-->

          <!--    <div class="card-body">-->
          <!--      <ul class="list-group list-group-flush">-->
          <!--        <li class="list-group-item">Host Unlimited Websites</li>-->
          <!--        <li class="list-group-item"><b>Unmetered</b> Space</li>-->
          <!--        <li class="list-group-item"><b>Unmetered</b> Transfer</li>-->
          <!--        <li class="list-group-item"><b>FREE SSL</b> Certificate</li>-->
          <!--        <li class="list-group-item"><b>Unlimited</b> Email(s)</li>-->
          <!--      </ul>-->
          <!--    </div>-->

          <!--    <div class="card-footer bg-white py-3">-->
          <!--      <button type="button" class="btn btn-info btn-sm">Buy Now</button>-->
          <!--    </div>-->

          <!--  </div>-->
            <!-- Card -->

          <!--</div>-->
          <!--Grid column-->

          <!--Grid column-->
          <!--<div class="col-lg-3 col-md-6 mb-4">-->

            <!-- Card -->
          <!--  <div class="card border border-primary">-->

          <!--    <div class="card-header bg-white py-3">-->
          <!--      <p class="text-uppercase small mb-2"><strong>Cloud Hosting</strong></p>-->
          <!--      <h5 class="mb-0">₹549/mo</h5>-->
          <!--    </div>-->

          <!--    <div class="card-body">-->
          <!--      <ul class="list-group list-group-flush">-->
          <!--        <li class="list-group-item"><b>Unlimited</b> Websites</li>-->
          <!--        <li class="list-group-item"><b>Unmetered SSD</b> Space</li>-->
          <!--        <li class="list-group-item"><b>Unmetered</b> Transfer</li>-->
          <!--        <li class="list-group-item"><b>FREE SSL</b> Certificate </li>-->
          <!--        <li class="list-group-item"><b>4 GB</b> RAM</li>-->
          <!--        <li class="list-group-item"><b>2x</b> Faster Load Time</li>-->
          <!--        <li class="list-group-item"><b>4x</b> Scalable Resources</li>-->
          <!--      </ul>-->
          <!--    </div>-->

          <!--    <div class="card-footer bg-white py-3">-->
          <!--      <button type="button" class="btn btn-info btn-sm">Buy Now</button>-->
          <!--    </div>-->

          <!--  </div>-->
            <!-- Card -->

          <!--</div>-->
          <!--Grid column-->

        </div>
      </section>
      <!--Section: Content-->
    </div>
  </main>
  <!--Main layout-->


@endsection
@extends('front.layout')
@section('content')

<section class="py-5 bg-light">
  <div class="container">
    <?php foreach($about as $a) { ?>  
      <h1 class="display-4 text-center mb-4"><?php echo $a->heading; ?></h1>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <p class="lead text-center text-muted"><?php echo $a->description; ?></p>
        </div>
      </div>
    <?php } ?>
  </div>
</section>

<?php foreach($about as $aa) { ?>
<section class="py-0">
  <div class="container-fluid px-0">
    <div class="about-image-container" style="height: 500px; overflow: hidden;">
      <img src="<?php echo URL::asset('public/upload/about/'.$aa->image.'') ?>" alt="About us" class="img-fluid w-100 h-100" style="object-fit: cover;">
    </div>
  </div>
</section>
<?php } ?>

<section class="py-5 bg-white">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="display-4">Meet The Team</h2>
      <p class="lead text-muted">Hire High-Performance Individuals, On Your Terms</p>
    </div>

    <!-- Team Members -->
    <div class="row">
      <!-- CEO -->
      <div class="col-lg-6 mb-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="row no-gutters h-100">
            <div class="col-md-5">
              <div class="team-img-container h-100">
                <img src="{{ URL::asset('public/upload/team/nikhil.jpeg') }}" class="img-fluid h-100 w-100" alt="Nikhil Kothari" style="object-fit: cover;">
              </div>
            </div>
            <div class="col-md-7">
              <div class="card-body d-flex flex-column h-100">
                <h5 class="card-title text-primary">Nikhil Kothari</h5>
                <h6 class="text-muted mb-3">Chief Executive Officer</h6>
                <p class="card-text small text-dark">Throw him a curve ball and see his ideas thrive in action. Nikhil is unrelenting in breaking down complex issues to their last thread. He brings an interdisciplinary approach with an experience of over 12 years...</p>
                <a href="#" class="btn btn-sm btn-outline-primary mt-auto align-self-start">Read More</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- CTO -->
      <div class="col-lg-6 mb-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="row no-gutters h-100">
            <div class="col-md-5 order-md-2">
              <div class="team-img-container h-100">
                <img src="{{ URL::asset('public/upload/team/vixcy.jpg') }}" class="img-fluid h-100 w-100" alt="Vikash Kumar Pandit" style="object-fit: cover;">
              </div>
            </div>
            <div class="col-md-7 order-md-1">
              <div class="card-body d-flex flex-column h-100">
                <h5 class="card-title text-primary">Vikash Kumar Pandit</h5>
                <h6 class="text-muted mb-3">Chief Technology Officer</h6>
                <p class="card-text small text-dark">Vikash knows the tactic to fix all. He is a doer and has rich experience of working with one of the tech giants in the country. He has delivered 100+ international projects...</p>
                <a href="#" class="btn btn-sm btn-outline-primary mt-auto align-self-start">Read More</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- CFO -->
      <div class="col-lg-6 mb-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="row no-gutters h-100">
            <div class="col-md-5">
              <div class="team-img-container h-100">
                <img src="{{ URL::asset('public/upload/team/Sumit Photo 1.jpg') }}" class="img-fluid h-100 w-100" alt="Sumit Kumar Gugari" style="object-fit: cover;">
              </div>
            </div>
            <div class="col-md-7">
              <div class="card-body d-flex flex-column h-100">
                <h5 class="card-title text-primary">Sumit Kumar Gugari</h5>
                <h6 class="text-muted mb-3">Chief Financial Officer</h6>
                <p class="card-text small text-dark">Sumit truly knows how to lead from the front with his 18+ years of leadership experience with corporate giants such as TransUnion CIBIL, HSBC, JP Morgan, Nomura...</p>
                <a href="#" class="btn btn-sm btn-outline-primary mt-auto align-self-start">Read More</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- CMO -->
      <div class="col-lg-6 mb-4">
        <div class="card h-100 border-0 shadow-sm">
          <div class="row no-gutters h-100">
            <div class="col-md-5 order-md-2">
              <div class="team-img-container h-100">
                <img src="{{ URL::asset('public/upload/team/ashis.jpg') }}" class="img-fluid h-100 w-100" alt="Ashish Kumar Jain" style="object-fit: cover;">
              </div>
            </div>
            <div class="col-md-7 order-md-1">
              <div class="card-body d-flex flex-column h-100">
                <h5 class="card-title text-primary">Ashish Kumar Jain</h5>
                <h6 class="text-muted mb-3">Chief Marketing Officer</h6>
                <p class="card-text small text-dark">Ashish is a digital marketing and cryptocurrency expert. His market knowledge of about 13 years in digital marketing and over 5 years in dealing with crypto space...</p>
                <a href="#" class="btn btn-sm btn-outline-primary mt-auto align-self-start">Read More</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- CLO -->
      <div class="col-lg-6 mb-4 mx-auto">
        <div class="card h-100 border-0 shadow-sm">
          <div class="row no-gutters h-100">
            <div class="col-md-5">
              <div class="team-img-container h-100">
                <img src="{{ URL::asset('public/upload/team/sanjay.jpg') }}" class="img-fluid h-100 w-100" alt="Sanjay Sonkar" style="object-fit: cover;">
              </div>
            </div>
            <div class="col-md-7">
              <div class="card-body d-flex flex-column h-100">
                <h5 class="card-title text-primary">Sanjay Sonkar</h5>
                <h6 class="text-muted mb-3">Chief Legal Officer</h6>
                <p class="card-text small text-dark">A seasoned practitioner Sanjay has multidimensional knowledge of corporate sector and is well skilled in drafting and pleading all kinds of litigations and proceeding...</p>
                <a href="#" class="btn btn-sm btn-outline-primary mt-auto align-self-start">Read More</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  .team-img-container {
    overflow: hidden;
  }
  
  .about-image-container {
    background-color: #f8f9fa; /* Fallback color if image doesn't load */
  }
  
  @media (max-width: 767.98px) {
    .team-img-container {
      height: 250px !important;
    }
  }
</style>

@endsection
@extends('front.layout')

@section('content')

<section class="about py-5 bg-white" style="margin-top: 120px">
    <div class="container text-dark"> <!-- text-dark applies to entire container -->
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="text-center mb-4">
                    <h2 class="font-weight-bold">License Information</h2>
                    <hr class="w-25 mx-auto">
                </div>

                @foreach($license as $lic)
                    <section class="card mb-4 shadow-sm border-0">
                        <div class="card-body">
                            <h4 class="card-title">{!! $lic->heading !!}</h4>
                            <p class="card-text">{!! $lic->description !!}</p>
                        </div>
                    </section>
                @endforeach

            </div>
        </div>
    </div>
</section>

@endsection

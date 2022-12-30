@extends('layouts.app')
@section('content')
<div class="wrapper">
  <!--sidebar wrapper -->
@include('partials.sidebar')
<div class="page-wrapper">
  <div class="page-content">
    @if(empty($totalpoints[0]->suma))
    <?php
      $usertotalpoints = 0;
    ?>
    @else
    <?php
      $usertotalpoints = abs($totalpoints[0]->suma - $totalpoints[1]->suma);
     ?>
    @endif
     <div class="card">
      <div class="row g-0">
        <div class="col-md-5 border-end">
        <div class="image-zoom-section">
          <div class="product-gallery owl-carousel owl-theme border mb-3 p-3" data-slider-id="1">
            <div class="item">
              <img src="{{url('/')}}/assets/images/products/{{$products[0]->photo}}" class="card-img-top" alt="...">
            </div>
            <div class="item">
              <img src="assets/images/products/12.png" class="img-fluid" alt="">
            </div>
            <div class="item">
              <img src="assets/images/products/13.png" class="img-fluid" alt="">
            </div>
            <div class="item">
              <img src="assets/images/products/14.png" class="img-fluid" alt="">
            </div>
          </div>
          <div class="owl-thumbs cthums d-flex justify-content-center" data-slider-id="1">
            <button class="owl-thumb-item">
              <img src="assets/images/products/11.png" class="" alt="">
            </button>
            <button class="owl-thumb-item">
              <img src="assets/images/products/12.png" class="" alt="">
            </button>
            <button class="owl-thumb-item">
              <img src="assets/images/products/13.png" class="" alt="">
            </button>
            <button class="owl-thumb-item">
              <img src="assets/images/products/14.png" class="" alt="">
            </button>
          </div>
        </div>
        </div>
        <div class="col-md-7">
        <div class="card-body">
          <h4 class="card-title">{{$products[0]->title}}</h4>
          <div class="mb-3">
          <span class="price h4">{{$products[0]->points}}</span>
          <span class="text-muted"> Pts.</span>
          </div>
          <p class="card-text fs-6">{{$products[0]->description}}</p>
          <dl class="row">
          <dt class="col-sm-3">Categoria</dt>
          <dd class="col-sm-9">{{$products[0]->category}}</dd>
          </dl>
          <hr>
        <!--end row-->
        <div class="d-flex gap-2 mt-3">
          <form class="" action="{{route('change.store')}}" method="post">
            @csrf
            <input type="hidden" name="id_product" value="{{$products[0]->id}}">
            <button type="submit" <?php if($usertotalpoints < $products[0]->points ){echo "disabled";} ?>  class="btn btn-<?php if($usertotalpoints < $products[0]->points){echo "danger";}else{echo "primary";} ?> px-5 radius-30" name="button">CANJEAR</button>
          </form>
        </div>
        </div>
        </div>
      </div>
      </div>
  </div>
</div>
@endsection

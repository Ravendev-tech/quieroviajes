@extends('layouts.app')
@section('content')
<div class="wrapper">
  <!--sidebar wrapper -->
@include('partials.sidebar')
<div class="page-wrapper">
			<div class="page-content">

				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-lg-4 col-xl-4">
									<div class="totaluserpoints">
									<strong>
										TUS PUNTOS:
										@if(empty($totalpoints[0]->suma))
										<?php
										 	$usertotalpoints = 0;
										?>
										0<small>pts.</small>
										@else
										<?php
											$usertotalpoints = abs($totalpoints[0]->suma - $totalpoints[1]->suma);
										 echo $usertotalpoints;
										 ?> <small>pts.</small>
										@endif
									</strong>
									</div>
									</div>
									<div class="col-lg-8 col-xl-8">
										<form class="">
											<div class="row">
												<div class="col-lg-3">
													<div class="position-relative">
														<input type="text" class="form-control ps-5" placeholder="Buscar..."> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
													</div>
												</div>
												<div class="col-lg-3">
													<div class="">
														<select class="single-select">
															<option value="">Categoria</option>
															<option value="United Kingdom">United Kingdom</option>
															<option value="Bouvet Island">Bouvet Island</option>
															<option value="Western Sahara">Western Sahara</option>
															<option value="Yemen">Yemen</option>
															<option value="Zambia">Zambia</option>
															<option value="Zimbabwe">Zimbabwe</option>
														</select>
													</div>
												</div>
												<div class="col-lg-3">
													<select class="form-select" aria-label="Default select example">
														<option selected>Ordenar por</option>
														<option value="1">One</option>
														<option value="2">Two</option>
														<option value="3">Three</option>
													</select>
												</div>
												<div class="col-lg-3">
													<div class="btn-group">
														<button type="button"  class="btn btn-primary px-5 radius-30" name="button">FILTRAR</button>
									        </div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<ul>
					@forelse($products as $productsItem)
					<li class="product">
						<div class="card">
							<div class="single_product_img">
								<a href="{{route('productdetails',$productsItem->id)}}">
										<img src="{{url('/')}}/assets/images/products/{{$productsItem->photo}}" class="card-img-top" alt="...">
								</a>
								<!-- <div class="position-absolute top-0 end-0 m-3 product-discount"><span class="">-10%</span></div> -->
							</div>
							<div class="card-body">
								<div class="clearfix">
									<h6 class="mb-10 text-center"><strong>{{$productsItem->title}}</strong> </h6>
									<p class="mb-30 text-center fw-bold"><span>{{$productsItem->points}}<small>pts.</small> </span></p>
								</div>
								<div class="col text-center">
									<div class="btn-group">
										<button type="button" <?php if($usertotalpoints < $productsItem->points ){echo "disabled";} ?>  class="btn btn-<?php if($usertotalpoints < $productsItem->points ){echo "danger";}else{echo "primary";} ?> px-5 radius-30" name="button">CANJEAR</button>
									</div>
								</div>
							</div>
						</div>
					</li>
					@empty
					@endforelse
				</ul><!--end row-->


			</div>
		</div>
@endsection

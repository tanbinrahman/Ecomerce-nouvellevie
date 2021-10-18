@extends('front/layout')
@section('front_title','Search page')
@section('styles')
<style>
/* .pagination {
	display: flex;
	padding-left: 0;
	list-style: none;
	border-radius: 0.25rem;
	
  } */
</style>  
@endsection
@section('contant')
	<!--=============================================
    =            breadcrumb area         =
    =============================================-->

	<div class="breadcrumb-area mb-50">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="breadcrumb-container">
						<ul>
							<li><a href="{{ route('front.index') }}"><i class="fa fa-home"></i> Home</a></li>
							<li class="active">Search</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--=====  End of breadcrumb area  ======-->


	<!--=============================================
	=            Shop page container         =
	=============================================-->

	<div class="shop-page-container mb-50">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 order-1 order-lg-2 mb-sm-35 mb-xs-35">

					<!--=======  Shop header  =======-->

					<div class="shop-header mb-35">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-12 d-flex align-items-center">
								<!--=======  view mode  =======-->

								<div class="view-mode-icons mb-xs-10">
									<a class="active" href="#" data-target="grid"><i class="fa fa-th"></i></a>
									<a href="#" data-target="list"><i class="fa fa-list"></i></a>
								</div>

								<!--=======  End of view mode  =======-->

							</div>

						</div>
					</div>

					<!--=======  End of Shop header  =======-->

					<!--=======  Grid list view  =======-->

					<div class="shop-product-wrap grid row no-gutters mb-35">
						@if(isset($products[0]))
                        @foreach ($products as $product)
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                <!--=======  Grid view product  =======-->

                                <div class="gf-product shop-grid-view-product">
                                    <div class="image">
                                        <a href="{{ route('product.view',$product->slug) }}">
                                            <span class="onsale">Sale!</span>
                                            <img src="{{asset('storage/media/product/'.$product->image)}}" class="img-fluid" alt="">
                                        </a>
                                        <div class="product-hover-icons">
                                            <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                            <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="product-title"><a href="{{ route('product.view',$product->slug) }}">{{Str::limit($product->name, $limit = 25, ' ...')}}</a></h3>
                                        <div class="price-box">
                                            <span class="main-price">{{ $products_attr[$product->id][0]->orginal_price }}</span>
                                            <span class="discounted-price">{{ $products_attr[$product->id][0]->offer_price }}</span>
                                        </div>
                                    </div>

                                </div>

                                <!--=======  End of Grid view product  =======-->

                                <!--=======  Shop list view product  =======-->

                                <div class="gf-product shop-list-view-product">
                                    <div class="image">
                                        <a href="{{ route('product.view',$product->slug) }}">
                                            <span class="onsale">Sale!</span>
                                            <img src="{{asset('storage/media/product/'.$product->image)}}" class="img-fluid" alt="">
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="product-title"><a href="{{ route('product.view',$product->slug) }}">{{Str::limit($product->name, $limit = 25, ' ...')}}</a></h3>
                                        <div class="price-box mb-20">
                                            <span class="main-price">{{ $products_attr[$product->id][0]->orginal_price }}</span>
                                            <span class="discounted-price">{{ $products_attr[$product->id][0]->offer_price }}</span>
                                        </div>
                                        <p class="product-description">{{ $product->short_desc }}</p>
                                        <div class="list-product-icons">
                                            <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                            <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> </a>
                                            {{-- <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a> --}}
                                        </div>
                                    </div>

                                </div>

                                <!--=======  End of Shop list view product  =======-->
                            </div>
                                                    
                        @endforeach
						@else
							<h3>No data Found...</h3> 

						@endif	
					</div>

					<!--=======  End of Grid list view  =======-->

					<!--=======  Pagination container  =======-->
					<!--=======  pagination-content  =======-->
						<div class="pagination justify-content-center">
								{{$products->links()}}
						</div>
					<!--=======  End of pagination-content  =======-->

					<!--=======  End of Pagination container  =======-->

				</div>
			</div>
		</div>
	</div>
@endsection
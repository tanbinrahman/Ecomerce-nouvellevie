@extends('front/layout')
@section('front_title','Category Filter')

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
							<li class="active">Shop</li>
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
				<div class="col-lg-3 order-2 order-lg-1">
					<!--=======  sidebar area  =======-->

					<div class="sidebar-area">
						<!--=======  single sidebar  =======-->

						<div class="sidebar mb-35">
							<h3 class="sidebar-title">PRODUCT CATEGORIES</h3>

							<ul class="product-categories">
                                @foreach ($categoryes as $category)
                                    @if($slug==$category->category_slug)
								        <li><a class="active" href="{{ route('product.category_filter',$category->category_slug) }}">{{ $category->category_name }}</a></li>
                                    @else
                                        <li><a  href="{{ route('product.category_filter',$category->category_slug) }}">{{ $category->category_name }}</a></li>
                                    @endif    
                                @endforeach
							</ul>

						</div>

						<!--=======  End of single sidebar  =======-->

						<!--=======  single sidebar  =======-->

						<div class="sidebar mb-35">
							<h3 class="sidebar-title">Filter By Price</h3>
							<div class="sidebar-price">
								<div id="price-range"></div>
								<input type="text" id="price-amount" readonly>
							</div>
						</div>

						<!--=======  End of single sidebar  =======-->
					</div>

					<!--=======  End of sidebar area  =======-->
				</div>
				<div class="col-lg-9 order-1 order-lg-2 mb-sm-35 mb-xs-35">

					{{-- <!--=======  shop page banner  =======-->

					<div class="shop-page-banner mb-35">
						<a href="shop-left-sidebar.html">
							<img src="assets/images/banners/shop-banner.jpg" class="img-fluid" alt="">
						</a>
					</div>

					<!--=======  End of shop page banner  =======--> --}}

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
							<div
								class="col-lg-8 col-md-8 col-sm-12 d-flex flex-column flex-sm-row justify-content-between align-items-left align-items-sm-center">
								<!--=======  Sort by dropdown  =======-->

								<div class="sort-by-dropdown d-flex align-items-center mb-xs-10">
									<p class="mr-10">Sort By: </p>
									<select name="sort-by" onchange="sort_by()" id="sort_by_val" class="nice-select">
										<option value="" selected="Default">Default</option>
										<option value="name">Name</option>
										<option value="price_asc">Sort By Price: Low to High</option>
										<option value="price_desc">Sort By Price: High to Low</option>
										<option value="date">Date</option>
									</select>
									{{ $sort_text }}
								</div>

								<!--=======  End of Sort by dropdown  =======-->

								<p class="result-show-message">Total Product:{{ $count_product }}</p>
							</div>
						</div>
					</div>

					<!--=======  End of Shop header  =======-->

					<!--=======  Grid list view  =======-->

					<div class="shop-product-wrap grid row no-gutters mb-35">
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
                                            {{-- <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                            <a href="#" data-tooltip="Quick view" data-toggle="modal" data-target="#quick-view-modal-container">
                                                <span class="icon_search"></span> </a> --}}
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-categories">
                                            <a href="shop-left-sidebar.html"><span><b>Category:</b></span> {{ $product->category_name }}</a>
                                            
                                        </div>
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
                                        {{-- <div class="product-hover-icons">
                                            <a href="#" data-tooltip="Quick view" data-toggle="modal" data-target="#quick-view-modal-container">
                                                <span class="icon_search"></span> </a>
                                        </div> --}}
                                    </div>
                                    <div class="product-content">
                                        <div class="product-categories">
                                            <a href="shop-left-sidebar.html"><span><b>Category:</b></span> {{ $product->category_name }}</a>
                                            
                                        </div>
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

					</div>

					<!--=======  End of Grid list view  =======-->

					<!--=======  Pagination container  =======-->
					<div class="pagination justify-content-center">
						{{$products->links()}}
					</div>
					<!--=======  End of Pagination container  =======-->

				</div>
			</div>
		</div>
	</div>

	<!--=====  End of Shop page container  ======-->
<form id="productFilter">
	<input type="text" id="sort" name="sort" value="{{ $sort }}"/>
</form>	
@endsection
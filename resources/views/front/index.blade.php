@extends('front/layout')
@section('front_title','Home page')

@section('contant')
    <!--=============================================
	=            Hero slider Area         =
	=============================================-->

    <div class="hero-slider-container mb-35">
        <!--=======  Slider area  =======-->
  
        <div class="hero-slider-one">
          <!--=======  Hero slider item  =======-->
          @foreach ($banners as $banner)
            <div class="hero-slider-item">
                <div class="slider-content">
                    <img src="{{asset('storage/media/banner/'.$banner->image)}}"
                    alt=""
                    style="height: 500px; width: 100%"/>
                </div>
            </div>               
          @endforeach
          <!--=======  End of Hero slider item  =======-->
  
        </div>
    </div>
  
      <!--=====  End of Hero slider Area  ======-->
  
      <!--=============================================
      =            Double banner          =
      =============================================-->
  
    <div class="double-banner-section mb-35">
        <div class="container">
          <div class="row">
            
            @foreach ($promo__banners as $promotion)

                <div class="col-lg-6 col-md-6 col-sm-12 mb-xs-35">
                    <!--=======  single banner  =======-->
    
                    <div class="single-banner">
                        {{-- <a href="{{ url('product/'.$promo__banners_category[$promotion->id][0]->category_slug) }}"> --}}
                        <a data-seq target="_blank" href="{{ $promotion->url }}">
                        <img
                            src="{{asset('storage/media/promo_banner/'.$promotion->image)}}"
                            class="img-fluid"
                            alt=""
                        />
                        </a>
                    </div>
    
                    <!--=======  End of single banner  =======-->
                </div>                
            @endforeach
          </div>
        </div>
    </div>
  
      <!--=====  End of Double banner   ======-->
  
      <!--=============================================
      =            category slider         =
      =============================================-->
  
    <div class="slider category-slider mb-35">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!--=======  category slider section title  =======-->
  
              <div class="section-title">
                <h3>top categories</h3>
              </div>
  
              <!--=======  End of category slider section title  =======-->
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <!--=======  category container  =======-->
  
              <div class="category-slider-container">
                @foreach ($categories as $category)
                    <!--=======  single category  =======-->
                    <div class="single-category">
                    <div class="category-image">
                        <a href="{{ route('product.category_filter',$category->category_slug) }}" title="{{ $category->category_name }}">
                        <img
                            src="{{asset('storage/media/category/'.$category->category_image)}}"
                            class="img-fluid"
                            alt=""
                        />
                        </a>
                    </div>
                    <div class="category-title">
                        <h3>
                        <a href="{{ route('product.category_filter',$category->category_slug) }}"> {{ $category->category_name }}</a>
                        </h3>
                    </div>
                    </div>  
                    <!--=======  End of single category  =======-->
                @endforeach    
              </div>
  
              <!--=======  End of category container  =======-->
            </div>
          </div>
        </div>
    </div>
  
      <!--=====  End of category slider  ======-->
  
      <!--=============================================
      =            Product Slider         =
      =============================================-->
  
      <div class="slider category-slider mb-35">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!--=======  category slider section title  =======-->
  
              <div class="section-title">
                <h3>Our Products</h3>
              </div>
  
              <!--=======  End of category slider section title  =======-->
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <!--=======  category container  =======-->
  
              <div class="tab-slider-container">
                <!--=======  single tab slider item  =======-->
               @foreach ($products as $product)
                <div class="single-tab-slider-item">
                  <!--=======  tab slider sub product  =======-->
                  <div class="gf-product tab-slider-sub-product">
                    <div class="image">
                      <a href="{{ route('product.view',$product->slug) }}">
                        <span class="onsale">Sale!</span>
                        <img
                          src="{{asset('storage/media/product/'.$product->image)}}"
                          class="img-fluid"
                          alt=""
                        />
                      </a>
                      <div class="product-hover-icons">
                        <a class="active" href="#" data-tooltip="Add to cart">
                          <span class="icon_cart_alt"></span
                        ></a>
                        <a href="#" data-tooltip="Add to wishlist">
                          <span class="icon_heart_alt"></span>
                        </a>
                        {{-- <a href="#" data-tooltip="Compare">
                          <span class="arrow_left-right_alt"></span>
                        </a> --}}
                        {{-- <a
                          href="{{ route('front.quickview',$product->id) }}"
                          href="";
                          data-tooltip="Quick view"
                          data-toggle="modal"
                          data-target="#quick-view-modal-container"
                        >
                          <span class="icon_search"></span>
                        </a> --}}
                      </div>
                    </div>
                    <div class="product-content">
                      <h3 class="product-title">
                        <a href="{{ route('product.view',$product->slug) }}"
                          >{{Str::limit($product->name, $limit = 25, ' ...')}}</a
                        >
                        {{-- {{str_limit($biodata ->description, $limit = 20, $end = '...')}} --}}
                      </h3>
                      <div class="price-box">
                        <span class="main-price">৳{{ $products_attr[$product->id][0]->orginal_price}}</span>
                        <span class="discounted-price">৳{{ $products_attr[$product->id][0]->offer_price}}</span>
                      </div>
                    </div>
                  </div>
  
                  <!--=======  End of tab slider sub product  =======-->
                </div>
                                 
               @endforeach   
                <!--=======  End of single tab slider product  =======-->
              </div>
  
              <!--=======  End of category container  =======-->
            </div>
          </div>
        </div>
      </div>
  
      <!--=====  End of Product slider  ======-->

            <!--=============================================
      =            Product Slider         =
      =============================================-->
  
      <div class="slider category-slider mb-35">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!--=======  category slider section title  =======-->
  
              <div class="section-title">
                <h3>Feature Products</h3>
              </div>
  
              <!--=======  End of category slider section title  =======-->
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <!--=======  category container  =======-->
  
              <div class="tab-slider-container">
                <!--=======  single tab slider item  =======-->
               @foreach ($featured_products as $product)
                <div class="single-tab-slider-item">
                  <!--=======  tab slider sub product  =======-->
                  <div class="gf-product tab-slider-sub-product">
                    <div class="image">
                      <a href="{{ route('product.view',$product->slug) }}">
                        <span class="onsale">Sale!</span>
                        <img
                          src="{{asset('storage/media/product/'.$product->image)}}"
                          class="img-fluid"
                          alt=""
                        />
                      </a>
                      <div class="product-hover-icons">
                        <a class="active" href="#" data-tooltip="Add to cart">
                          <span class="icon_cart_alt"></span
                        ></a>
                        <a href="#" data-tooltip="Add to wishlist">
                          <span class="icon_heart_alt"></span>
                        </a>
                        {{-- <a href="#" data-tooltip="Compare">
                          <span class="arrow_left-right_alt"></span>
                        </a> --}}
                        {{-- <a
                          href="{{ route('front.quickview',$product->id) }}"
                          href="";
                          data-tooltip="Quick view"
                          data-toggle="modal"
                          data-target="#quick-view-modal-container"
                        >
                          <span class="icon_search"></span>
                        </a> --}}
                      </div>
                    </div>
                    <div class="product-content">
                      <h3 class="product-title">
                        <a href="{{ route('product.view',$product->slug) }}"
                          >{{Str::limit($product->name, $limit = 25, ' ...')}}</a
                        >
                        {{-- {{str_limit($biodata ->description, $limit = 20, $end = '...')}} --}}
                      </h3>
                      <div class="price-box">
                        <span class="main-price">৳{{ $featured_product_attr[$product->id][0]->orginal_price}}</span>
                        <span class="discounted-price">৳{{ $featured_product_attr[$product->id][0]->offer_price}}</span>
                      </div>
                    </div>
                  </div>
  
                  <!--=======  End of tab slider sub product  =======-->
                </div>
                                 
               @endforeach   
                <!--=======  End of single tab slider product  =======-->
              </div>
  
              <!--=======  End of category container  =======-->
            </div>
          </div>
        </div>
      </div>
  
      <!--=====  End of Product slider  ======-->
  
      <!--=============================================
      =            Blog post slider container         =
      =============================================-->
  
      <div class="slider blog-slider mb-35">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!--=======  blog slider section title  =======-->
  
              <div class="section-title">
                <h3>Nouvelle Vie News</h3>
              </div>
  
              <!--=======  End of blog slider section title  =======-->
            </div>
          </div>
  
          <div class="row">
            <div class="col-lg-12">
              <!--=======  blog slide container  =======-->
  
              <div class="blog-slider-container pt-30 pb-30 pr-30 pl-30">
                <!--=======  single blog post  =======-->
                @foreach ($blogs as $blog)
                <div class="col">
                  <div class="single-post-wrapper">
                    <div class="post-thumb">
                      <a href="blog-post-image-format.html">
                        <img
                          src="{{asset('storage/media/blog/'.$blog->image)}}"
                          class="img-fluid"
                          alt=""
                        />
                      </a>
                    </div>
                    <div class="post-info">
                      <div class="post-meta">
                        <div class="post-date">{{ $blog->created_at }}</div>
                      </div>
                      <h3 class="post-title">
                        <a href="blog-post-image-format.html">{{Str::limit($blog->title, $limit = 50, ' ...')}}</a>
                      </h3>
                      <a href="{{ route('product.single_blog',$blog->id) }}" class="readmore-btn"
                        >continue <i class="fa fa-arrow-right"></i
                      ></a>
                    </div>
                  </div>
                </div>
                                    
                @endforeach
  
                <!--=======  End of single blog post  =======-->
              </div>
  
              <!--=======  End of blog slide container  =======-->
            </div>
          </div>
        </div>
      </div>
  
      <!--=====  End of Blog post slider  ======-->
@endsection
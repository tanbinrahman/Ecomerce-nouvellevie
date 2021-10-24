@extends('front/layout')
@section('front_title','Product page')

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
                            <li><a href="#">{{ $product[0]->category_name }}</a></li>
                            <li class="active">{{ $product[0]->name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====  End of breadcrumb area  ======-->

    <!--=============================================
    =            single product content         =
    =============================================-->

    <div class="single-product-content ">
        <div class="container">
            <!--=======  single product content container  =======-->
            <div class="single-product-content-container mb-35">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-xs-12">

                        <!-- product image gallery -->
                        <div class="product-image-slider d-flex flex-custom-xs-wrap flex-sm-nowrap mb-sm-35">
                            <!--Modal Tab Menu Start-->
                            <div class="product-small-image-list">
                                <div class="nav small-image-slider-single-product" role="tablist">
                                    @php
                                        $loop_count =1;
                                    @endphp
                                    @foreach ($product_images[$product[0]->id] as $product_image )
                                        @php
                                            $number =$loop_count++; 
                                        @endphp 
                                        <div class="single-small-image img-full">
                                            <a data-toggle="tab" id="single-slide-tab-{{ $number }}" href="#single-slide{{ $number }}"><img
                                                    src="{{ asset('storage/media/images/'.$product_image->images) }}" class="img-fluid"
                                                    alt=""></a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!--Modal Tab Menu End-->

                            <!--Modal Tab Content Start-->
                            <div class="tab-content product-large-image-list">
                                @php
                                    $loop_count =1;

                                @endphp
                                @foreach ($product_images[$product[0]->id] as $product_image )
                                    @php
                                        $number =$loop_count++; 
                                        $active_class ="";
                                        if($loop_count ==2){
                                            $active_class ="active";
                                        }
                                    @endphp   
                                    <div class="tab-pane fade show {{ $active_class }}" id="single-slide{{ $number }}" role="tabpane{{ $number }}"
                                        aria-labelledby="single-slide-tab-{{ $number }}">
                                        <!--Single Product Image Start-->
                                        <div class="single-product-img easyzoom img-full">
                                            <img src="{{ asset('storage/media/images/'.$product_image->images) }}" class="img-fluid"
                                                alt="">
                                            <a href="{{ asset('storage/media/images/'.$product_image->images) }}"
                                                class="big-image-popup"><i class="fa fa-search-plus"></i></a>
                                        </div>
                                        <!--Single Product Image End-->
                                    </div>
                                @endforeach    
                            </div>
                            <!--Modal Content End-->

                        </div>
                        <!-- end of product image gallery -->
                    </div>
                    <div class="col-lg-6 col-md-12 col-xs-12">
                        <!-- product quick view description -->
                            @if(session()->has('error'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif
                        <div class="product-feature-details">
                            <h2 class="product-title mb-15">{{ $product[0]->name }}</h2>

                            <h2 class="product-price mb-15">
                                <span>৳{{ $min_price }}-</span>
                                <span>৳{{ $max_price }}</span>
                            </h2>

                            <p class="product-description mb-20">{!! $product[0]->short_desc !!}</p>
                            
                            <div class="color mb-20">
                               <span> Weight:</span> &nbsp;&nbsp;
                                @foreach ($product_attr[$product[0]->id] as $attr )
                                    <a href="javascript:void(0)" class="weight_link" id="weight_{{ $attr->weight }}" onclick=change_product_weight_price("{{ $attr->offer_price }}","{{ $attr->weight }}","{{ $attr->unit }}")><span class="ml-20">{{ $attr->weight }}{{ $attr->unit }}</span></a>
                                @endforeach
                            </div> 
                            <div class="weight-price">
                                
                            </div>                                 
                            


                            <form action="{{ route('addCart') }}" method="POST">
                                @csrf
                                <input type="hidden"  name="product_id" value="{{ $product[0]->id }}">
                                <input type="hidden"  name="name" value="{{ $product[0]->name }}">
                                <input type="hidden"  name="image" value="{{ $product[0]->image }}">
                                <input type="hidden" id="weight_id" name="weight">
                                <input type="hidden" id="price_id" name="price">
                                <input type="hidden" id="unit_id" name="unit">
                                <div class="cart-buttons mb-20">
                                    {{-- <div class="pro-qty mr-20 mb-xs-20">
                                        
                                    </div> --}}
                                    <b>Quantity:</b><input type="number" value="1" id="quantity" name="quantity" min="1" max="{{ $product[0]->quantity }}"><br><br>
                                    {{-- <div class="add-to-cart-btn">
                                        <a href="#"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
                                    </div> --}}
                                    <button class="btn btn-success btn-lg" type="submit" ><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                </div>
                            </form>




                            <div class="single-product-action-btn mb-20">
                                <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span> Add to
                                    wishlist</a>
                                {{-- <a href="#" data-tooltip="Add to compare"> <span class="arrow_left-right_alt"></span>
                                    Add to compare</a> --}}
                            </div>

                            <h3> <span>SKU:</span><a href="#">{{ $product[0]->sku }}</a></h3>
                            <div class="single-product-category mb-20">
                                <h3>Categories: <span><a href="shop-left-sidebar.html">{{ $product[0]->category_name }}</a>
                            </div>

                            <div class="social-share-buttons">
                                <h3>share this product</h3>
                                <ul>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- end of product quick view description -->
                    </div>
                </div>
            </div>

            <!--=======  End of single product content container  =======-->

        </div>

    </div>

    <!--=====  End of single product content  ======-->

    <!--=============================================
    =            single product tab         =
    =============================================-->

    <div class="single-product-tab-section mb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-slider-wrapper">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="description-tab" data-toggle="tab"
                                    href="#description" role="tab" aria-selected="true">Description</a>
                                <a class="nav-item nav-link" id="features-tab" data-toggle="tab" href="#features"
                                    role="tab" aria-selected="false">Features</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel"
                                aria-labelledby="description-tab">
                                <p class="product-desc">{!! $product[0]->description !!}</p>
                            </div>
                            <div class="tab-pane fade" id="features" role="tabpanel" aria-labelledby="features-tab">
                                <table class="table-data-sheet">
                                    <tbody>
                                        <tr class="odd">

                                            <td>Name</td>
                                            <td>{{ $product[0]->name }}</td>
                                        </tr>
                                        <tr class="even">

                                            <td>Image</td>
                                            <td>
                                                @if($product[0]->image!="")
                                                    <a href="{{asset('storage/media/product/'.$product[0]->image)}}" target="_blank">
                                                        <img width="70px" src="{{ asset('storage/media/product/'.$product[0]->image) }}" alt="">
                                                    </a>    
                                                @endif
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====  End of single product tab  ======-->

    <!--=============================================
	=            Related Product slider         =
	=============================================-->

    <div class="slider related-product-slider mb-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  multisale  slider section title  =======-->

                    <div class="section-title">
                        <h3>Related Product</h3>
                    </div>

                    <!--=======  End of multisale slider section title  =======-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  related product slider wrapper  =======-->

                    <div class="related-product-slider-wrapper">
                        @if(isset($related_product[0]))
                        @foreach ($related_product as $product_rel)
                            <!--=======  single related slider product  =======-->
                            <div class="gf-product related-slider-product">
                                <div class="image">
                                    <a href="{{ route('product.view',$product_rel->slug) }}">
                                        <span class="onsale">Sale!</span>
                                        <img src="{{ asset('storage/media/product/'.$product_rel->image) }}" class="img-fluid" alt="">
                                    </a>
                                    <div class="product-hover-icons">
                                        <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                        <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span>
                                        </a>
                                        {{-- <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                        <a href="#" data-tooltip="Quick view" data-toggle="modal"
                                            data-target="#quick-view-modal-container"> <span class="icon_search"></span>
                                        </a> --}}
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="product-categories">
                                        <a href="#">{{ $product_rel->category_name }}</a>
                                        
                                    </div>
                                    <h3 class="product-title"><a href="{{ route('product.view',$product_rel->slug) }}">{{ $product_rel->name }}</a></h3>
                                    <div class="price-box">
                                        <span class="main-price">${{ $related_product_attr[$product_rel->id][0]->orginal_price }}</span>
                                        <span class="discounted-price">${{ $related_product_attr[$product_rel->id][0]->offer_price }}</span>
                                    </div>
                                    <div class="price-box">
                                        <span class="discounted-price">{{ $related_product_attr[$product_rel->id][0]->weight }}{{ $related_product_attr[$product_rel->id][0]->unit }}</span>
                                    </div>
                                </div>

                            </div>
                        @endforeach                            
                        @else
                            <div class="gf-product related-slider-product">
                                no data found
                            </div>    
                        @endif

                        <!--=======  End of single related slider product  =======-->
                    </div>

                    <!--=======  End of related product slider wrapper  =======-->
                </div>
            </div>
        </div>
    </div>

    <!--=====  End of Related product slider  ======-->

    <!--=============================================
	=            Upsell Product slider         =
	=============================================-->

    <div class="slider related-product-slider mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  multisale  slider section title  =======-->

                    <div class="section-title">
                        <h3>Upsell Product</h3>
                    </div>

                    <!--=======  End of multisale slider section title  =======-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--=======  related product slider wrapper  =======-->

                    <div class="related-product-slider-wrapper">
                        <!--=======  single Upsell slider product  =======-->
                        @if(isset($upsell_product[0]))
                        @foreach ($upsell_product as $product_rel)
                            <!--=======  single Upsell slider product  =======-->
                            <div class="gf-product related-slider-product">
                                <div class="image">
                                    <a href="{{ route('product.view',$product_rel->slug) }}">
                                        <span class="onsale">Sale!</span>
                                        <img src="{{ asset('storage/media/product/'.$product_rel->image) }}" class="img-fluid" alt="">
                                    </a>
                                    <div class="product-hover-icons">
                                        <a href="#" data-tooltip="Add to cart"> <span class="icon_cart_alt"></span></a>
                                        <a href="#" data-tooltip="Add to wishlist"> <span class="icon_heart_alt"></span>
                                        </a>
                                        {{-- <a href="#" data-tooltip="Compare"> <span class="arrow_left-right_alt"></span> </a>
                                        <a href="#" data-tooltip="Quick view" data-toggle="modal"
                                            data-target="#quick-view-modal-container"> <span class="icon_search"></span>
                                        </a> --}}
                                    </div>
                                </div>
                                <div class="product-content">
                                    <div class="product-categories">
                                        <a href="#">{{ $product_rel->category_name }}</a>
                                        
                                    </div>
                                    <h3 class="product-title"><a href="{{ route('product.view',$product_rel->slug) }}">{{ $product_rel->name }}</a></h3>
                                    <div class="price-box">
                                        <span class="main-price">${{ $upsell_product_attr[$product_rel->id][0]->orginal_price }}</span>
                                        <span class="discounted-price">${{ $upsell_product_attr[$product_rel->id][0]->offer_price }}</span>
                                    </div>
                                    <div class="price-box">
                                        <span class="discounted-price">{{ $upsell_product_attr[$product_rel->id][0]->weight }}{{ $upsell_product_attr[$product_rel->id][0]->unit }}</span>
                                    </div>
                                </div>

                            </div>
                        @endforeach                            
                        @else
                            <div class="gf-product related-slider-product">
                                no data found
                            </div>    
                        @endif

                        <!--=======  End of single Upsell  slider product  =======-->

                    </div>

                    <!--=======  End of Upsell product slider wrapper  =======-->
                </div>
            </div>
        </div>
    </div>

    <!--=====  End of Upsell product slider  ======-->

@endsection
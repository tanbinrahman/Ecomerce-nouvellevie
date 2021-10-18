<div
class="modal fade quick-view-modal-container"
id="quick-view-modal-container"
tabindex="-1"
role="dialog"
aria-hidden="true"
>
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button
        type="button"
        class="close"
        data-dismiss="modal"
        aria-label="Close"
      >
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      @foreach ($products as $product)
            {{-- @php
              echo '<pre>';
               print_r($quick_products);
               die();     

            @endphp --}}
      <div class="row">
        <div class="col-lg-5 col-md-6 col-xs-12">
          <!-- product quickview image gallery -->
          <div class="product-image-slider">
            <!--Modal Tab Content Start-->
            <div
              class="tab-content product-large-image-list"
              id="myTabContent"
            >
              <div
                class="tab-pane fade show active"
                id="single-slide1"
                role="tabpanel"
                aria-labelledby="single-slide-tab-1"
              >

                <!--Single Product Image Start-->
                <div class="single-product-img img-full">
                  <img
                    src="{{asset('storage/media/product/'.$product->image)}}"
                    class="img-fluid"
                    alt=""
                  />
                </div>
                <!--Single Product Image End-->
              </div>
              @php
                  $loop_count =2;
              @endphp
              @foreach ($product_images[$product->id] as $product_image)
                @php
                   $number =$loop_count++; 
                @endphp
                
              <div
                class="tab-pane fade"
                id="single-slide{{ $number }}"
                role="tabpanel"
                aria-labelledby="single-slide-tab-{{ $number }}"
              >
                <!--Single Product Image Start-->
                <div class="single-product-img img-full">
                  <img
                    src="{{asset('storage/media/images/'.$product_image->images)}}"
                    class="img-fluid"
                    alt=""
                  />
                </div>
                <!--Single Product Image End-->
              </div>
              @endforeach
            </div>
            <!--Modal Content End-->
            <!--Modal Tab Menu Start-->
            <div class="product-small-image-list">
              <div class="nav small-image-slider" role="tablist">
                <div class="single-small-image img-full">
                  <a
                    data-toggle="tab"
                    id="single-slide-tab-1"
                    href="#single-slide1"
                    ><img
                      src="{{asset('storage/media/product/'.$product->image)}}"
                      class="img-fluid"
                      alt=""
                  /></a>
                </div>
                @php
                  $loop_count =2;
                @endphp
                @foreach ($product_images[$product->id] as $product_image)
                  @php
                  $number =$loop_count++; 
                  @endphp
                  <div class="single-small-image img-full">
                    <a
                      data-toggle="tab"
                      id="single-slide-tab-{{ $number }}"
                      href="#single-slide{{ $number }}"
                      ><img
                        src="{{asset('storage/media/images/'.$product_image->images)}}"
                        class="img-fluid"
                        alt=""
                    /></a>
                  </div>                   
                @endforeach  
              </div>
            </div>
            <!--Modal Tab Menu End-->
          </div>
          <!-- end of product quickview image gallery -->
        </div>
        <div class="col-lg-7 col-md-6 col-xs-12">
          <!-- product quick view description -->
          <div class="product-feature-details">
            <h2 class="product-title mb-15">
              {{ $product->name }}
            </h2>

            <h2 class="product-price mb-15">
              <span class="main-price">{{ $products_attr[$product->id][0]->orginal_price}}</span>
              <span class="discounted-price"> ৳{{ $products_attr[$product->id][0]->offer_price}}</span>
            </h2>
            <h2 class="product-price mb-15">
              <span class="discounted-price"> {{ $products_attr[$product->id][0]->weight}}{{ $products_attr[$product->id][0]->unit}}</span>
            </h2>

            <p class="product-description mb-20">
              {!! $product->description !!}
            </p>

            <div class="cart-buttons mb-20">
              <div class="pro-qty mr-10">
                <input type="text" value="1" />
              </div>
              <div class="add-to-cart-btn">
                <a href="#"
                  ><i class="fa fa-shopping-cart"></i> Add to Cart</a
                >
              </div>
            </div>

            <div class="social-share-buttons">
              <h3>share this product</h3>
              <ul>
                <li>
                  <a class="twitter" href="#"
                    ><i class="fa fa-twitter"></i
                  ></a>
                </li>
                <li>
                  <a class="facebook" href="#"
                    ><i class="fa fa-facebook"></i
                  ></a>
                </li>
                <li>
                  <a class="google-plus" href="#"
                    ><i class="fa fa-google-plus"></i
                  ></a>
                </li>
                <li>
                  <a class="pinterest" href="#"
                    ><i class="fa fa-pinterest"></i
                  ></a>
                </li>
              </ul>
            </div>
          </div>
          <!-- end of product quick view description -->
        </div>
      </div>                      
      @endforeach
    </div>
  </div>
</div>
</div>
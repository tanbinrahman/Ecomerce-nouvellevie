<header>
    <!--=======  header top  =======-->

    <div class="header-top pt-10 pb-10 pt-lg-10 pb-lg-10 pt-md-10 pb-md-10">
      <div class="container">
        <div class="row">
          <div
            class="
              col-lg-6 col-md-6 col-sm-6 col-xs-12
              text-center text-sm-left
            "
          >
            <!-- currncy language dropdown -->
            <div class="lang-currency-dropdown">
              <ul>
                <li>
                  <a href="#" style="color: #ffffff"
                    ></a
                  >
                </li>
              </ul>
            </div>
            <!-- end of currncy language dropdown -->
          </div>
          <div
            class="
              col-lg-6 col-md-6 col-sm-6 col-xs-12
              text-center text-sm-right
            "
          >
            <!-- header top menu -->
            <div class="header-top-menu">
              <ul>
                @if(session()->has('FRONT_USER_LOGIN')!=null)
                  <li><a href="my-account.html">My account</a></li>
                @endif
                  <li><a href="wishlist.html">Wishlist</a></li>
                @if(session()->has('FRONT_USER_LOGIN')!=null)
                  <li><a href="checkout.html">Checkout</a></li>
                @endif
                @if(session()->has('FRONT_USER_LOGIN')!=null)
                  <li><a href="{{ url('/logout') }}">Logout</a></li>
                @else 
                  <li><a href="{{ route('registration_page') }}">Registration</a></li>
                  <li><a href="{{ route('login_page') }}">Login</a></li>
                @endif
              </ul>
            </div>
            <!-- end of header top menu -->
          </div>
        </div>
      </div>
    </div>

    <!--=======  End of header top  =======-->

    <!--=======  header bottom  =======-->

    <div class="header-bottom header-bottom-one header-sticky">
      <div class="container">
        <div class="row">
          <div
            class="
              col-md-3 col-sm-12 col-xs-12
              text-lg-left text-md-center text-sm-center
            "
          >
            <!-- logo -->
            <div class="logo mt-15 mb-15">
              <a href="index.html">
                <img src="{{asset('front_assets/assets/images/logo.png')}}" class="img-fluid" alt="" />
              </a>
            </div>
            <!-- end of logo -->
          </div>
          <div class="col-md-9 col-sm-12 col-xs-12">
            <div
              class="
                menubar-top
                d-flex
                justify-content-between
                align-items-center
                flex-sm-wrap flex-md-wrap flex-lg-nowrap
                mt-sm-15
              "
            >
              <!-- header phone number -->
              <div class="header-contact d-flex">
                <div class="phone-icon">
                  <img
                    src="{{asset('front_assets/assets/images/icon-phone.png')}}"
                    class="img-fluid"
                    alt=""
                  />
                </div>
                <div class="phone-number">
                  Phone: <span class="number">(+88) 01730588346</span>
                </div>
              </div>
              <!-- end of header phone number -->
              <!-- search bar -->
              <div class="header-advance-search">
                <form action="#">
                  <input type="text" id="search_str" placeholder="Search your product" />
                  <button type="button" onclick="allsearch()"><span  class="icon_search"></span></button>
                </form>
              </div>
              <!-- end of search bar -->
              <!-- shopping cart -->
              <div class="shopping-cart" id="shopping-cart">
                <a href="cart.html">
                  <div class="cart-icon d-inline-block">
                    <span class="icon_bag_alt"></span>
                  </div>
                  <div class="cart-info d-inline-block">
                    <p>
                      Shopping Cart
                      <span> {{ $CartTotalQuantity }} items - ৳{{ $GetSubTotal }} </span>
                    </p>
                  </div>
                </a>
                <!-- end of shopping cart -->

                <!-- cart floating box -->
                <div class="cart-floating-box" id="cart-floating-box">
                  <div class="cart-items">
                    @foreach ($CartGetContents as $CartGetContent)

                      <div class="cart-float-single-item d-flex">
                        <span class="remove-item"
                          ><a href="{{ route('remove_item',$CartGetContent->id) }}"><i class="fa fa-times"></i></a
                        ></span>
                        <div class="cart-float-single-item-image">
                          <a href="{{ asset('storage/media/product/'.$CartGetContent->attributes->image) }}"
                            ><img
                              src="{{ asset('storage/media/product/'.$CartGetContent->attributes->image) }}"
                              class="img-fluid"
                              alt=""
                          /></a>
                        </div>
                        <div class="cart-float-single-item-desc">
                          <p class="product-title">
                            <a href="single-product.html"
                              >{{ $CartGetContent->name }}</a
                            >
                          </p>
                          <p class="price">
                            <span class="count">{{ $CartGetContent->quantity }}x</span> ৳{{ $CartGetContent->price }} 
                          </p>
                          <p class="price">
                            <span>Total: </span>৳{{ $CartGetContent->quantity*$CartGetContent->price}}
                          </p>
                        </div>
                      </div>  

                    @endforeach
                  </div>
                  <div class="cart-calculation">
                    <div class="calculation-details">
                      <p class="total">Subtotal <span>৳{{ $GetSubTotal }}</span></p>
                    </div>
                    <div class="floating-cart-btn text-center">
                      <a href="checkout.html">Checkout</a>
                      <a href="{{ route('viewCart') }}">View Cart</a>
                    </div>
                  </div>
                </div>
                <!-- end of cart floating box -->
              </div>
            </div>

            <!-- navigation section -->
            <div class="main-menu">
              <nav>
                <ul>
                  {{-- <li class="active"> --}}
                  <li class="">  
                    <a href="{{ route('front.index') }}">HOME</a>
                  </li>
                  <li class="">
                    <a href="shop-left-sidebar.html">About US</a>
                  </li>
                  <li class="">
                    <a href="{{ route('product.shop') }}">Product</a>
                  </li>
                  <li class="">
                    <a href="{{ route('product.blog') }}">BLOG</a>
                  </li>
                  <li><a href="contact.html">CONTACT</a></li>
                </ul>
              </nav>
            </div>
            <!-- end of navigation section -->
          </div>
          <div class="col-12">
            <!-- Mobile Menu -->
            <div class="mobile-menu d-block d-lg-none"></div>
          </div>
        </div>
      </div>
    </div>

    <!--=======  End of header bottom  =======-->
  </header>
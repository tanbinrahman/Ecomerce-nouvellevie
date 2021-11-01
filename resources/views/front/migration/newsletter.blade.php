      <div class="newsletter-section pt-50 pb-50">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 mb-sm-20 mb-xs-20">
              <!--=======  newsletter title =======-->

              <div class="newsletter-title">
                <h1>
                  <img src="{{asset('front_assets/assets/images/icon-newsletter.png')}}" alt="" />
                  Send Newsletter
                </h1>
              </div>

              <!--=======  End of newsletter title  =======-->
            </div>

            <div class="col-lg-8 col-md-12 col-sm-12">
              <!--=======  subscription-form wrapper  =======-->

              <div
                class="
                  subscription-form-wrapper
                  d-flex
                  flex-wrap flex-sm-nowrap
                "
              >
                <p class="mb-xs-20">
                  Sign up for our newsletter to get up-to-date from us
                </p>
                <div class="subscription-form">
                  <form action="{{ route('newsletter') }}" method="POST" >
                    @csrf
                    <input
                      type="email"
                      id="mc-email"
                      name="n_email"
                      {{-- autocomplete="off" --}}
                      placeholder="Your email address"
                    />
                      @error('n_email')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                      @enderror
                    <button id="mc-submit" type="submit">subscribe!</button>
                  </form>

                  <!-- mailchimp-alerts Start -->
                  <div class="mailchimp-alerts">
                    <div class="mailchimp-submitting"></div>
                    <!-- mailchimp-submitting end -->
                    <div class="mailchimp-success"></div>
                    <!-- mailchimp-success end -->
                    <div class="mailchimp-error"></div>
                    <!-- mailchimp-error end -->
                  </div>
                  <!-- mailchimp-alerts end -->
                </div>
              </div>

              <!--=======  End of subscription-form wrapper  =======-->
            </div>
          </div>
        </div>
      </div>
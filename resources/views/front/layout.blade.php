<!DOCTYPE html>
<html class="no-js" lang="zxx">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('front_title','Nouville Vie') </title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Favicon -->
    <link rel="icon" href="{{asset('front_assets/assets/images/favicon.ico')}}" />

    @include('front.migration.styles')
    @yield('styles')
  </head>

  <body>
    <!--=============================================
	=            Header         =
	=============================================-->

    @include('front.migration.header')

    <!--=====  End of Header  ======-->

    @yield('contant')

    <!--=============================================
	=            Footer         =
	=============================================-->

    <footer>
      <!--=======  newsletter section  =======-->

        @include('front.migration.newsletter')        

      <!--=======  End of newsletter section  =======-->

      <!--=======  social contact section  =======-->

      @include('front.migration.contact')

      <!--=======  End of footer navigation  =======-->

      <!--=======  copyright section  =======-->

      @include('front.migration.copyright')

      <!--=======  End of copyright section  =======-->
    </footer>

    <!--=====  End of Footer  ======-->

    <!--=============================================
	=            Quick view modal         =
	=============================================-->



  



    {{-- @include('front.migration.quick') --}}






    <!--=====  End of Quick view modal  ======-->

    <!-- scroll to top  -->
    <a href="#" class="scroll-top"></a>
    <!-- end of scroll to top -->

    <!-- JS
	============================================ -->
  @include('front.migration.script')
  @yield('script')
  </body>
</html>

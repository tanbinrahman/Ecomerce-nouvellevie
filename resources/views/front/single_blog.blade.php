@extends('front/layout')
@section('front_title','Single Blog page')

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
                            <li><a href="{{ route('product.blog') }}">Blog</a></li>
                            <li class="active">Blog Post</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====  End of breadcrumb area  ======-->


    <!--=============================================
    =            Blog Page Container         =
    =============================================-->

    <div class="blog-page-container mb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2">
                    <!--=======  sidebar area  =======-->

                    <div class="sidebar-area">

                        <!--=======  single sidebar  =======-->

                        <div class="sidebar mb-35">
                            <h3 class="sidebar-title">Search</h3>
                            <!--=======  search box  =======-->

                            <div class="sidebar-search-box">
                                <input type="search" placeholder="Search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </div>

                            <!--=======  End of search box  =======-->
                        </div>

                        <!--=======  End of single sidebar  =======-->

                        <!--=======  single sidebar  =======-->

                        <div class="sidebar mb-35">
                            <h3 class="sidebar-title">Recent Posts</h3>
                            <!--=======  block container  =======-->

                            <div class="block-container">

                                <!--=======  single block  =======-->
                                @foreach ($recent_blogs as $recent_blog)
                                    <div class="single-block d-flex">
                                        <div class="image">
                                            <a href="{{asset('storage/media/blog/'.$recent_blog->image)}}" target="_blank">
                                                <img src="{{asset('storage/media/blog/'.$recent_blog->image)}}" class="img-fluid"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <p><a href="{{ route('product.single_blog',$recent_blog->id) }}">{{Str::limit($recent_blog->title ,$limit = 40, ' .....')  }}</a> <span>{{ $recent_blog->created_at }}</span></p>
                                        </div>
                                    </div>
                                @endforeach    

                                <!--=======  End of single block  =======-->

                            </div>

                            <!--=======  End of block container  =======-->
                        </div>

                        <!--=======  End of single sidebar  =======-->

                    </div>

                    <!--=======  End of sidebar area  =======-->
                </div>
                <div class="col-lg-9 order-1 mb-sm-35 mb-xs-35">
                    <!--=======  blog post container  =======-->

                    <div class="blog-single-post-container mb-50">

                        <!--=======  post title  =======-->


                        <h3 class="post-title">{{ $blog[0]->title }}</h3>

                        <!--=======  End of post title  =======-->


                        <!--=======  Post meta  =======-->
                        <div class="post-meta">
                            <p><span><i class="fa fa-calendar"></i> Posted On: <a
                                        href="#">{{ $blog[0]->created_at }}</a></span></p>
                        </div>

                        <!--=======  End of Post meta  =======-->

                        <!--=======  Post media  =======-->

                        <div class="single-blog-post-media mb-xs-20">
                            <div class="image">
                                {{-- <img src="assets/images/single-post-image/blog01.jpg" class="img-fluid" alt=""> --}}
                                <a href="{{asset('storage/media/blog/'.$blog[0]->image)}}" target="_blank">
                                    <img src="{{asset('storage/media/blog/'.$blog[0]->image)}}" class="img-fluid"
                                        alt="">
                                </a>
                            </div>
                        </div>

                        <!--=======  End of Post media  =======-->

                        <!--=======  Post content  =======-->

                        <div class="post-content mb-40">
                            {!! $blog[0]->description !!}
                        </div>

                        <!--=======  End of Post content  =======-->

                        <!--=======  Share post area  =======-->

                        <div class="social-share-buttons mb-40">
                            <h3>share this product</h3>
                            <ul>
                                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>

                        <!--=====  End of Share post area  ======-->

                        <!--=======  related post  =======-->

                        <div class="related-post-container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 class="related-post-title mb-30">RELATED POSTS</h3>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($related_blogs as $related_blog)
                                    <div class="col-lg-4 col-md-4 mb-xs-20">
                                        <!--=======  single related post  =======-->

                                        <div class="single-related-post">
                                            <div class="image">
                                                <a href="{{asset('storage/media/blog/'.$related_blog->image)}}" target="_blank">
                                                    <img src="{{asset('storage/media/blog/'.$related_blog->image)}}" class="img-fluid" alt="">
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h3 class="related-post-title">
                                                    <a href="{{ route('product.single_blog',$related_blog->id) }}">{{ Str::limit($related_blog->title ,$limit= 40 ,' ....') }}</a>
                                                    <span>{{ $related_blog->created_at }}</span>
                                                </h3>
                                            </div>
                                        </div>

                                        <!--=======  End of single related post  =======-->
                                    </div>                                                                    
                                @endforeach
                            </div>
                        </div>

                        <!--=======  End of related post  =======-->

                    </div>

                    <!--=======  End of blog post container  =======-->
                </div>
            </div>
        </div>
    </div>

    <!--=====  End of Blog Page Container  ======-->

@endsection
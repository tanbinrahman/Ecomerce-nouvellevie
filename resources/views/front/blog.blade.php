@extends('front/layout')
@section('front_title','Blog page')

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
                        <li class="active">Blog</li>
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
            <div class="col-lg-3 order-2 order-lg-1">
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
            <div class="col-lg-9 order-1 order-lg-2">
                <!--=======  blog post container  =======-->

                <div class="blog-post-container">

                    <!--=======  single blog post  =======-->
                    @foreach ($blogs as $blog)
                    <div class="single-blog-post mb-35">
                        <div class="row">
                            <div class="col-lg-6 col-md-5">
                                <div class="single-blog-post-media mb-xs-20">
                                    <div class="image">
                                        <a href="{{asset('storage/media/blog/'.$blog->image)}}" target="_blank"><img
                                                src="{{asset('storage/media/blog/'.$blog->image)}}" class="img-fluid"
                                                alt=""></a>
                                    </div>
                                    {{-- <div class="blog-categories">
                                        <ul>
                                            <li><a href="#">Audio</a></li>
                                            <li><a href="#">Travel</a></li>
                                            <li><a href="#">company</a></li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-7">
                                <div class="single-blog-post-content">
                                    <h3 class="post-title"> <a href="{{ route('product.single_blog',$blog->id) }}"> {{ $blog->title }}</a></h3>
                                    <div class="post-meta">
                                        <p> <span><i class="fa fa-calendar"></i> Posted On: <a href="#">{{ $blog->created_at }}</a></span></p>
                                    </div>

                                    <p class="post-excerpt">
                                        {{Str::limit($blog->description , $limit = 250, ' ...')}}
                                    </p>
                                    <a href="{{ route('product.single_blog',$blog->id) }}" class="blog-readmore-btn">continue</a>
                                </div>
                            </div>
                        </div>
                    </div>                               
                    @endforeach
                    <!--=======  End of single blog post  =======-->
                </div>
                <!--=======  End of blog post container  =======-->

                <!--=======  Pagination container  =======-->
                <div class="pagination justify-content-center">
                    {{$blogs->links()}}
                </div>
                {{-- <div class="pagination-container mb-sm-35 mb-xs-35">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <!--=======  pagination-content  =======-->

                                <!--=======  End of pagination-content  =======-->
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!--=======  End of Pagination container  =======-->
            </div>
        </div>
    </div>
</div>

<!--=====  End of Blog Page Container  ======-->
@endsection
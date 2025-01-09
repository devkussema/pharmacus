@extends('korona.layout')

@section('titulo', '@')

@section('content')
    <section class="page-title" style="background-image:url({{ asset('landingpage/images/background/5.jpg') }})">
        <div class="auto-container">
            <h1>Blog Details</h1>
            <ul class="page-breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="blog.html">News Blog</a></li>
                <li>Post Detail</li>
            </ul>
        </div>
    </section>

    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row">
                <!--Content Side-->
                <div class="content-side col-lg-8">
                    <!--Blog Single-->
                    <div class="blog-single">
                        <div class="inner-box">
                            <div class="image">
                                <img src="{{ asset('landingpage/images/resource/news-10.jpg')}}" alt="" />
                            </div>
                            <div class="lower-content">
                                <ul class="post-meta">
                                    <li><a href="#">Coronavirus,</a></li>
                                    <li><a href="#">Prevention,</a></li>
                                    <li><a href="#">Spread,</a></li>
                                </ul>
                                <h2>Steps to Prevent Illness</h2>
                                <div class="text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem consequuntur
                                        sed doloremque eos id nobis voluptatem, sit est pariatur, ducimus
                                        consequatur velit! Quidem doloremque repudiandae, cupiditate officiis quo
                                        tempora totam. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Autem consequuntur sed doloremque eos id nobis voluptatem, sit est pariatur,
                                        ducimus consequatur velit! Quidem doloremque repudiandae, cupiditate
                                        officiis quo tempora totam.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem consequuntur
                                        sed doloremque eos id nobis voluptatem, sit est pariatur, ducimus
                                        consequatur velit! Quidem doloremque repudiandae, cupiditate officiis quo
                                        tempora totam. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Autem consequuntur.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem consequuntur
                                        sed doloremque eos id nobis voluptatem, sit est pariatur, ducimus
                                        consequatur velit! Quidem doloremque repudiandae, cupiditate officiis quo
                                        tempora totam.</p>
                                    <h3>consequatur velit! Quidem doloremque</h3>
                                    <p>doloremque eos id nobis voluptatem, sit est pariatur, ducimus consequatur
                                        velit! Quidem doloremque repudiandae, cupiditate officiis quo tempora totam.
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem consequuntur
                                        sed doloremque eos id nobis voluptatem.</p>
                                    <ul class="list-style-two">
                                        <li>Autem consequuntur sed doloremque eos id nobis</li>
                                        <li>Autem consequuntur sed doloremque eos</li>
                                        <li>Consequuntur sed doloremque eos id nobis</li>
                                        <li>Consequuntur sed doloremque</li>
                                    </ul>
                                    <div class="two-column row clearfix">
                                        <div class="column col-lg-6 col-md-6 col-sm-12">
                                            <h3>Cupiditate officiis quo tempora</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem
                                                consequuntur sed doloremque eos id nobis voluptatem, sit est
                                                pariatur, ducimus consequatur velit! Quidem doloremque repudiandae,
                                                cupiditate officiis quo tempora totam. Lorem ipsum dolor sit amet,
                                                consectetur adipisicing elit. Autem consequuntur.</p>
                                            <p>Autem consequuntur sed doloremque eos id nobis voluptatem, sit est
                                                pariatur, ducimus consequatur velit! Quidem doloremque repudiandae,
                                                cupiditate officiis quo tempora totam.</p>

                                        </div>
                                        <div class="column col-lg-6 col-md-6 col-sm-12">
                                            <div class="image">
                                                <img src="{{ asset('landingpage/images/resource/news-14.jpg') }}" alt="" />
                                            </div>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem consequuntur
                                        sed doloremque eos id nobis voluptatem, sit est pariatur, ducimus
                                        consequatur velit! Quidem doloremque repudiandae, cupiditate officiis quo
                                        tempora totam. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Autem consequuntur.</p>
                                </div>
                                <!--post-share-options-->
                                <div class="post-share-options">
                                    <div class="tags"><span>Tags: </span><a href="#">Coronavirus,</a> <a
                                            href="#">Prevention,</a> <a href="#">Contagion,</a></div>
                                </div>
                            </div>
                        </div>

                        <!--Author Box-->
                        <div class="author-box">
                            <div class="author-comment">
                                <div class="inner">
                                    <div class="image"><img src="{{ asset('landingpage/images/resource/author-9.jpg') }}" alt="" /></div>
                                    <h3>Willliam Timber</h3>
                                    <div class="author">Post Author</div>
                                    <div class="text">Evisculate holistic innovation rather than client-centric
                                        data. Progressively maintain extensive infos mediaries via extensible niche
                                        dramatically search engine deals.</div>
                                </div>
                            </div>
                        </div>

                        <!--Comments Area-->
                        <div class="comments-area">
                            <div class="group-title">
                                <h2>Comments (2)</h2>
                            </div>
                            <!--Comment Box-->
                            <div class="comment-box">
                                <div class="comment">
                                    <div class="author-thumb"><img src="{{ asset('landingpage/images/resource/author-10.jpg') }}" alt=""></div>
                                    <div class="comment-inner clearfix">
                                        <div class="comment-info clearfix"><strong>Lisa Terace</strong>
                                            <div class="comment-time">November 25, 2019 at 7:05 PM</div>
                                        </div>
                                        <div class="text">Evisculate holistic innovation rather than client-centric
                                            data. Progressively maintain extensive infos mediaries via extensible
                                            niche dramatically search engine deals.</div>
                                        <a class="comment-reply" href="#">Reply <span
                                                class="arrow flaticon-next-5"></span></a>
                                    </div>
                                </div>
                            </div>

                            <!--Comment Box-->
                            <div class="comment-box">
                                <div class="comment">
                                    <div class="author-thumb"><img src="{{ asset('landingpage/images/resource/author-11.jpg') }}" alt=""></div>
                                    <div class="comment-inner clearfix">
                                        <div class="comment-info clearfix"><strong>John Dwell</strong>
                                            <div class="comment-time">November 25, 2019 at 7:05 PM</div>
                                        </div>
                                        <div class="text">Evisculate holistic innovation rather than client-centric
                                            data. Progressively maintain extensive infos mediaries via extensible
                                            niche dramatically search engine deals.</div>
                                        <a class="comment-reply" href="#">Reply <span
                                                class="arrow flaticon-next-5"></span></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--End Comments Area-->

                        <!-- Comment Form -->
                        <div class="comment-form">

                            <div class="group-title">
                                <h2>Leave a Comment</h2>
                            </div>

                            <!--Comment Form-->
                            <form method="post" action="https://azim.commonsupport.com/korona/contact.html">
                                <div class="row clearfix">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <input type="text" name="username" placeholder="Your Name" required>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <input type="email" name="email" placeholder="Email" required>
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <textarea class="darma" name="message" placeholder="Add Comment"></textarea>
                                    </div>

                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <button class="theme-btn post-btn" type="submit" name="submit-form"><span
                                                class="txt">post comment</span></button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!--End Comment Form -->

                    </div>
                </div>
                <!--Sidebar Side-->
                <div class="sidebar-side right-sidebar col-lg-4">
                    <aside class="sidebar">

                        <!--search box-->
                        <div class="widget widget_search">
                            <div class="sidebar-title">
                                <h2>Search</h2>
                            </div>
                            <form method="post" action="https://azim.commonsupport.com/korona/blog.html">
                                <div class="form-group">
                                    <input type="search" name="search-field" value="" placeholder="Search Blog"
                                        required="">
                                    <button type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>
                        </div>

                        <!-- Categories -->
                        <div class="widget widget_categories">
                            <div class="sidebar-title">
                                <h2>Categories</h2>
                            </div>
                            <ul class="category-list">
                                <li><a href="#">Coronavirus and COVID-19</a></li>
                                <li><a href="#">Coronavirus spread</a></li>
                                <li><a href="#">Symptoms of COVID-19</a></li>
                                <li><a href="#">Virus Treated</a></li>
                                <li><a href="#">Wear a face mask</a></li>
                                <li><a href="#">Coronavirus Prevention</a></li>
                            </ul>
                        </div>

                        <!-- Popular Posts -->
                        <div class="widget widget_popular_posts">
                            <div class="sidebar-title">
                                <h2>Recent Posts</h2>
                            </div>

                            <article class="post">
                                <figure class="post-thumb"><img src="{{ asset('landingpage/images/resource/post-thumb-1.jpg') }}" alt=""><a
                                        href="blog-single.html" class="overlay-box"><span
                                            class="icon fa fa-link"></span></a></figure>
                                <div class="text"><a href="blog-single.html">Steps to Prevent Illness</a></div>
                                <div class="post-info">Jan 30, 2020</div>
                            </article>

                            <article class="post">
                                <figure class="post-thumb"><img src="{{ asset('landingpage/images/resource/post-thumb-2.jpg') }}" alt=""><a
                                        href="blog-single.html" class="overlay-box"><span
                                            class="icon fa fa-link"></span></a></figure>
                                <div class="text"><a href="blog-single.html">Keep Work, For Safe Communities</a>
                                </div>
                                <div class="post-info">Jan 30, 2020</div>
                            </article>

                            <article class="post">
                                <figure class="post-thumb"><img src="{{ asset('landingpage/images/resource/post-thumb-3.jpg') }}" alt=""><a
                                        href="blog-single.html" class="overlay-box"><span
                                            class="icon fa fa-link"></span></a></figure>
                                <div class="text"><a href="blog-single.html">Keep Work, For Safe Communities</a>
                                </div>
                                <div class="post-info">Jan 30, 2020</div>
                            </article>

                        </div>

                        <!-- Instagram Widget -->
                        <div class="widget widget_instagram">
                            <div class="sidebar-title">
                                <h2>Instagram</h2>
                            </div>
                            <div class="images-outer clearfix">
                                <!--Image Box-->
                                <figure class="image-box"><a href="images/gallery/1.jpg') }}" class="instagram-image"
                                        data-caption="" data-fancybox="images" title="Image Title Here"
                                        data-fancybox-group="footer-gallery"><span
                                            class="overlay-box flaticon-add"></span></a>
                                    <img src="{{ asset('landingpage/images/gallery/instagram-1.jpg') }}" alt="">
                                </figure>
                                <!--Image Box-->
                                <figure class="image-box"><a href="images/gallery/2.html" class="instagram-image"
                                        data-caption="" data-fancybox="images" title="Image Title Here"
                                        data-fancybox-group="footer-gallery"><span
                                            class="overlay-box flaticon-add"></span></a>
                                    <img src="{{ asset('landingpage/images/gallery/instagram-2.jpg') }}" alt="">
                                </figure>
                                <!--Image Box-->
                                <figure class="image-box"><a href="images/gallery/3.html" class="instagram-image"
                                        data-caption="" data-fancybox="images" title="Image Title Here"
                                        data-fancybox-group="footer-gallery"><span
                                            class="overlay-box flaticon-add"></span></a>
                                    <img src="{{ asset('landingpage/images/gallery/instagram-3.jpg') }}" alt="">
                                </figure>
                                <!--Image Box-->
                                <figure class="image-box"><a href="images/gallery/4.html" class="instagram-image"
                                        data-caption="" data-fancybox="images" title="Image Title Here"
                                        data-fancybox-group="footer-gallery"><span
                                            class="overlay-box flaticon-add"></span></a>
                                    <img src="{{ asset('landingpage/images/gallery/instagram-4.jpg') }}" alt="">
                                </figure>
                                <!--Image Box-->
                                <figure class="image-box"><a href="images/gallery/1.jpg') }}" class="instagram-image"
                                        data-caption="" data-fancybox="images" title="Image Title Here"
                                        data-fancybox-group="footer-gallery"><span
                                            class="overlay-box flaticon-add"></span></a>
                                    <img src="{{ asset('landingpage/images/gallery/instagram-5.jpg') }}" alt="">
                                </figure>
                                <!--Image Box-->
                                <figure class="image-box"><a href="images/gallery/2.html" class="instagram-image"
                                        data-caption="" data-fancybox="images" title="Image Title Here"
                                        data-fancybox-group="footer-gallery"><span
                                            class="overlay-box flaticon-add"></span></a>
                                    <img src="{{ asset('landingpage/images/gallery/instagram-6.jpg') }}" alt="">
                                </figure>
                            </div>
                        </div>

                        <!-- Popular Tags -->
                        <div class="widget widget_popular_tags">
                            <div class="sidebar-title style-two">
                                <h2>Tags</h2>
                            </div>
                            <a href="#">Coronavirus</a>
                            <a href="#">Symptoms</a>
                            <a href="#">Prevention</a>
                            <a href="#">Contagion</a>
                            <a href="#">Mask</a>
                            <a href="#">Heigh Fever</a>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection

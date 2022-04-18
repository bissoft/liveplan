@extends('layouts.admin.master')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('reach-top/assets/css/swiper.min.css')}}">
@endsection
@section('content')
    <div class="col-10 col-md-8 py-4 px-md-5">
        @include('admin.includes.header')
        <div class="d-flex flex-wrap justify-content-between">
            <h5 class="dashbord-title position-relative">Chat</h5>
        </div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($users as $user)
                    <div class="swiper-slide">
                        <div class="card-image" title="{{$user->first_name." ".$user->last_name}}">
                            <a href="{{route('chat.index',$user->id)}}">
                                <img src="{{(isset($user->picture))?asset('assets/images/profile/'.$user->picture):asset('assets/images/profile/profile.png')}}"
                                     alt="{{$user->first_name." ".$user->last_name}}">
                                {{--<p>{{$user->first_name." ".$user->last_name}}</p>--}}
                            </a>
                        </div>
                    </div>
                @endforeach
                {{--<div class="swiper-slide">
                    <div class="card-image">
                        <img src="{{asset('reach-top/assets/img/profile-img.png')}}" alt="Profile Image">
                    </div>
                </div>--}}
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Scrollbar -->
            <div class="swiper-button-next">
                <i class="fas fa-chevron-circle-right arrow-icon"></i>
            </div>
            <div class="swiper-button-prev">
                <i class="fas fa-chevron-circle-left arrow-icon"></i>
            </div>
        </div>
        <div class="caht-person card my-5 px-3">
            <div class="media text-center">
                <p>select an athlete to chat with.</p>
            </div>
        </div>
    </div>
    @include('admin.includes.right-side')
@endsection
@section('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
    <script type="text/javascript">
        // Swiper Config
        var swiper = new Swiper(".swiper-container", {
            slidesPerView: 6.5,
            spaceBetween: 10,
            centeredSlides: true,
            // freeMode: true,
            // grabCursor: true,
            loop: true,

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            breakpoints: {
                500: {
                    slidesPerView: 2.5
                },
                770: {
                    slidesPerView: 4
                },
                1050: {
                    slidesPerView: 5
                },
            }
        });

    </script>
@endsection
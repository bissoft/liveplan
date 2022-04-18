<?php
$data = content();
?>@extends('layouts.app')
@section('content')
<div class="cs-height_90 cs-height_lg_90"></div>

<!-- Start Hero -->
<div class="cs-hero cs-style2 cs-center">
  <div class="container">
    <div class="cs-hero_text wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
      <div class="cs-hero_subtitle">{!!$data['#top_banner']['heading']??''!!}</div>
      <h1 class="cs-hero_title cs-medium"> <b class="cs-bold cs-accent_color">{!!$data['#top_banner']['description']??''!!}</h1>
      <div class="cs-hero_btn">
        <a href="contact.html" class="cs-btn cs-style2 cs-btn_lg cs-accent_bg cs-medium">Get Started</a>
      </div>
    </div>
  </div>
  <div class="cs-hero_img cs-parallax wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
    <div class="cs-to_right">
      <img src="{{asset($data['#top_banner']['image']??'assets/img/marketing/hero-img.png')}}" alt="">
    </div>
  </div>
</div>
<!-- End Hero -->

<div class="cs-height_80 cs-height_lg_0"></div>
<!-- Start Service -->
<div class="cs-bg1" data-src="https://multim-html.vercel.aassets/img/marketing/icon-box.svg">
  <div class="cs-height_135 cs-height_lg_75"></div>
  <div class="container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
    <div class="cs-section_heading cs-style2 cs-size1">
      <div class="cs-section_subtitle">{!!$data['#home_service']['title']??''!!}</div>
      <h2 class="cs-section_title cs-medium">{!!$data['#home_service']['heading']??''!!}</b></h2>
    </div>
    <div class="cs-height_65 cs-height_lg_35"></div>
  </div>
  <div class="container wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
    <div class="row">
      @foreach ($service as $item)
      <div class="col-lg-4">
        <a href="#" class="cs-icon_box cs-style2 cs-accent_bg_hover">
          <div class="cs-icon_box_icon cs-center cs-accent_15_bg">
            <span class="{{$item->icon??''}}"></span>
            {{-- <svg width="78" height="73" viewBox="0 0 78 73" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M67.2 58.3C66.9 58.6 66.5 58.9 66.1 59.2L68.7 61.8L70.7 59.8L68.1 57.2C67.8 57.6 67.5 57.9 67.2 58.3Z" fill="#00BB85" stroke="#350C0C" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M67.2 46.1C63.8 42.7 58.4 42.7 55.1 46.1C51.8 49.5 51.7 54.9 55.1 58.2C58.5 61.6 63.9 61.6 67.2 58.2C70.5 54.9 70.5 49.5 67.2 46.1Z" stroke="#472313" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M70.3 60.3L69.2 61.4C68.8 61.8 68.8 62.4 69.2 62.8L73.9 67.5C74.3 67.9 74.9 67.9 75.3 67.5L76.4 66.4C76.8 66 76.8 65.4 76.4 65L71.7 60.3C71.3 59.9 70.7 59.9 70.3 60.3Z" fill="#00BB85" stroke="#350C0C" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M61.1 47.9C63.5 47.9 65.4 49.8 65.4 52.2" stroke="#472313" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M14.1 4.7H9C8.6 4.7 8.4 4.4 8.4 4.1C8.4 3.7 8.7 3.5 9 3.5H14.1C14.5 3.5 14.7 3.8 14.7 4.1C14.8 4.4 14.5 4.7 14.1 4.7Z" fill="#FF8345"/>
              <path d="M11.6 7.3C11.2 7.3 11 7 11 6.7V1.5C11 1.1 11.3 0.900002 11.6 0.900002C12 0.900002 12.2 1.2 12.2 1.5V6.6C12.2 7 11.9 7.3 11.6 7.3Z" fill="#FF8345"/>
              <path d="M6.4 10.5H1.3C0.900001 10.5 0.700001 10.2 0.700001 9.9C0.700001 9.5 1 9.3 1.3 9.3H6.4C6.8 9.3 7 9.6 7 9.9C7.1 10.2 6.8 10.5 6.4 10.5Z" fill="#472313"/>
              <path d="M3.8 13.1C3.4 13.1 3.2 12.8 3.2 12.5V7.4C3.2 7 3.5 6.8 3.8 6.8C4.2 6.8 4.4 7.1 4.4 7.4V12.5C4.5 12.8 4.2 13.1 3.8 13.1Z" fill="#472313"/>
              <path d="M74.5 20.8H9C8.6 20.8 8.4 20.5 8.4 20.2V13.1C8.4 11 10.1 9.2 12.3 9.2H71.4C73.5 9.2 75.3 10.9 75.3 13.1V20.2C75.1 20.5 74.9 20.8 74.5 20.8ZM9.6 19.5H73.8V13.1C73.8 11.7 72.6 10.5 71.2 10.5H12.2C10.8 10.5 9.6 11.7 9.6 13.1V19.5Z" fill="#472313"/>
              <path d="M13.5 17.6C12.1 17.6 10.9 16.4 10.9 15C10.9 13.6 12.1 12.4 13.5 12.4C14.9 12.4 16.1 13.6 16.1 15C16.1 16.4 14.9 17.6 13.5 17.6ZM13.5 13.7C12.8 13.7 12.2 14.3 12.2 15C12.2 15.7 12.8 16.3 13.5 16.3C14.2 16.3 14.8 15.7 14.8 15C14.8 14.3 14.2 13.7 13.5 13.7Z" fill="#FF8345"/>
              <path d="M19.9 17.6C18.5 17.6 17.3 16.4 17.3 15C17.3 13.6 18.5 12.4 19.9 12.4C21.3 12.4 22.5 13.6 22.5 15C22.5 16.4 21.3 17.6 19.9 17.6ZM19.9 13.7C19.2 13.7 18.6 14.3 18.6 15C18.6 15.7 19.2 16.3 19.9 16.3C20.6 16.3 21.2 15.7 21.2 15C21.2 14.3 20.6 13.7 19.9 13.7Z" fill="#FF8345"/>
              <path d="M16.7 72.2H14.1C13.7 72.2 13.5 71.9 13.5 71.6C13.5 71.3 13.8 71 14.1 71H16.7C17.1 71 17.3 71.3 17.3 71.6C17.3 71.9 17 72.2 16.7 72.2Z" fill="#472313"/>
              <path d="M45 72.2H19.3C18.9 72.2 18.7 71.9 18.7 71.6C18.7 71.3 19 71 19.3 71H45C45.4 71 45.6 71.3 45.6 71.6C45.6 71.9 45.3 72.2 45 72.2Z" fill="#472313"/>
              <path d="M69.4 5.4H66.8C66.4 5.4 66.2 5.1 66.2 4.8C66.2 4.5 66.5 4.2 66.8 4.2H69.4C69.8 4.2 70 4.5 70 4.8C70 5.1 69.7 5.4 69.4 5.4Z" fill="#472313"/>
              <path d="M64.2 5.4H38.5C38.1 5.4 37.9 5.1 37.9 4.8C37.9 4.5 38.2 4.2 38.5 4.2H64.2C64.6 4.2 64.8 4.5 64.8 4.8C64.8 5.1 64.6 5.4 64.2 5.4Z" fill="#472313"/>
              <path d="M65.1 67H12.2C10.1 67 8.3 65.3 8.3 63.1V20.1C8.3 19.7 8.6 19.5 8.9 19.5H74.4C74.8 19.5 75 19.8 75 20.1V57.6C75 58 74.7 58.2 74.4 58.2C74.1 58.2 73.8 57.9 73.8 57.6V20.8H9.6V63.2C9.6 64.6 10.8 65.8 12.2 65.8H65.1C65.5 65.8 65.7 66.1 65.7 66.4C65.7 66.7 65.5 67 65.1 67Z" fill="#472313"/>
              <path d="M61 24H22.5V36.8H61V24Z" fill="#00BB85" stroke="#350C0C" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M61 37.5H22.5C22.1 37.5 21.9 37.2 21.9 36.9V24C21.9 23.6 22.2 23.4 22.5 23.4H61C61.4 23.4 61.6 23.7 61.6 24V36.8C61.7 37.2 61.4 37.5 61 37.5ZM23.1 36.2H60.4V24.6H23.1V36.2Z" fill="#350C0C"/>
              <path d="M18.6 34.3C18.4 34.3 18.3 34.2 18.1 34.1L15 30.9C14.7 30.6 14.7 30.2 15 30L18.2 26.8C18.5 26.5 18.9 26.5 19.1 26.8C19.3 27.1 19.4 27.5 19.1 27.7L16.3 30.5L19.1 33.3C19.4 33.6 19.4 34 19.1 34.2C18.9 34.2 18.8 34.3 18.6 34.3Z" fill="#00BB85"/>
              <path d="M64.9 34.3C64.7 34.3 64.6 34.2 64.4 34.1C64.1 33.8 64.1 33.4 64.4 33.2L67.2 30.4L64.4 27.6C64.1 27.3 64.1 26.9 64.4 26.7C64.7 26.5 65.1 26.4 65.3 26.7L68.5 29.9C68.8 30.2 68.8 30.6 68.5 30.8L65.3 34C65.2 34.2 65 34.3 64.9 34.3Z" fill="#00BB85"/>
              <path d="M32.8 42H22.5V52.3H32.8V42Z" fill="#FF8345"/>
              <path d="M32.8 52.9H22.5C22.1 52.9 21.9 52.6 21.9 52.3V42C21.9 41.6 22.2 41.4 22.5 41.4H32.8C33.2 41.4 33.4 41.7 33.4 42V52.3C33.4 52.6 33.1 52.9 32.8 52.9ZM23.1 51.6H32.1V42.6H23.1V51.6Z" fill="#472313"/>
              <path d="M45.7 42.6H36.1C35.7 42.6 35.5 42.3 35.5 42C35.5 41.6 35.8 41.4 36.1 41.4H45.7C46.1 41.4 46.3 41.7 46.3 42C46.3 42.3 46.1 42.6 45.7 42.6Z" fill="#FF8345"/>
              <g opacity="0.4">
              <path opacity="0.4" d="M45.7 47.8H36.1C35.7 47.8 35.5 47.5 35.5 47.2C35.5 46.8 35.8 46.6 36.1 46.6H45.7C46.1 46.6 46.3 46.9 46.3 47.2C46.3 47.5 46.1 47.8 45.7 47.8Z" fill="#FF8345"/>
              </g>
              <path d="M45.7 52.9H36.1C35.7 52.9 35.5 52.6 35.5 52.3C35.5 52 35.8 51.7 36.1 51.7H45.7C46.1 51.7 46.3 52 46.3 52.3C46.3 52.6 46.1 52.9 45.7 52.9Z" fill="#FF8345"/>
              <path d="M45.6 64.5C45.2 64.5 45 64.2 45 63.9V58H23.1V63.8C23.1 64.2 22.8 64.4 22.5 64.4C22.1 64.4 21.9 64.1 21.9 63.8V57.4C21.9 57 22.2 56.8 22.5 56.8H45.6C46 56.8 46.2 57.1 46.2 57.4V63.8C46.2 64.2 46 64.5 45.6 64.5Z" fill="#350C0C"/>
            </svg>                 --}}
          </div>
          <h2 class="cs-icon_box_title cs-semi_bold">{{$item->name??''}}</h2>
          <div class="cs-icon_box_subtitle" >{!!$item->description??''!!}</div>
          <span class="cs-add_btn cs-center cs-accent_color"><i class="fas fa-plus"></i></span>
        </a>
        <div class="cs-height_30 cs-height_lg_30"></div>
      </div>
      @endforeach
      {{-- <div class="col-lg-4">
        <a href="services-details.html" class="cs-icon_box cs-style2 cs-accent_bg_hover">
          <div class="cs-icon_box_icon cs-center cs-accent_15_bg">
              <span class="fa fa-user"></span>
            <svg width="76" height="79" viewBox="0 0 76 79" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M48.8 31.6C54.8199 31.6 59.7 26.7199 59.7 20.7C59.7 14.6801 54.8199 9.8 48.8 9.8C42.7801 9.8 37.9 14.6801 37.9 20.7C37.9 26.7199 42.7801 31.6 48.8 31.6Z" fill="#FF8345"/>
              <path d="M48.8 32.2C42.4 32.2 37.3 27 37.3 20.7C37.3 14.4 42.4 9.2 48.8 9.2C55.2 9.2 60.3 14.4 60.3 20.7C60.3 27 55.1 32.2 48.8 32.2ZM48.8 10.4C43.1 10.4 38.5 15 38.5 20.7C38.5 26.4 43.1 31 48.8 31C54.5 31 59.1 26.4 59.1 20.7C59.1 15 54.4 10.4 48.8 10.4Z" fill="#472313"/>
              <path d="M52.9 19.9L47.3 16.3C46.6 15.9 45.8 16.4 45.8 17.1V24.4C45.8 25.2 46.7 25.7 47.3 25.2L52.9 21.6C53.5 21.1 53.5 20.3 52.9 19.9Z" fill="white"/>
              <path d="M46.9 25.8C46.6 25.8 46.3 25.7 46 25.6C45.4 25.3 45.1 24.7 45.1 24V17.5C45.1 16.8 45.5 16.2 46 15.9C46.6 15.6 47.3 15.6 47.9 16L52.9 19.2C53.4 19.5 53.7 20.1 53.7 20.7C53.7 21.3 53.4 21.9 52.9 22.2L47.9 25.4C47.6 25.7 47.2 25.8 46.9 25.8ZM46.9 16.9C46.8 16.9 46.7 16.9 46.6 17C46.5 17.1 46.3 17.2 46.3 17.5V24C46.3 24.3 46.5 24.5 46.6 24.5C46.7 24.6 46.9 24.7 47.2 24.5L52.2 21.3C52.4 21.2 52.5 21 52.5 20.8C52.5 20.6 52.4 20.4 52.2 20.3L47.2 17.1C47.1 16.9 47 16.9 46.9 16.9Z" fill="#472313"/>
              <path d="M51.2 70.5L44.2 77.5C43.5 78.2 42.4 77.9 42.2 76.9L39.1 64.4L29.9 59.8C28.9 59.3 29.1 57.8 30.1 57.5L73.1 46.7C74.1 46.5 74.9 47.4 74.5 48.3L63.8 75.4C63.5 76.1 62.8 76.4 62.1 76L51.2 70.5Z" fill="#FF8345" stroke="#472313" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M39.1 64.5L74.3 47.1L45.1 67.5L51.2 70.5" stroke="#472313" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M45.1 67.5L43 77.8" stroke="#472313" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M18.3 45.1L25.4 50.7C26.1 51.2 27.1 50.9 27.3 50.1L30.4 39.1L37.3 34.8C38.3 34.2 38 32.7 36.8 32.6L2.1 27.2C1.2 27.1 0.5 27.9 0.8 28.8L7.6 49.2C7.8 49.9 8.7 50.2 9.3 49.9L18.3 45.1Z" fill="#00BB85" stroke="#472313" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M30.4 39L1.10001 27.5L24.4 42.1L18.3 45.1" fill="#00BB85"/>
              <path d="M30.4 39L1.10001 27.5L24.4 42.1L18.3 45.1" stroke="#472313" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M23.3 42.1L26.5 50.9" stroke="#472313" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M11.8 51.3V63.9C11.8 65.6 13.2 66.9 14.8 66.9H37.2" stroke="#472313" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M65.2 46.3V4.5C65.2 2.8 63.8 1.5 62.2 1.5H25.2L11.8 14.8V26.2" stroke="#472313" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M22.1 14.8H11.8L25.1 1.4V11.7C25.1 13.4 23.8 14.8 22.1 14.8Z" stroke="#472313" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>                
          </div>
          <h2 class="cs-icon_box_title cs-semi_bold">Lorem ipsum dolor</h2>
          <div class="cs-icon_box_subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</div>
          <span class="cs-add_btn cs-center cs-accent_color"><i class="fas fa-plus"></i></span>
        </a>
        <div class="cs-height_30 cs-height_lg_30"></div>
      </div>
      <div class="col-lg-4">
        <a href="services-details.html" class="cs-icon_box cs-style2 cs-accent_bg_hover">
          <div class="cs-icon_box_icon cs-center cs-accent_15_bg">
            <span class="fa fa-user"></span>
            <svg width="74" height="77" viewBox="0 0 74 77" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M45.5 64.8H32.8C30.8 64.8 29.2 63.2 29.2 61.2V52.7C29.2 50.7 30.8 49.1 32.8 49.1H45.5C45.8 49.1 46.1 49.4 46.1 49.7V64.3C46.1 64.6 45.9 64.8 45.5 64.8ZM32.8 50.3C31.5 50.3 30.4 51.4 30.4 52.7V61.2C30.4 62.5 31.5 63.6 32.8 63.6H44.9V50.3H32.8Z" fill="#472313"/>
              <path d="M60.1 69.1C60 69.1 60 69.1 59.9 69.1L45.3 64.9C45 64.8 44.9 64.6 44.9 64.3V49.7C44.9 49.4 45.1 49.2 45.3 49.1L59.9 44.9C60.1 44.8 60.3 44.9 60.4 45C60.6 45.1 60.6 45.3 60.6 45.5V68.5C60.6 68.7 60.5 68.9 60.4 69C60.4 69 60.2 69.1 60.1 69.1ZM46.1 63.8L59.4 67.7V46.2L46.1 50.1V63.8V63.8Z" fill="#472313"/>
              <path d="M40.7 77H35.8C34.8 77 34 76.2 34 75.2V64.2C34 63.9 34.3 63.6 34.6 63.6H41.9C42.2 63.6 42.5 63.9 42.5 64.2V75.1C42.5 76.2 41.7 77 40.7 77ZM35.2 64.8V75.1C35.2 75.4 35.5 75.7 35.8 75.7H40.7C41 75.7 41.3 75.4 41.3 75.1V64.8H35.2Z" fill="#472313"/>
              <path d="M63.9 70.9H61C60.4 70.9 60 70.5 60 69.9V44C60 43.4 60.4 43 61 43H63.9C64.5 43 64.9 43.4 64.9 44V69.9C64.9 70.5 64.5 70.9 63.9 70.9Z" fill="#00BB85" stroke="#472313" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M63.7 71.5H61.3C60.3 71.5 59.5 70.7 59.5 69.7V44.2C59.5 43.2 60.3 42.4 61.3 42.4H63.7C64.7 42.4 65.5 43.2 65.5 44.2V69.7C65.6 70.7 64.7 71.5 63.7 71.5ZM61.3 43.6C61 43.6 60.7 43.9 60.7 44.2V69.7C60.7 70 61 70.3 61.3 70.3H63.7C64 70.3 64.3 70 64.3 69.7V44.2C64.3 43.9 64 43.6 63.7 43.6H61.3Z" fill="#472313"/>
              <path d="M73.4 57.6H68.5C68.2 57.6 67.9 57.3 67.9 57C67.9 56.7 68.2 56.4 68.5 56.4H73.4C73.7 56.4 74 56.7 74 57C74 57.3 73.8 57.6 73.4 57.6Z" fill="#00BB85"/>
              <path d="M68.6 53.9C68.4 53.9 68.2 53.8 68.1 53.6C67.9 53.3 68 52.9 68.3 52.8L71.9 50.4C72.2 50.2 72.6 50.3 72.7 50.6C72.9 50.9 72.8 51.3 72.5 51.4L68.9 53.8C68.8 53.9 68.7 53.9 68.6 53.9Z" fill="#00BB85"/>
              <path d="M72.2 63.6C72.1 63.6 72 63.6 71.9 63.5L68.3 61.1C68 60.9 67.9 60.5 68.1 60.3C68.3 60 68.7 59.9 68.9 60.1L72.5 62.5C72.8 62.7 72.9 63.1 72.7 63.3C72.6 63.5 72.4 63.6 72.2 63.6Z" fill="#00BB85"/>
              <path d="M27.3 60.6H3.7C1.7 60.6 0 59 0 57V21.2C0 20.9 0.3 20.6 0.6 20.6H58.8C59.1 20.6 59.4 20.9 59.4 21.2V40.6C59.4 40.9 59.1 41.2 58.8 41.2C58.5 41.2 58.2 40.9 58.2 40.6V21.8H1.2V57C1.2 58.3 2.3 59.4 3.6 59.4H27.3C27.6 59.4 27.9 59.7 27.9 60C27.9 60.3 27.7 60.6 27.3 60.6Z" fill="#472313"/>
              <path d="M58.9 21.8H0.700006C0.400006 21.8 0.100006 21.5 0.100006 21.2V14.5C0.100006 12.5 1.70001 10.9 3.70001 10.9H55.9C57.9 10.9 59.5 12.5 59.5 14.5V21.2C59.5 21.5 59.2 21.8 58.9 21.8ZM1.30001 20.6H58.3V14.5C58.3 13.2 57.2 12.1 55.9 12.1H3.70001C2.40001 12.1 1.30001 13.2 1.30001 14.5V20.6V20.6Z" fill="#472313"/>
              <path d="M6.1 18.7C4.8 18.7 3.7 17.6 3.7 16.3C3.7 15 4.8 13.9 6.1 13.9C7.4 13.9 8.5 15 8.5 16.3C8.5 17.6 7.4 18.7 6.1 18.7ZM6.1 15.1C5.4 15.1 4.9 15.6 4.9 16.3C4.9 17 5.4 17.5 6.1 17.5C6.8 17.5 7.3 17 7.3 16.3C7.3 15.6 6.8 15.1 6.1 15.1Z" fill="#FF8345"/>
              <path d="M12.2 18.7C10.9 18.7 9.8 17.6 9.8 16.3C9.8 15 10.9 13.9 12.2 13.9C13.5 13.9 14.6 15 14.6 16.3C14.6 17.6 13.5 18.7 12.2 18.7ZM12.2 15.1C11.5 15.1 11 15.6 11 16.3C11 17 11.5 17.5 12.2 17.5C12.9 17.5 13.4 17 13.4 16.3C13.4 15.6 12.8 15.1 12.2 15.1Z" fill="#FF8345"/>
              <path d="M60.1 4.2H55.2C54.9 4.2 54.6 3.9 54.6 3.6C54.6 3.3 54.9 3 55.2 3H60.1C60.4 3 60.7 3.3 60.7 3.6C60.7 3.9 60.4 4.2 60.1 4.2Z" fill="#00BB85"/>
              <path d="M57.7 6.6C57.4 6.6 57.1 6.3 57.1 6V1.2C57.1 0.899999 57.4 0.599998 57.7 0.599998C58 0.599998 58.3 0.899999 58.3 1.2V6C58.3 6.3 58 6.6 57.7 6.6Z" fill="#00BB85"/>
              <path d="M68.6 12.1H63.7C63.4 12.1 63.1 11.8 63.1 11.5C63.1 11.2 63.4 10.9 63.7 10.9H68.6C68.9 10.9 69.2 11.2 69.2 11.5C69.2 11.8 68.9 12.1 68.6 12.1Z" fill="#FF8345"/>
              <path d="M66.2 14.5C65.9 14.5 65.6 14.2 65.6 13.9V9C65.6 8.7 65.9 8.4 66.2 8.4C66.5 8.4 66.8 8.7 66.8 9V13.9C66.8 14.2 66.5 14.5 66.2 14.5Z" fill="#FF8345"/>
              <path d="M10.4 65.4H7.99999C7.69999 65.4 7.39999 65.1 7.39999 64.8C7.39999 64.5 7.69999 64.2 7.99999 64.2H10.4C10.7 64.2 11 64.5 11 64.8C11 65.2 10.7 65.4 10.4 65.4Z" fill="#472313"/>
              <path d="M24.9 65.4H12.8C12.5 65.4 12.2 65.1 12.2 64.8C12.2 64.5 12.5 64.2 12.8 64.2H24.9C25.2 64.2 25.5 64.5 25.5 64.8C25.5 65.2 25.2 65.4 24.9 65.4Z" fill="#472313"/>
              <path d="M46.7 7.2H44.3C44 7.2 43.7 6.9 43.7 6.6C43.7 6.3 44 6 44.3 6H46.7C47 6 47.3 6.3 47.3 6.6C47.3 6.9 47.1 7.2 46.7 7.2Z" fill="#472313"/>
              <path d="M41.9 7.2H17.6C17.3 7.2 17 6.9 17 6.6C17 6.3 17.3 6 17.6 6H41.9C42.2 6 42.5 6.3 42.5 6.6C42.5 6.9 42.2 7.2 41.9 7.2Z" fill="#472313"/>
              <path d="M52.8 29.7H34.6V33.3H52.8V29.7Z" fill="#FF8345"/>
              <path d="M52.8 33.9H34.6C34.3 33.9 34 33.6 34 33.3V29.7C34 29.4 34.3 29.1 34.6 29.1H52.8C53.1 29.1 53.4 29.4 53.4 29.7V33.3C53.4 33.6 53.2 33.9 52.8 33.9ZM35.2 32.7H52.2V30.3H35.2V32.7Z" fill="#472313"/>
              <path d="M45.5 36.9H34.6V40.5H45.5V36.9Z" fill="#FF8345"/>
              <path d="M45.5 41.2H34.6C34.3 41.2 34 40.9 34 40.6V37C34 36.7 34.3 36.4 34.6 36.4H45.5C45.8 36.4 46.1 36.7 46.1 37V40.6C46.1 40.9 45.9 41.2 45.5 41.2ZM35.2 40H44.9V37.6H35.2V40Z" fill="#472313"/>
            </svg>                
          </div>
          <h2 class="cs-icon_box_title cs-semi_bold">Lorem ipsum dolor</h2>
          <div class="cs-icon_box_subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
          </div>
          <span class="cs-add_btn cs-center cs-accent_color"><i class="fas fa-plus"></i></span>
        </a>
        <div class="cs-height_30 cs-height_lg_30"></div>
      </div> --}}
    </div>
  </div>
  <div class="cs-height_110 cs-height_lg_50"></div>
</div>
<!-- End Service -->

<!-- Start About -->
<div>
  <div class="cs-height_140 cs-height_lg_80"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="cs-left_full_width text-center">
          <div class="cs-image_box cs-style3 cs-parallax cs-align_right">
            <div class="cs-image_box_img cs-bg" data-src="{{asset($data['#home_make']['image']??'assets/img/marketing/image-box.jpg')}}"></div>
            <div class="cs-image_box_text cs-to_up">
              <div class="cs-image_box_text_in">
                <div class="cs-image_box_title cs-accent_color cs-bold">{!!$data['#home_expirence']['title']??''!!}<span>+</span></div>
                <h2 class="cs-image_box_subtitle cs-medium">{!!$data['#home_expirence']['heading']??''!!}</h2>
              </div>
            </div>
            <div class="cs-image_box_pattern cs-to_left"></div>
          </div>
        </div>
      </div><!-- .col -->
      <div class="col-lg-6 col-xl-5 offset-xl-1 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
        <div class="cs-vertical_middle">
          <div class="cs-vertical_middle_in">
            <div class="cs-height_0 cs-height_lg_50"></div>
            <div class="cs-text_box cs-style1 cs-size1">
              <div class="cs-text_box_subtitle">{!!$data['#home_make']['title']??''!!}</div>
              <h2 class="cs-text_box_title cs-medium">{!!$data['#home_make']['heading']??''!!}</h2>
              <div class="cs-height_20 cs-height_lg_15"></div>
              <div class="cs-text_box_text">{!!$data['#home_make']['description']??''!!}</div>
              <div class="cs-height_35 cs-height_lg_35"></div>
              <div class="row cs-gap_20">
                <div class="col-sm-4">
                  <div class="cs-counter cs-style1 text-center cs-gradient_bg_1">
                    <h3 class="cs-counter_number cs-bold">
                      <span data-count-to="{!!$data['#home_count1']['title']??''!!}" class="odometer"></span>
                      <span class="cs-counter_symble">+</span>
                    </h3>
                    <h4 class="cs-counter_title cs-normal">{!!$data['#home_count1']['heading']??''!!}</h4>
                  </div>
                  <div class="cs-height_0 cs-height_lg_30"></div>
                </div><!-- .col -->
                <div class="col-sm-4">
                  <div class="cs-counter cs-style1 text-center cs-gradient_bg_1">
                    <h3 class="cs-counter_number cs-bold">
                      <span data-count-to="{!!$data['#home_count2']['title']??''!!}" class="odometer"></span>
                      <span class="cs-counter_symble">+</span>
                    </h3>
                    <h4 class="cs-counter_title cs-normal">{!!$data['#home_count2']['heading']??''!!}</h4>
                  </div>
                  <div class="cs-height_0 cs-height_lg_30"></div>
                </div><!-- .col -->
                <div class="col-sm-4">
                  <div class="cs-counter cs-style1 text-center cs-gradient_bg_1">
                    <h3 class="cs-counter_number cs-bold">
                      <span data-count-to="{!!$data['#home_count3']['title']??''!!}" class="odometer"></span>
                      <span class="cs-counter_symble">+</span>
                    </h3>
                    <h4 class="cs-counter_title cs-normal">{!!$data['#home_count3']['heading']??''!!}</h4>
                  </div>
                  <div class="cs-height_0 cs-height_lg_30"></div>
                </div><!-- .col -->
              </div><!-- .row -->
            </div><!-- .cs-text_box -->
          </div>
        </div>
      </div><!-- .col -->
    </div>
  </div>
  <div class="cs-height_140 cs-height_lg_50"></div>
</div>
<!-- End About -->

<!-- Start Pricing Table -->
<div class="cs-gradient_bg_1">
  <div class="cs-height_135 cs-height_lg_75"></div>
  <div class="container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
    <div class="cs-section_heading cs-style2 text-center cs-size1">
      <div class="cs-section_subtitle">{!!$data['#home_plan']['title']??''!!}</div>
      <h2 class="cs-section_title cs-medium">{!!$data['#home_plan']['heading']??''!!}</h2>
    </div>
    <div class="cs-height_65 cs-height_lg_35"></div>
  </div>
  <div class="container wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
    <div class="cs-tabs cs-fade_tabs cs-style1">
      <div class="cs-center cs-medium">
        <ul class="cs-tab_links cs-style1 cs-rounded text-uppercase cs-mp0 cs-center cs-primary_font">
          <li class="active">
            <a href="#tab_one" class="cs-rounded">Monthly</a>
          </li>
          <li>
            <a href="#tab_two" class="cs-rounded">Annualy</a>
          </li>
        </ul>
      </div>
      <div class="cs-height_50 cs-height_lg_40"></div>
      <div class="cs-tab_content">
        <div id="tab_one" class="cs-tab active">
          <div class="row">
            {{-- <div class="col-lg-4">
              <div class="cs-pricing_table cs-style1">
                <div class="cs-pricing_image cs-accent_15_bg"><img src="assets/img/premium-icon.svg" alt=""></div>
                <div class="cs-pricing_table_in">
                  <h2 class="cs-pricing_name cs-semi_bold">Starter</h2>
                  <ul class="cs-pricing_feature cs-mp0">
                    <li><i class="fas fa-check-circle cs-accent_color"></i>lorem plusam dolor</li>
                    <li><i class="fas fa-check-circle cs-accent_color"></i>lorem plusam dolor</li>
                    <li><i class="fas fa-check-circle cs-accent_color"></i>lorem plusam dolor</li>
                  </ul>
                  <div class="cs-price_wrap cs-bold cs-primary_font cs-accent_color_2">
                    <span class="cs-symble">$</span>
                    <span class="cs-price">100</span>
                    <span class="cs-pricing_duration cs-medium">/month</span>
                  </div>
                  <div class="text-center">
                    <a href="#" class="cs-pricing_btn cs-primary_color cs-medium cs-accent_border cs-accent_bg_hover cs-rounded">Purchase Now</a>
                  </div>
                </div>
              </div>
              <div class="cs-height_40 cs-height_lg_40"></div>
            </div><!-- .col --> --}}
            @foreach ($monthly as $item)
                
            <div class="col-lg-4">
              <div class="cs-pricing_table cs-style1">
                <div class="cs-pricing_image cs-accent_15_bg"><img src="{{asset('assets/img/premium-icon.svg')}}" alt=""></div>
                <div class="cs-pricing_table_in">
                  @if ($item->title!=null)
                  <div class="cs-pricing_label cs-accent_bg">{{$item->title??''}}</div>
                  @endif
                  <h2 class="cs-pricing_name cs-semi_bold">{{$item->heading??''}}</h2>
                  <ul class="cs-pricing_feature cs-mp0">
                    @php
                                        $arr = json_decode($item->point,true);
                                    @endphp
                                    @foreach ($arr as $item1)
                    <li><i class="fas fa-check-circle cs-accent_color"></i>{{$item1??''}}</li>
                    @endforeach
                  </ul>
                  <div class="cs-price_wrap cs-bold cs-primary_font cs-accent_color_2">
                    <span class="cs-symble">$</span>
                    <span class="cs-price">{{$item->price??''}}</span>
                    <span class="cs-pricing_duration cs-medium">/month</span>
                  </div>
                  <div class="text-center">
                    <a href="#" class="cs-pricing_btn cs-primary_color cs-medium cs-accent_border cs-accent_bg_hover cs-rounded">Purchase Now</a>
                  </div>
                </div>
              </div>
              <div class="cs-height_40 cs-height_lg_40"></div>
            </div>
            
            @endforeach
            <!-- .col -->
            {{-- <div class="col-lg-4">
              <div class="cs-pricing_table cs-style1">
                <div class="cs-pricing_image cs-accent_15_bg"><img src="assets/img/premium-icon.svg" alt=""></div>
                <div class="cs-pricing_table_in">
                  <h2 class="cs-pricing_name cs-semi_bold">Ultimate</h2>
                  <ul class="cs-pricing_feature cs-mp0">
                    <li><i class="fas fa-check-circle cs-accent_color"></i>lorem plusam dolor</li>
                    <li><i class="fas fa-check-circle cs-accent_color"></i>lorem plusam dolor</li>
                    <li><i class="fas fa-check-circle cs-accent_color"></i>lorem plusam dolor</li>
                  </ul>
                  <div class="cs-price_wrap cs-bold cs-primary_font cs-accent_color_2">
                    <span class="cs-symble">$</span>
                    <span class="cs-price">450</span>
                    <span class="cs-pricing_duration cs-medium">/month</span>
                  </div>
                  <div class="text-center">
                    <a href="#" class="cs-pricing_btn cs-primary_color cs-medium cs-accent_border cs-accent_bg_hover cs-rounded">Purchase Now</a>
                  </div>
                </div>
              </div>
              <div class="cs-height_40 cs-height_lg_40"></div>
            </div><!-- .col --> --}}
          </div>
        </div><!-- .cs-tab -->
        <div id="tab_two" class="cs-tab">
          <div class="row">
            @foreach ($yearly as $item)
                
            <div class="col-lg-4">
              <div class="cs-pricing_table cs-style1">
                <div class="cs-pricing_image cs-accent_15_bg"><img src="{{asset('assets/img/premium-icon.svg')}}" alt=""></div>
                <div class="cs-pricing_table_in">
                  @if ($item->title!=null)
                  <div class="cs-pricing_label cs-accent_bg">{{$item->title??''}}</div>
                  @endif
                  <h2 class="cs-pricing_name cs-semi_bold">{{$item->heading??''}}</h2>
                  <ul class="cs-pricing_feature cs-mp0">
                    @php
                                        $arr = json_decode($item->point,true);
                                    @endphp
                                    @foreach ($arr as $item1)
                    <li><i class="fas fa-check-circle cs-accent_color"></i>{{$item1??''}}</li>
                    @endforeach
                  </ul>
                  <div class="cs-price_wrap cs-bold cs-primary_font cs-accent_color_2">
                    <span class="cs-symble">$</span>
                    <span class="cs-price">{{$item->price??''}}</span>
                    <span class="cs-pricing_duration cs-medium">/Year</span>
                  </div>
                  <div class="text-center">
                    <a href="#" class="cs-pricing_btn cs-primary_color cs-medium cs-accent_border cs-accent_bg_hover cs-rounded">Purchase Now</a>
                  </div>
                </div>
              </div>
              <div class="cs-height_40 cs-height_lg_40"></div>
            </div>
            
            @endforeach<!-- .col -->
            {{-- <div class="col-lg-4">
              <div class="cs-pricing_table cs-style1">
                <div class="cs-pricing_image cs-accent_15_bg"><img src="assets/img/premium-icon.svg" alt=""></div>
                <div class="cs-pricing_table_in">
                  <div class="cs-pricing_label cs-accent_bg">Popular</div>
                  <h2 class="cs-pricing_name cs-semi_bold">Premium</h2>
                  <ul class="cs-pricing_feature cs-mp0">
                    <li><i class="fas fa-check-circle"></i>lorem plusam dolor</li>
                    <li><i class="fas fa-check-circle"></i>lorem plusam dolor</li>
                    <li><i class="fas fa-check-circle"></i>lorem plusam dolor</li>
                  </ul>
                  <div class="cs-price_wrap cs-bold cs-primary_font cs-accent_color_2">
                    <span class="cs-symble">$</span>
                    <span class="cs-price">780</span>
                    <span class="cs-pricing_duration cs-medium">/month</span>
                  </div>
                  <div class="text-center">
                    <a href="#" class="cs-pricing_btn cs-primary_color cs-medium cs-accent_border cs-accent_bg_hover cs-rounded">Purchase Now</a>
                  </div>
                </div>
              </div>
              <div class="cs-height_40 cs-height_lg_40"></div>
            </div><!-- .col --> --}}
            {{-- <div class="col-lg-4">
              <div class="cs-pricing_table cs-style1">
                <div class="cs-pricing_image cs-accent_15_bg"><img src="assets/img/premium-icon.svg" alt=""></div>
                <div class="cs-pricing_table_in">
                  <h2 class="cs-pricing_name cs-semi_bold">Ultimate</h2>
                  <ul class="cs-pricing_feature cs-mp0">
                    <li><i class="fas fa-check-circle"></i>19 Accounts</li>
                    <li><i class="fas fa-check-circle"></i>Database Up to 50 GB</li>
                    <li><i class="fas fa-check-circle"></i>Bot Chat 30 Days Trial</li>
                  </ul>
                  <div class="cs-price_wrap cs-bold cs-primary_font cs-accent_color_2">
                    <span class="cs-symble">$</span>
                    <span class="cs-price">999</span>
                    <span class="cs-pricing_duration cs-medium">/month</span>
                  </div>
                  <div class="text-center">
                    <a href="#" class="cs-pricing_btn cs-primary_color cs-medium cs-accent_border cs-accent_bg_hover cs-rounded">Purchase Now</a>
                  </div>
                </div>
              </div>
              <div class="cs-height_40 cs-height_lg_40"></div>
            </div><!-- .col --> --}}
          </div>
        </div><!-- .cs-tab -->
      </div>
    </div>
  </div>
  <div class="cs-height_100 cs-height_lg_40"></div>
</div>
<!-- End Pricing Table -->

<!-- Start Team Member -->
<div class="cs-height_135 cs-height_lg_75"></div>
<div class="container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
  <div class="cs-section_heading cs-style4 cs-size1">
    <div class="cs-section_heading_left">
      <div class="cs-section_subtitle">{!!$data['#home_team']['title']??''!!}</div>
      <h2 class="cs-section_title cs-medium">{!!$data['#home_team']['heading']??''!!}</h2>
      <div class="cs-section_text">{!!$data['#home_team']['description']??''!!}</div>
    </div>
    <div class="cs-section_heading_right">
      <a href="#" class="cs-btn cs-style3 cs-btn_lg cs-primary_font cs-accent_color cs-medium">
        <span class="cs-btn_text">Meet the whole team</span>
        <span class="cs-btn_icon cs-center"><i class="fas fa-arrow-right"></i></span>
      </a>
    </div>
  </div>
  <div class="cs-height_90 cs-height_lg_70"></div>
</div>
<div class="container wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
  <div class="row">
    @foreach ($team as $item)
        
    <div class="col-lg-4">
      <div class="cs-team_member cs-style1 text-center">
        <div class="cs-member_image_box">
          <svg class="cs-member_bg_layer1 cs-accent_color" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="304px" height="283px" fill='currentColor'>
            <path fill-rule="evenodd" fill="inherit" d="M269.085,1.323 L39.843,48.858 C26.544,51.616 15.091,65.468 13.949,79.851 L0.247,252.538 C-0.881,266.768 8.476,278.491 21.448,278.738 L244.724,283.015 C264.729,283.399 282.735,268.844 284.343,250.477 L303.888,27.229 C305.518,8.605 289.658,-2.944 269.085,1.323 Z" />
          </svg>
          <svg class="cs-member_bg_layer2 cs-accent_color_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="299px" height="290px" fill='currentColor'>
            <path fill-rule="evenodd" fill="inherit" d="M218.646,0.923 L19.429,47.966 C7.716,50.730 -0.845,63.906 0.058,77.599 L11.862,256.434 C12.921,272.471 24.206,285.779 37.376,285.981 L266.726,289.492 C287.526,289.811 301.790,272.864 297.979,251.946 L256.546,23.992 C253.451,6.931 236.279,-3.243 218.646,0.923 Z" />
          </svg>
          <svg class="cs-member_bg_layer3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="291px" height="279px">
            <defs>
              <pattern id="item-{{$item->id}}" patternUnits="userSpaceOnUse" width="320" height="345" patternTransform="rotate(0)">
                <image xlink:href="{{asset($item->image??'assets/img/marketing/team2.jpg')}}" x="0" y="-18" transform="scale(0.9)" width="320" height="345"/>
              </pattern>
            </defs>
            <path fill-rule="evenodd" fill="url(#item-{{$item->id}})" d="M57.516,1.033 L257.628,33.128 C270.274,35.156 280.881,47.778 281.516,61.550 L290.093,247.526 C290.889,264.779 280.057,278.998 265.640,278.998 L32.756,278.998 C13.202,278.998 -1.140,262.010 1.073,241.465 L24.448,24.508 C26.145,8.764 41.064,-1.606 57.516,1.033 Z"></path>
          </svg>
        </div>
        <div class="cs-member_info">
          <h2 class="cs-member_name cs-semi_bold">{{$item->name??''}}</h2>
          <div class="cs-member_designation">{{$item->profession??''}}</div>
        </div>
      </div>
      <div class="cs-height_50 cs-height_lg_50"></div>
    </div>
    @endforeach
    <!-- .col -->
    {{-- <div class="col-lg-4">
      <div class="cs-team_member cs-style1 text-center">
        <div class="cs-member_image_box">
          <svg class="cs-member_bg_layer1 cs-accent_color" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="304px" height="283px" fill='currentColor'>
            <path fill-rule="evenodd" fill="inherit" d="M269.085,1.323 L39.843,48.858 C26.544,51.616 15.091,65.468 13.949,79.851 L0.247,252.538 C-0.881,266.768 8.476,278.491 21.448,278.738 L244.724,283.015 C264.729,283.399 282.735,268.844 284.343,250.477 L303.888,27.229 C305.518,8.605 289.658,-2.944 269.085,1.323 Z" />
          </svg>
          <svg class="cs-member_bg_layer2 cs-accent_color_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="299px" height="290px" fill='currentColor'>
            <path fill-rule="evenodd" fill="inherit" d="M218.646,0.923 L19.429,47.966 C7.716,50.730 -0.845,63.906 0.058,77.599 L11.862,256.434 C12.921,272.471 24.206,285.779 37.376,285.981 L266.726,289.492 C287.526,289.811 301.790,272.864 297.979,251.946 L256.546,23.992 C253.451,6.931 236.279,-3.243 218.646,0.923 Z" />
          </svg>
          <svg class="cs-member_bg_layer3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="291px" height="279px">
            <defs>
              <pattern id="item-2" patternUnits="userSpaceOnUse" width="320" height="345" patternTransform="rotate(0)">
                <image xlink:href="assets/img/marketing/team2.jpg" x="0" y="-18" transform="scale(0.9)" width="320" height="345"/>
              </pattern>
            </defs>
            <path fill-rule="evenodd" fill="url(#item-2)" d="M57.516,1.033 L257.628,33.128 C270.274,35.156 280.881,47.778 281.516,61.550 L290.093,247.526 C290.889,264.779 280.057,278.998 265.640,278.998 L32.756,278.998 C13.202,278.998 -1.140,262.010 1.073,241.465 L24.448,24.508 C26.145,8.764 41.064,-1.606 57.516,1.033 Z"></path>
          </svg>
        </div>
        <div class="cs-member_info">
          <h2 class="cs-member_name cs-semi_bold">Adward Maya</h2>
          <div class="cs-member_designation">Founder & CEO</div>
        </div>
      </div>
      <div class="cs-height_50 cs-height_lg_50"></div>
    </div><!-- .col --> --}}
    {{-- <div class="col-lg-4">
      <div class="cs-team_member cs-style1 text-center">
        <div class="cs-member_image_box">
          <svg class="cs-member_bg_layer1 cs-accent_color" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="304px" height="283px" fill='currentColor'>
            <path fill-rule="evenodd" fill="inherit" d="M269.085,1.323 L39.843,48.858 C26.544,51.616 15.091,65.468 13.949,79.851 L0.247,252.538 C-0.881,266.768 8.476,278.491 21.448,278.738 L244.724,283.015 C264.729,283.399 282.735,268.844 284.343,250.477 L303.888,27.229 C305.518,8.605 289.658,-2.944 269.085,1.323 Z" />
          </svg>
          <svg class="cs-member_bg_layer2 cs-accent_color_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="299px" height="290px" fill='currentColor'>
            <path fill-rule="evenodd" fill="inherit" d="M218.646,0.923 L19.429,47.966 C7.716,50.730 -0.845,63.906 0.058,77.599 L11.862,256.434 C12.921,272.471 24.206,285.779 37.376,285.981 L266.726,289.492 C287.526,289.811 301.790,272.864 297.979,251.946 L256.546,23.992 C253.451,6.931 236.279,-3.243 218.646,0.923 Z" />
          </svg>
          <svg class="cs-member_bg_layer3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="291px" height="279px">
            <defs>
              <pattern id="item-3" patternUnits="userSpaceOnUse" width="320" height="345" patternTransform="rotate(0)">
                <image xlink:href="assets/img/marketing/team3.jpg" x="0" y="-18" transform="scale(0.9)" width="320" height="345"/>
              </pattern>
            </defs>
            <path fill-rule="evenodd" fill="url(#item-3)" d="M57.516,1.033 L257.628,33.128 C270.274,35.156 280.881,47.778 281.516,61.550 L290.093,247.526 C290.889,264.779 280.057,278.998 265.640,278.998 L32.756,278.998 C13.202,278.998 -1.140,262.010 1.073,241.465 L24.448,24.508 C26.145,8.764 41.064,-1.606 57.516,1.033 Z"></path>
          </svg>
        </div>
        <div class="cs-member_info">
          <h2 class="cs-member_name cs-semi_bold">Michel Smith</h2>
          <div class="cs-member_designation">Projetct Manager</div>
        </div>
      </div>
      <div class="cs-height_50 cs-height_lg_50"></div>
    </div><!-- .col --> --}}
  </div>
</div>
<div class="cs-height_85 cs-height_lg_25"></div>
<!-- End Team Member -->

<!-- Start Testimonial -->
<div class="cs-gradient_bg_1">
  <div class="cs-height_135 cs-height_lg_75"></div>
  <div class="container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
    <div class="cs-section_heading cs-style2 cs-size1">
      <div class="cs-section_subtitle">{!!$data['#home_review']['title']??''!!}Testimonials</div>
      <h2 class="cs-section_title cs-medium">{!!$data['#home_review']['heading']??''!!}</h2>
    </div>
    <div class="cs-height_65 cs-height_lg_35"></div>
  </div>
  <div class="container wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
    <div class="cs-slider cs-style1 cs-gap-50 cs-remove_overflow">
      <div class="cs-slider_arrows cs-style2 cs-hidden_mobile">
        <div class="cs-slider_arrows_in">
          <div class="cs-left_arrow cs-center cs-accent_color cs-accent_15_bg cs-accent_bg_hover cs-white_hover">
            <i class="fas fa-long-arrow-alt-left"></i>
          </div>
          <div class="cs-right_arrow cs-center cs-accent_color cs-accent_15_bg cs-accent_bg_hover cs-white_hover">
            <i class="fas fa-long-arrow-alt-right"></i>
          </div>
        </div>
      </div>
      <div class="cs-slider_container" data-autoplay="0" data-loop="1" data-speed="600" data-center="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="1" data-md-slides="2" data-lg-slides="2" data-add-slides="2">
        <div class="cs-slider_wrapper">
          @foreach ($review as $item)
              
          <div class="cs-slide">
            <div class="cs-testimonial cs-style4">
              <div class="cs-testimonial_head">
                <div class="cs-testimonial_icon cs-accent_color"><i class="fas fa-quote-left"></i></div>
                <div class="cs-testimonial_text">{!!$item->description!!}</div>
              </div>
              <div class="cs-testimonial_info">
                <div class="cs-testimonial_avatar"><img src="{{asset($item->image??'assets/img/marketing/avatar1.jpg')}}" alt="Avatar"></div>
                <div class="cs-testimonial_meta">
                  <h3 class="cs-testimonial_avatar_name cs-semi_bold">{{$item->name??''}}</h3>
                  <div class="cs-testimonial_ratings cs-accent_10_bg_2">
                    <div class="cs-review cs-accent_color_2" data-review="{{$item->rating??'0'}}">
                      <div class="cs-review_in"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          <!-- .cs-slide -->
          {{-- <div class="cs-slide">
            <div class="cs-testimonial cs-style4">
              <div class="cs-testimonial_head">
                <div class="cs-testimonial_icon cs-accent_color"><i class="fas fa-quote-left"></i></div>
                <div class="cs-testimonial_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis</div>
              </div>
              <div class="cs-testimonial_info">
                <div class="cs-testimonial_avatar"><img src="assets/img/marketing/avatar2.jpg" alt="Avatar"></div>
                <div class="cs-testimonial_meta">
                  <h3 class="cs-testimonial_avatar_name cs-semi_bold">Jonathon Doe</h3>
                  <div class="cs-testimonial_ratings cs-accent_10_bg_2">
                    <div class="cs-review cs-accent_color_2" data-review="4.5">
                      <div class="cs-review_in"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- .cs-slide --> --}}
          {{-- <div class="cs-slide">
            <div class="cs-testimonial cs-style4">
              <div class="cs-testimonial_head">
                <div class="cs-testimonial_icon cs-accent_color"><i class="fas fa-quote-left"></i></div>
                <div class="cs-testimonial_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis</div>
              </div>
              <div class="cs-testimonial_info">
                <div class="cs-testimonial_avatar"><img src="assets/img/marketing/avatar1.jpg" alt="Avatar"></div>
                <div class="cs-testimonial_meta">
                  <h3 class="cs-testimonial_avatar_name cs-semi_bold">Jessica Jessy</h3>
                  <div class="cs-testimonial_ratings cs-accent_10_bg_2">
                    <div class="cs-review cs-accent_color_2" data-review="4.5">
                      <div class="cs-review_in"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- .cs-slide --> --}}
          {{-- <div class="cs-slide">
            <div class="cs-testimonial cs-style4">
              <div class="cs-testimonial_head">
                <div class="cs-testimonial_icon cs-accent_color"><i class="fas fa-quote-left"></i></div>
                <div class="cs-testimonial_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis</div>
              </div>
              <div class="cs-testimonial_info">
                <div class="cs-testimonial_avatar"><img src="assets/img/marketing/avatar2.jpg" alt="Avatar"></div>
                <div class="cs-testimonial_meta">
                  <h3 class="cs-testimonial_avatar_name cs-semi_bold">Jonathon Doe</h3>
                  <div class="cs-testimonial_ratings cs-accent_10_bg_2">
                    <div class="cs-review cs-accent_color_2" data-review="4.5">
                      <div class="cs-review_in"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- .cs-slide --> --}}
        </div>
      </div><!-- .cs-slider_container -->
      <div class="cs-pagination cs-style1 cs-accent_color_2 cs-hidden_desktop"></div>
    </div><!-- .cs-slider -->
  </div>
  <div class="cs-height_140 cs-height_lg_80"></div>
</div>
<!-- End Testimonial -->

<!-- Start Blog -->
<div class="cs-height_135 cs-height_lg_75"></div>
<div class="container wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
  <div class="cs-section_heading cs-style2 cs-size1 text-center">
    <div class="cs-section_subtitle">{!!$data['#home_article']['title']??''!!}</div>
    <h2 class="cs-section_title">{!!$data['#home_article']['heading']??''!!}</h2>
  </div>
  <div class="cs-height_65 cs-height_lg_35"></div>
</div>
<div class="container wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s">
  <div class="row">
    @foreach ($article as $item)
    <div class="col-lg-4">
      <div class="cs-post cs-style4">
        <a href="#" class="cs-post_thumb">
          <div class="cs-post_thumb_in cs-bg" data-src="{{asset($item->image??'assets/img/marketing/post1.jpg')}}"></div>
          <div class="cs-post_thumb_hover cs-accent_bg_2"></div>
        </a>
        <div class="cs-post_label">
          <a href="#" class="cs-avatar">
            <img src="{{asset($item->auth_image??'assets/img/marketing/post-avatar1.jpg')}}" alt="Avatar" class="cs-avatar_img">
          </a>
          <div class="cs-post_label_right">
            <div class="cs-avatar_name cs-primary_color"><a href="#">{{$item->auth_name??''}}</a></div>
            <div class="cs-post_date">{{$item->auth_profession??''}}</div>
          </div>
        </div>
        <h2 class="cs-post_title cs-accent_border_2 cs-semi_bold"><a href="#">{{$item->heading??''}}</a></h2>
      </div>
      <div class="cs-height_30 cs-height_lg_30"></div>
    </div>
    @endforeach
    <!-- .col -->
    {{-- <div class="col-lg-4">
      <div class="cs-post cs-style4">
        <a href="#" class="cs-post_thumb">
          <div class="cs-post_thumb_in cs-bg" data-src="assets/img/marketing/post2.jpg"></div>
          <div class="cs-post_thumb_hover cs-accent_bg_2"></div>
        </a>
        <div class="cs-post_label">
          <a href="#" class="cs-avatar">
            <img src="assets/img/marketing/post-avatar2.jpg" alt="Avatar" class="cs-avatar_img">
          </a>
          <div class="cs-post_label_right">
            <div class="cs-avatar_name cs-primary_color"><a href="#">Lucida Alex</a></div>
            <div class="cs-post_date">Marketer</div>
          </div>
        </div>
        <h2 class="cs-post_title cs-accent_border_2 cs-semi_bold"><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit</a></h2>
      </div>
      <div class="cs-height_30 cs-height_lg_30"></div>
    </div><!-- .col --> --}}
    {{-- <div class="col-lg-4">
      <div class="cs-post cs-style4">
        <a href="#" class="cs-post_thumb">
          <div class="cs-post_thumb_in cs-bg" data-src="assets/img/marketing/post3.jpg"></div>
          <div class="cs-post_thumb_hover cs-accent_bg_2"></div>
        </a>
        <div class="cs-post_label">
          <a href="#" class="cs-avatar">
            <img src="assets/img/marketing/post-avatar3.jpg" alt="Avatar" class="cs-avatar_img">
          </a>
          <div class="cs-post_label_right">
            <div class="cs-avatar_name cs-primary_color"><a href="#">Lucida Alex</a></div>
            <div class="cs-post_date">Marketer</div>
          </div>
        </div>
        <h2 class="cs-post_title cs-accent_border_2 cs-semi_bold"><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit</a></h2>
      </div>
      <div class="cs-height_30 cs-height_lg_30"></div>
    </div><!-- .col --> --}}
  </div>
</div>
<div class="cs-height_105 cs-height_lg_45"></div>
<!-- End Blog -->
@endsection
@section('scripts')
@endsection

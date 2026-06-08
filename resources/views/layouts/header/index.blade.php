<!-- Main Header -->
<header class="header {{url()->current() == route('home') ? 'color-fixed' : ''}}">
    <!-- Lower Bar -->
    <div class="header-inner">
       <div class="container-fluid pe-0">
          <div class="d-flex align-items-center justify-content-between">
             <!-- Left Part -->
             <div class="header_left_part d-flex align-items-center">
                <div class="logo">
                   <a href="{{route('home')}}" class="light_logo"><img width="200" src="{{$setting->logo}}" alt="logo"></a>
                   <a href="{{route('home')}}" class="dark_logo"><img width="150" src="{{$setting->logo_footer}}" alt="logo"></a>
                </div>
             </div>

             <!-- Center Part -->
             <div class="header_center_part d-none d-xl-block">
                <div class="mainnav">
                   <ul class="main-menu">
                      <li class="menu-item"><a href="{{route('home')}}">Trang chủ</a>
                      </li>
                      <li class="menu-item"><a href="{{route('aboutUs')}}">Giới thiệu</a>
                      </li>
                      <li class="menu-item menu-item-has-children"><a href="{{route('duanTieuBieu')}}">Tác Phẩm</a>
                         <ul class="sub-menu" data-lenis-prevent>
                            @foreach ($projectCate as $item)
                            <li class="menu-item"><a href="{{route('projectCategory', $item->slug)}}">{{$item->name}}</a></li>
                            @endforeach
                            
                         </ul>
                      </li>
                      {{-- <li class="menu-item menu-item-has-children"><a href="#">Dịch vụ</a>
                        <ul class="sub-menu" data-lenis-prevent>
                           @foreach ($servicehome as $item)
                           <li class="menu-item"><a href="{{route('serviceList', $item->slug)}}">{{$item->name}}</a></li>
                           @endforeach
                           
                        </ul>
                     </li> --}}
                     <li class="menu-item menu-item-has-children"><a href="#">Blog</a>
                        <ul class="sub-menu" data-lenis-prevent>
                           @foreach ($blogCate as $item)
                           <li class="menu-item"><a href="{{route('listCateBlog', $item->slug)}}">{{languageName($item->name)}}</a></li>
                           @endforeach
                           
                        </ul>
                     </li> 
                     {{-- @foreach ($blogCate as $item)
                     <li class="menu-item {{count($item->typeCate) > 0 ? 'menu-item-has-children' : ''}}"><a href="{{route('listCateBlog', $item->slug)}}">{{languageName($item->name)}}</a>
                        @if (count($item->typeCate) > 0)
                        <ul class="sub-menu" data-lenis-prevent>
                            @foreach ($item->typeCate as $type)
                            <li class="menu-item"><a href="{{route('listTypeBlog', $type->slug)}}">{{languageName($type->name)}}</a></li>
                            @endforeach
                        </ul>
                        @endif
                     </li>
                     @endforeach --}}
                      <li class="menu-item"><a href="{{route('lienHe')}}">Liên Hệ</a></li>
                   </ul>
                </div>
             </div>

             <!-- Right Part -->
             <div class="header_right_part d-flex align-items-center">
                @include('partials.google-translate-lang')

                <div class="header_search wptb-element">
                   <a href="#" class="modal_search_icon" data-bs-toggle="modal" data-bs-target="#modalSearch"><i
                         class="bi bi-search"></i></a>
                </div>

                <button type="button" class="mr_menu_toggle wptb-element d-xl-none">
                   <i class="bi bi-list"></i>
                </button>
             </div>
          </div>
       </div>
    </div>
 </header>
 <!-- End Main Header -->

 <!-- Mobile Responsive Menu -->
 <div class="mr_menu" data-lenis-prevent>
    <button type="button" class="mr_menu_close"><i class="bi bi-x-lg"></i></button>
    <div class="logo"></div> <!-- Keep this div empty. Logo will come here by JavaScript -->

    <h6>Danh mục</h6>
    <div class="mr_navmenu"></div> <!-- Keep this div empty. Menu will come here by JavaScript -->

    <h6>Thông tin liên hệ</h6>
    <div class="wptb-icon-box1 style2">
       <div class="wptb-item--inner flex-start">
          <div class="wptb-item--icon"><i class="bi bi-envelope"></i></div>
          <div class="wptb-item--holder">
             <p class="wptb-item--description"><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></p>
          </div>
       </div>
    </div>

    <div class="wptb-icon-box1 style2">
       <div class="wptb-item--inner flex-start">
          <div class="wptb-item--icon"><i class="bi bi-geo-alt"></i></div>
          <div class="wptb-item--holder">
             <p class="wptb-item--description"><a href="">{{$setting->address1}}</a></p>
          </div>
       </div>
    </div>

    <div class="wptb-icon-box1 style2">
       <div class="wptb-item--inner flex-start">
          <div class="wptb-item--icon"><i class="bi bi-envelope"></i></div>
          <div class="wptb-item--holder">
             <p class="wptb-item--description"><a href="tel:{{$setting->phone1}}">{{$setting->phone1}}</a></p>
          </div>
       </div>
    </div>

    <h6>Mạng xã hội</h6>
    <div class="social-box">
       <ul>
          <li><a href="{{$setting->facebook}}" target="_blank"><i class="bi bi-facebook"></i></a></li>
          <li><a href="{{$setting->fbPixel}}" target="_blank"><i class="bi bi-instagram"></i></a></li>
          <li><a href="{{$setting->google}}" target="_blank"><i class="bi bi-tiktok"></i></a></li>
          <li><a href="{{$setting->GA}}" target="_blank"><i class="bi bi-messenger"></i></a></li>
       </ul>
    </div>
 </div>

 <div class="aside_info_wrapper" data-lenis-prevent>
    <button class="aside_close">Close <i class="bi bi-x-lg"></i></button>

    <div class="aside_logo logo">
       <a href="{{route('home')}}" class="dark_logo"><img width="200" src="{{$setting->logo_footer}}" alt="logo"></a>
    </div>

    <div class="aside_info_inner">

       <h6>// Facebook</h6>
       <div class="insta-logo">
          <i class="bi bi-facebook"></i> Bà Già  Tattoo
       </div>
       <div class="wptb-instagram--gallery">
          <div class="wptb-item--inner d-flex align-items-center justify-content-center flex-wrap">
            @foreach ($album as $item)
            <div class="wptb-item">
                <div class="wptb-item--image">
                   <img src="{{$item->before}}" alt="img">
                </div>
             </div>
            @endforeach
             

          </div>
       </div>


       <div class="wptb-icon-box1 style2">
          <div class="wptb-item--inner flex-start">
             <div class="wptb-item--icon"><i class="bi bi-envelope"></i></div>
             <div class="wptb-item--holder">
                <p class="wptb-item--description"><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></p>
             </div>
          </div>
       </div>

       <div class="wptb-icon-box1 style2">
          <div class="wptb-item--inner flex-start">
             <div class="wptb-item--icon"><i class="bi bi-geo-alt"></i></div>
             <div class="wptb-item--holder">
                <p class="wptb-item--description"><a href="">{{$setting->address1}}</a></p>
             </div>
          </div>
       </div>

       <div class="wptb-icon-box1 style2">
          <div class="wptb-item--inner flex-start">
             <div class="wptb-item--icon"><i class="bi bi-envelope"></i></div>
             <div class="wptb-item--holder">
                <p class="wptb-item--description"><a href="tel:{{$setting->phone1}}">{{$setting->phone1}}</a></p>
             </div>
          </div>
       </div>

       <h6>// Follow Us</h6>
       <div class="social-box style-square">
          <ul>
             <li><a href="{{$setting->facebook}}"><i class="bi bi-facebook"></i></a></li>
             <li><a href="{{$setting->instagram}}"><i class="bi bi-instagram"></i></a></li>
             <li><a href="{{$setting->linkedin}}"><i class="bi bi-linkedin"></i></a></li>
             <li><a href="{{$setting->youtube}}"><i class="bi bi-youtube"></i></a></li>
          </ul>
       </div>
    </div>
 </div>

 <!-- Modal Search -->
 <div class="search-modal">
    <div class="modal fade" id="modalSearch">
       <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
             <div class="search_overlay">
                <form class="credential-form" method="post" action="{{route('search_result')}}">
                    @csrf
                   <div class="form-group">
                      <input type="text" name="keyword" class="keyword form-control" placeholder="Search Here">
                   </div>
                   <button type="submit" class="btn-search">
                      <span class="text-first"> <i class="bi bi-arrow-right"></i> </span>
                   </button>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>
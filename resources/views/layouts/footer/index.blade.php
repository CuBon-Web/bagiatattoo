<section class="pdb-0 pdt-0">
   <div class="container">
      <div class="wptb-office-address">
         <div class="row">
             <div class="col-lg-4 col-md-6">
                 <div class="wptb-icon-box1 wow fadeInLeft">
                     <div class="wptb-item--inner flex-start">
                         <div class="wptb-item--icon"><i class="bi bi-facebook"></i></div>
                         <div class="wptb-item--holder">
                             <h3 class="wptb-item--title">Facebook</h3>
                             <p class="wptb-item--description">{{$setting->facebook}}</p>
                             <a href="{{$setting->facebook}}" class="wptb-item--link">Xem trang</a>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="col-lg-4 col-md-6 px-md-5">
                 <div class="wptb-icon-box1 wow fadeInLeft">
                     <div class="wptb-item--inner flex-start">
                         <div class="wptb-item--icon"><i class="bi bi-phone"></i></div>
                         <div class="wptb-item--holder">
                             <h3 class="wptb-item--title">Số điện thoại</h3>
                             <p class="wptb-item--description">{{$setting->phone1}}</p>
                             <a href="tel:{{$setting->phone1}}" class="wptb-item--link">Gọi Ngay</a>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="col-lg-4 col-md-6">
                 <div class="wptb-icon-box1 wow fadeInLeft">
                     <div class="wptb-item--inner flex-start">
                         <div class="wptb-item--icon"><i class="bi bi-map"></i></div>
                         <div class="wptb-item--holder">
                             <h3 class="wptb-item--title">Địa chỉ</h3>
                             <p class="wptb-item--description">{{$setting->address1}}</p>
                             <a href="https://g.page/bagiatattoo" class="wptb-item--link">Chỉ đường</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
   </div>
  </section>
<footer class="footer style1 bg-image-2" style="background-image: url('../assets/img/background/bg-5.png');">
   <div class="footer-top">
      <div class="container">
         <div class="footer--inner">
            <div class="row">
               <div class="col-lg-4 col-md-4 col-sm-6 mb-5 mb-md-0">
                  <div class="footer-widget">
                     <div class="footer-nav">
                        <ul>
                           <li class="menu-item"><a href="{{route('aboutUs')}}">Về chúng tôi</a></li>
                           <li class="menu-item"><a href="{{route('duanTieuBieu')}}">Tác phẩm</a></li>
                           @foreach ($blogCate as $item)
                           <li class="menu-item"><a href="{{route('listCateBlog',['slug'=>$item->slug])}}">{{languageName($item->name)}}</a></li>
                           @endforeach
                           <li class="menu-item"><a href="{{route('lienHe')}}">Liên hệ</a></li>
                        </ul>
                     </div>
                  </div>
               </div>

               <div class="col-lg-4 col-md-4 mb-5 mb-md-0 order-1 order-md-0">
                  <div class="footer-widget text-center">
                     <div class="logo mr-bottom-55">
                        <a href="{{route('home')}}" class=""><img width="100" src="{{url(''.$setting->logo)}}" alt="logo"></a>
                     </div>

                     <h6 class="widget-title">{{$setting->webname}}</h6>
                     <h6 class="widget-title"> <i class="bi bi-clock"></i>{{$setting->linkpopup}}</h6>
                  </div>
               </div>

               <div class="col-lg-4 col-md-4 col-sm-6 mb-5 mb-md-0">
                  <div class="footer-widget text-md-end">
                     <div class="footer-nav">
                        <ul>
                           <li class="menu-item"><a href="">Vị trí</a></li>
                        </ul> <br>
                        {!! $setting->iframe_map !!}
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Footer Bottom Part -->
   <div class="footer-bottom">
      <div class="container">
         <div class="footer-bottom-inner">
            <div class="copyright">
               <p>Copyright © {{date('Y')}} <a href="{{route('home')}}">Bagia Tattoo</a></p>
            </div>
            <div class="social-box style-oval">
               <ul>
                  <li><a href="{{$setting->facebook}}" target="_blank" class="bi bi-facebook"></a></li>
                  <li><a href="{{$setting->fbPixel}}" target="_blank" class="bi bi-instagram"></a></li>
                  <li><a href="{{$setting->google}}" target="_blank" class="bi bi-tiktok"></a></li>
                  <li><a href="{{$setting->GA}}" target="_blank" class="bi bi-messenger"></a></li>
                  <li><a href="https://www.youtube.com/@bagiatattoo" target="_blank" class="bi bi-youtube"></a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</footer>
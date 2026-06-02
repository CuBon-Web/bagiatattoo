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
                    
                  </div>
               </div>

               <div class="col-lg-4 col-md-4 col-sm-6 mb-5 mb-md-0">
                  <div class="footer-widget text-md-end">
                     <div class="footer-nav">
                        <ul>
                           @foreach ($servicehome as $item)
                           <li class="menu-item"><a href="{{route('serviceList',['slug'=>$item->slug])}}">{{languageName($item->name)}}</a></li>
                           @endforeach
                        </ul>
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
               <p>Copyright © {{date('Y')}} <a href="{{route('home')}}">Bà Già Tattoo</a>, Designed by Tuấn Anh Developer
               </p>
            </div>
            <div class="social-box style-oval">
               <ul>
                  <li><a href="{{$setting->facebook}}" class="bi bi-facebook"></a></li>
                  <li><a href="{{$setting->instagram}}" class="bi bi-instagram"></a></li>
                  <li><a href="{{$setting->tiktok}}" class="bi bi-tiktok"></a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</footer>
@extends('layouts.main.master')
@section('title')
Liên hệ với chúng tôi
@endsection
@section('description')
Liên hệ với chúng tôi
@endsection
@section('image')
{{url(''.$setting->logo)}}
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('frontend/css/components.css')}}">
@endsection
@section('js')
@endsection
@section('content')
<main class="wrapper">
	<!-- Google Map -->
	

	<!-- Contact -->
	<section class="wptb-contact-form style1 pt-100">
		<div class="wptb-item-layer both-version">
			<img src="{{url('frontend/img/texture-2.png')}}" alt="">
			<img src="{{url('frontend/img/texture-2-light.png')}}" alt="">
		</div>
		<div class="container">
			<div class="wptb-office-address mr-top-100">
				<div class="row">
					<div class="col-lg-4 col-md-6">
						<div class="wptb-icon-box1 wow fadeInLeft">
							<div class="wptb-item--inner flex-start">
								<div class="wptb-item--icon"><i class="bi bi-globe"></i></div>
								<div class="wptb-item--holder">
									<h3 class="wptb-item--title">Email</h3>
									<p class="wptb-item--description">{{$setting->email}}</p>
									<a href="mailto:{{$setting->email}}" class="wptb-item--link">Send Now</a>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-6 px-md-5">                            
						<div class="wptb-icon-box1 wow fadeInLeft">
							<div class="wptb-item--inner flex-start">
								<div class="wptb-item--icon"><i class="bi bi-phone"></i></div>
								<div class="wptb-item--holder">
									<h3 class="wptb-item--title">Hotline</h3>
									<p class="wptb-item--description">{{$setting->phone1}}</p>
									<a href="tel:{{$setting->phone1}}" class="wptb-item--link">Gọi Ngay</a>
								</div>
							</div>
						</div> 
					</div>

					<div class="col-lg-4 col-md-6">
						<div class="wptb-icon-box1 wow fadeInLeft">
							<div class="wptb-item--inner flex-start">
								<div class="wptb-item--icon"><i class="bi bi-geo-alt"></i></div>
								<div class="wptb-item--holder">
									<h3 class="wptb-item--title">Địa chỉ</h3>
									<p class="wptb-item--description">{{$setting->address1}}</p>
									<a href="#" class="wptb-item--link">View Map</a>
								</div>
							</div>
						</div> 
					</div>
				</div>
			</div>

			
		</div>
		
	</section>
    <section class="wptb-contact-form bg-image-5" style="background-image: url('../assets/img/background/bg-9.jpg');">
        <div class="container">
            <div class="wptb-form--wrapper no-bg">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="wptb-heading">
                            <div class="wptb-item--inner">
                                <h6 class="wptb-item--subtitle"> <span>01 //</span> Contact Us</h6>
                                <h1 class="wptb-item--title"> <span>Liên hệ với chúng tôi</span></h1>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="wptb-office">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--subtitle">
                                        Gọi cho chúng tôi
                                    </div>
                                    <h5 class="wptb-item--title"><a href="tel:{{$setting->phone1}}">{{$setting->phone1}}</a></h5>
                                </div>
                            </div>
    
                            <div class="wptb-office">
                                <div class="wptb-item--inner">
                                    <div class="wptb-item--subtitle">
                                        Gửi email cho chúng tôi
                                    </div>
                                    <h5 class="wptb-item--title"><a href="mailto:{{$setting->email}}">{{$setting->email}}</a></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <form class="wptb-form" action="{{route('postcontact')}}" method="post">
                            @csrf
                            <div class="wptb-form--inner">        
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Họ và tên*" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <div class="form-group">
                                            <input type="text" name="phone" class="form-control" placeholder="Số điện thoại*" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 mb-4">
                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control" placeholder="Email*" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-12 mb-4">
                                        <div class="form-group">
                                            <textarea name="mess" class="form-control" placeholder="Nội dung liên hệ"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-12">
                                        <div class="wptb-item--button"> 
                                            <button class="btn" type="submit">
                                                <span class="btn-wrap">
                                                    <span class="text-first">Gửi liên hệ</span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
	{!!$setting->iframe_map!!}
</main>





@endsection
@extends('layouts.main.master')
@section('title')
Về Chúng Tôi
@endsection
@section('description')
{{$setting->company}}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<main class="wrapper">
    <section class="wptb-project pd-top-140 pd-bottom-5">
        <div class="container">
            <div class="wptb-heading">
                <div class="wptb-item--inner text-center">
                    {{-- <h6 class="wptb-item--subtitle"><span>01//</span> {{ $Cate->name }}</h6> --}}
                    <h1 class="wptb-item--title"> <span>Về Chúng Tôi</span></h1>
                </div>
            </div>

        </div>
    </section>
	<!-- Details Content -->
	<section class="blog-details pt-100">
	   <div class="container">
		  <div class="row">
			 <!-- Service Navigation List -->
			
			 <div class="col-lg-12 col-md-12 mb-5 mb-md-0 ps-md-0">
				
				<div class="blog-details-inner">
				   <div class="post-content">
					  <!-- Post Image -->
					 
					  <div class="fulltext">
						{!!($gioithieu->content)!!}
					  </div>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</section>
	<!-- End Details Content -->
 
 </main>
@endsection
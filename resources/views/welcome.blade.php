<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="{{ asset('img/fav.png') }}">
	<!-- Author Meta -->
	<meta name="author" content="codepixer">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Site Title -->
	<title>Northern Railway - Complaint Management System</title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:400,600|Roboto:400,400i,500" rel="stylesheet">
	<!--
			CSS
			============================================= -->
	<link rel="stylesheet" href="{{ asset('home/css/linearicons.css') }}">
	<link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('home/css/magnific-popup.css') }}">
	<link rel="stylesheet" href="{{ asset('home/css/nice-select.css') }}">
	<link rel="stylesheet" href="{{ asset('home/css/hexagons.min.css') }}">
	<link rel="stylesheet" href="{{ asset('home/css/owl.carousel.css') }}">
	<link rel="stylesheet" href="{{ asset('home/css/main.css') }}">
</head>
<style>
.feature-area .single-feature {
    background: #fff;
    padding: 10px 10px !important;
    text-align: center;
    box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
}
</style>
<body>
	<!-- start header Area -->
	<header id="header">
		<div class="container main-menu">
			<div class="row align-items-center justify-content-between d-flex">
				<div id="logo">
					<a href="{{ url('/') }}"><img src="{{ asset('home/img/nrcms-logo.png') }}" alt="" style="width:190px;" title="" /></a>
				</div>
				<nav id="nav-menu-container">
					<ul class="nav-menu">
						<li class="menu-active"><a href="{{ url('/') }}">Home</a></li>
						<li><a href="#about-area">About</a></li>
						<li><a href="#contact">Contact</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</header>
	<!-- end header Area -->

	<!-- start banner Area -->
	<section class="home-banner-area">
		<div class="container">
			<div class="row fullscreen d-flex align-items-center justify-content-between">
				<div class="home-banner-content col-lg-6 col-md-6">
					<h2>
					Northern Railway Automated <br> Complaint Management System
					</h2>
					<p>NRCMS is developed to provide just in time complaints resolution, maintenance and support to the stakeholders.</p>
					<div class="d-flex">
					<div class="download-button d-flex flex-column justify-content-center">
						<div class="buttons dark mb-3">
							<div class="desc">
								<p>
									<a href="{{ route('login') }}"><span>Login</span></a>
								</p>
							</div>
						</div>
						<div class="buttons dark flex-row d-flex">
							<div class="desc">
								<p>
									<a href="{{ route('register') }}"><span>Signup</span></a>
								</p>
							</div>
						</div>
					</div>
					<!--QR CODE ADDED BY SHUBHAM-->
					<div class="d-flex flex-column align-items-center pl-3">
					    <p class="mb-2">Scan For App Download</p>
					    <img class="img-fluid" src="{{ asset('home/img/NRCMS-APP.png') }}" alt="" width="100" height="100">
					</div>
					<!--END-->
					</div>
				</div>
				<div class="banner-img col-lg-4 col-md-6">
					<img class="img-fluid" src="{{ asset('home/img/banner-img.png') }}" alt="">
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->

	<!-- Start fact Area -->
	<section class="fact-area">
		<div class="container">
			<div class="fact-box">
				<div class="row align-items-center">
					<div class="col single-fact">
						<h2>10000+</h2>
						<p>Total Quarters</p>
					</div>
					<div class="col single-fact">
						<h2>18K+</h2>
						<p>Resolved Complaints</p>
					</div>
					<div class="col single-fact">
						<h2>5K+</h2>
						<p>Daily Visitors</p>
					</div>
					<div class="col single-fact">
						<h2>0.02%</h2>
						<p>Pending Complaints</p>
					</div>
					<div class="col single-fact">
						<h2>1</h2>
						<p>Admin</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End fact Area -->

	<!-- Start feature Area -->
	<section class="feature-area section-gap-top">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-lg-6">
					<div class="section-title text-center">
						<h2>Facts & Figures</h2>
						<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
							magna aliqua.
						</p>-->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="single-feature">
						
							<img src="{{ asset('home/img/facts/c1.PNG') }}">
						
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="single-feature">
						
							<img src="{{ asset('home/img/facts/c2.PNG') }}">
						
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="single-feature">
						
							<img src="{{ asset('home/img/facts/C3.PNG') }}">
						
						
					</div>
				</div>
				
				<div class="col-lg-3 col-md-6">
					<div class="single-feature">
					
							<img src="{{ asset('home/img/facts/c4.PNG') }}">	
						
						
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- End feature Area -->

	<!-- Start about Area -->
	<section class="about-area" id="about-area">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-5 home-about-left">
					<img class="img-fluid" src="{{ asset('home/img/iphone.png') }}" alt="">
				</div>
				<div class="offset-lg-1 col-lg-5 home-about-right">
					<h1>
				
						Easy to implement <br>
						use, and scale
					</h1>
					<p>
						The developed system is easy to use via multiple platforms and utilities. The developed system will provide just in time reporting and adhoc reporting to the management to support in decision making.
					</p>
					<a class="primary-btn text-uppercase" href="#">Get Details</a>
				</div>
				<div class="col-lg-6 home-about-right home-about-right2">
					<h1>
						Scalable to All
					</h1>
					<p>
						The system is designed and developed to be scalable for all other railway divisions and Zones. The system can be customized for all types of complaints and suggestions as per the needs.
					</p>
					<h1>
					Work smarter, not harder
					</h1>
					<p>
						The system will provide insights to the users, management and all other stakeholders to make them self sufficient to take decisions and corrective measure for better service and support to the employees.
					</p>
				</div>
				<div class="col-lg-5 home-about-left">
					<img class="img-fluid" src="{{ asset('home/img/iphone.png') }}" alt="">
				</div>
			</div>
		</div>
	</section>
	<!-- End about Area -->

	<!-- Start about-video Area -->
	<section class="about-video-area section-gap">
		<div class="vdo-bg">
			<div class="container">
				<div class="row align-items-center justify-content-center">
					<div class="col-lg-12 about-video-right justify-content-center align-items-center d-flex relative">
						<!-- <div class="overlay overlay-bg"></div> -->
						<a href="javascript:void(0);"><img class="img-fluid mx-auto" src="{{ asset('home/img/play-btn.png') }}" alt=""></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="screenshot-area section-gap-top">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-lg-8">
					<div class="section-title text-center">
						<h2>Providing support on multiple channel</h2>
						<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
							magna aliqua.
						</p>-->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="owl-carousel owl-screenshot">
					<div class="single-screenshot">
						<img class="img-fluid" src="{{ asset('home/img/screenshots/s1.jpg') }}" alt="">
					</div>
					<div class="single-screenshot">
						<img class="img-fluid" src="{{ asset('home/img/screenshots/s2.jpg') }}" alt="">
					</div>
					<div class="single-screenshot">
						<img class="img-fluid" src="{{ asset('home/img/screenshots/s3.jpg') }}" alt="">
					</div>
					<div class="single-screenshot">
						<img class="img-fluid" src="{{ asset('home/img/screenshots/s4.jpg') }}" alt="">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Screenshot Area -->

	<!-- Start Pricing Area -->
	<section class="pricing-area">
		<div class="container">
			<div class="row d-flex justify-content-center">
				<div class="col-lg-6">
					<div class="section-title text-center">
						<!--<h2>Suitable Pricing Plans</h2>-->
						<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
							magna aliqua.
						</p>-->
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="single-price">
						<div class="top-sec d-flex justify-content-between">
							<h1>We are dedicated for best customer experience</h1>
						</div>
						<div class="end-sec">
							<ul>
								<!--<img src="{{ asset('home/img/icons/icons8-support-64.png') }}"><li>+91-7500872014</li>-->
								<img src="{{ asset('home/img/icons/complaint.png') }}"><li>admin@nrcms.in</li>
								<img src="{{ asset('home/img/icons/address.png') }}"><li>Colony IOW office, Concerned Colony, Delhi Division, New Delhi</li>

							</ul>
						<!--	<button class="primary-btn price-btn mt-20">Purchase Plan</button>-->
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="single-price">
						<div class="top-sec d-flex justify-content-between">
							<div class="top-left">
								<h4>NRCMS</h4>
								<p>For <br>Northern railway</p>
							</div>
							
						</div>
						<div class="end-sec">
							<img src="{{ asset('home/img/railways.png') }}">
						<!--	<button class="primary-btn price-btn mt-20">Purchase Plan</button>-->
						</div>
					</div>
				</div>
				

			</div>
		</div>
	</section>
	<!-- End Pricing Area -->

	<!-- Start Footer Area -->
	<footer class="footer-area" id='contact'>
		<div class="container">
			<div class="row section-gap">
				<div class="col-lg-4 col-md-6 single-footer-widget">
					<h4>About-Us</h4>
					<img src="{{ asset('home/img/nrcms-logo.png') }}" style="width:190px; padding-bottom:10px;">
					<p>NRCMS is developed to provide just in time complaints resolution, maintenance and support to the stakeholders.</p>
				</div>
				
				<div class="col-lg-4 col-md-6 single-footer-widget">
					<h4>Contact Us</h4>
					<ul>
						<li>Colony IOW office, Concerned Colony, Delhi Division, New Delhi</li>
						<!--<li><a href="#">+91-7500872014</a></li>-->
						<li><a href="#">info@nrcms.in</a></li>
					</ul>
				</div>
				<div class="col-lg-4 col-md-6 single-footer-widget">
					<h4>Locate Us</h4>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3503.2856145580777!2d77.25123221459431!3d28.591207292701945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce3cb704096a9%3A0xc4a25f8cae278c41!2sI.O.W%20Office%20(ESTATE)!5e0!3m2!1sen!2sin!4v1632741679499!5m2!1sen!2sin" width="350" height="200" frameborder="0" style="border:0" allowfullscreen"></iframe>
				</div>
			</div>
		</div>
		<div class="footer-bottom text-center align-items-center">
			<p class="footer-text m-0">Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="https://giksindia.com/">Designed & Developed by GIKS India Pvt. Ltd.</a></p>
		</div>
	</footer>
	<div id="light">
		<a class="boxclose" id="boxclose" onclick="lightbox_close();"></a>
	  	<video id="VisaChipCardVideo" width="600" controls>
	      <source src="{{ asset('home/train.mp4') }}" type="video/mp4">
	      <!--Browser does not support <video> tag -->
	    </video>
	</div>
	<div id="fade" onclick="lightbox_close();"></div>
	<script>
		window.document.onkeydown = function(e) {
		  if (!e) {
		    e = event;
		  }
		  if (e.keyCode == 27) {
		    lightbox_close();
		  }
		}

		function lightbox_open() {
		  var lightBoxVideo = document.getElementById("VisaChipCardVideo");
		  window.scrollTo(0, 0);
		  document.getElementById('light').style.display = 'block';
		  document.getElementById('fade').style.display = 'block';
		  lightBoxVideo.play();
		  return false;
		}

		function lightbox_close() {
		  var lightBoxVideo = document.getElementById("VisaChipCardVideo");
		  document.getElementById('light').style.display = 'none';
		  document.getElementById('fade').style.display = 'none';
		  lightBoxVideo.pause();
		}
	</script>
	<script src="{{ asset('home/js/vendor/jquery-2.2.4.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="{{ asset('home/js/tilt.jquery.min.js') }}"></script>
	<script src="{{ asset('home/js/vendor/bootstrap.min.js') }}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
	<script src="{{ asset('home/js/easing.min.js') }}"></script>
	<script src="{{ asset('home/js/hoverIntent.js') }}"></script>
	<script src="{{ asset('home/js/superfish.min.js') }}"></script>
	<script src="{{ asset('home/js/jquery.ajaxchimp.min.js') }}"></script>
	<script src="{{ asset('home/js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('home/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('home/js/owl-carousel-thumb.min.js') }}"></script>
	<script src="{{ asset('home/js/hexagons.min.js') }}"></script>
	<script src="{{ asset('home/js/jquery.nice-select.min.js') }}"></script>
	<script src="{{ asset('home/js/waypoints.min.js') }}"></script>
	<script src="{{ asset('home/js/mail-script.js') }}"></script>
	<script src="{{ asset('home/js/main.js') }}"></script>
</body>
</html>
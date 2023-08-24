@extends('layouts.admin-template')

@section('title')

    User Super Category

@endsection

@section('content')

	<div class="content-container">
		<header class="row">
			<div class="col heading">
				<a class="go-back-btn" href="#" onclick="window.history.go(-1); return false;" title="Go Back">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 198.194 198.194" style="enable-background:new 0 0 198.194 198.194;" xml:space="preserve" width="25px" height="25px">
						<g>
							<path d="M132.447,46.884h-88.02l7.267-7.267c4.531-4.531,4.531-11.873,0-16.41   c-4.531-4.531-11.873-4.531-16.41,0l-27.07,27.07c-0.005,0.005-0.011,0.005-0.011,0.005L0,58.491l8.202,8.197   c0,0,0.005,0.005,0.011,0.016L37.214,95.7c2.268,2.268,5.238,3.399,8.202,3.399c2.975,0,5.939-1.131,8.208-3.399   c4.531-4.531,4.531-11.873,0-16.41l-9.197-9.197h88.02c23.459,0,42.544,19.091,42.544,42.544s-19.091,42.544-42.544,42.544H16.421   c-6.413,0-11.607,5.194-11.607,11.602c0,6.407,5.194,11.602,11.607,11.602h116.026c36.257,0,65.747-29.496,65.747-65.747   S168.703,46.884,132.447,46.884z" fill="#D2D1D7"></path>
						</g>
					</svg>
				</a>
				<span>|</span>
				<h3>Choose Complaint type</h3>
			</div>
		</header>
	</div>
	<hr>
	<div class="row mb-3">

        <div class="col-6 col-md-3">
            <a href="{{ route('complaint.super-categories') }}">
                <div class="counter-card green d-flex align-items-center justify-content-between category-box">

                    <div class="header">

                        <span class="head">Quarter</span>

                    </div>

                    <div class="body">

                        <i data-feather="home"></i>

                    </div>

                </div>
            </a>
        </div>

        <div class="col-6 col-md-3">
            <a href="{{ route('complaint.super-categories') }}">
                <div class="counter-card purple d-flex align-items-center justify-content-between">

                    <div class="header">

                        <span class="head">Building</span>                    

                    </div>

                    <div class="body">

                        <i data-feather="codesandbox"></i>

                    </div>

                </div>
            </a>
        </div>

    </div>

@endsection
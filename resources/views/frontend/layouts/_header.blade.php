<header class="main-header navbar-light header-sticky header-sticky-smart header-mobile-lg">
	<div class="sticky-area-wrap" style="height: 72.2708px;">
		<div id="bg-white" class="sticky-area">
			<div class="container">
				<nav class="navbar navbar-expand-lg px-0">
					<div class="d-flex justify-content-between">
						<a class="navbar-brand h1" href="{{route('frontend.index')}}"> 
							<img src="{{asset('assets/admin/media/logos/logo-full.png')}}" alt="Perk Properties" class="d-lg-inline-block d-inline-block" width="40%">
						</a>
						<div class="d-lg-none ml-auto">
							<button class="navbar-toggler border-0 px-0 collapsed" type="button" data-toggle="collapse" data-target="#primaryMenu01" aria-controls="primaryMenu01" aria-expanded="false" aria-label="Toggle navigation"> <span class="text-primary fs-24"><i class="fa fa-bars"></i></span> </button>
						</div>
					</div>
					<div class="navbar-collapse mt-3 mt-lg-0 mx-auto flex-grow-0 collapse mr-0" id="primaryMenu01">
						
						<ul class="navbar-nav hover-menu main-menu px-0 mx-lg-n5">
							<li id="navbar-item-home" aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-2 py-lg-5 px-0 px-lg-4">
								<a class="nav-link p-0 text-black {{ Request::route()->getName() == 'frontend.index' ? 'navbar-active' : '' }}" href="{{ route('frontend.index') }}">Home</a>
							</li>
							<li id="navbar-item-property" aria-haspopup="true" aria-expanded="false" class="nav-item dropdown py-2 py-lg-5 px-0 px-lg-4">
								<a class="nav-link p-0 text-black {{ (Request::route()->getName() == 'frontend.properties' || Request::route()->getName() == 'frontend.single-property' || Request::route()->getName() == 'frontend.advance-search' ? 'navbar-active' : '')}}" href="{{ route('frontend.properties') }}">Property</a>
							</li>
							<li id="navbar-item-contact-us" aria-haspopup="true" aria-expanded="false" class="nav-item py-2 py-lg-5 px-0 px-lg-4">
								<a class="nav-link p-0 text-black {{ (Request::route()->getName() == 'frontend.fre' || Request::route()->getName() == 'frontend.single-fre') ? 'navbar-active' : ''}}" href="{{route('frontend.fre')}}">FRE</a>
							</li>
							<li id="navbar-item-dashboard" aria-haspopup="true" aria-expanded="false" class="nav-item py-2 py-lg-5 px-0 px-lg-4">
								<a class="nav-link p-0 text-black {{ Request::route()->getName() == 'frontend.testimonials' ? 'navbar-active' : '' }}" href="{{ route('frontend.testimonials')}}">Testimonials</a>
							</li>
							<li id="navbar-item-contact-us" aria-haspopup="true" aria-expanded="false" class="nav-item py-2 py-lg-5 px-0 px-lg-4">
								<a class="nav-link p-0 text-black {{ Request::route()->getName() == 'frontend.about-us' ? 'navbar-active' : '' }}" href="{{ route('frontend.about-us') }}">About&nbsp;Us</a>
							</li>
							<li id="navbar-item-dashboard" aria-haspopup="true" aria-expanded="false" class="nav-item py-2 py-lg-5 px-0 px-lg-4">
								<a class="nav-link p-0 text-black {{ (Request::route()->getName() == 'frontend.blogs' || Request::route()->getName() == 'frontend.single-blog' || Request::route()->getName() == 'blogs.single-blog-preview' || Request::route()->getName() == 'blogs.preview' || Request::route()->getName() == 'blogs.preview.tag') ? 'navbar-active' : '' }}" href="{{ route('frontend.blogs') }}">Blogs</a>
							</li>
							<li id="navbar-item-contact-us" aria-haspopup="true" aria-expanded="false" class="nav-item py-2 py-lg-5 px-0 px-lg-4">
								<a class="nav-link p-0 text-black {{ Request::route()->getName() == 'frontend.contact-us' ? 'navbar-active' : '' }}" href="{{ route('frontend.contact-us') }}">Contact&nbsp;Us</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>
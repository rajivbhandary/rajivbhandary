<section class="bg-white shadow-5 pb-1">
	<div class="container">
		<div class="galleries position-relative" data-animate="zoomIn">
			<div class="slick-slider slider-for" data-slick-options='{"slidesToShow": 1, "autoplay":true,"dots":false,"arrows":false,"asNavFor": ".slider-nav"}'>
				<div class="box">
					<div class="item item-size-3-2 mt-3">
						<div class="card p-0 hover-change-image">
							<a href="{{asset("storage/{$fre->feature_image_path}")}}" class="card-img" data-gtf-mfp="true" data-gallery-id="00" style="background-image:url('{{asset("storage/{$fre->feature_image_path}")}}')"></a>
						</div>
					</div>
				</div>
				@foreach ($fre->image as $img)
				<div class="box">
					<div class="item item-size-3-2 mt-3">
						<div class="card p-0 hover-change-image">
							<a href="{{asset("storage/{$img->image->path}")}}" class="card-img" data-gtf-mfp="true" data-gallery-id="0{{$loop->index + 1}}" style="background-image:url('{{asset("storage/{$img->image->path}")}}')"></a>
						</div>
					</div>
				</div>
				@endforeach		
			</div>
			<div id="slick-gallery" class="slick-slider slider-nav mt-1 mx-n1 arrow-haft-inner" data-slick-options='{"slidesToShow": 6, "slidesToScroll": 6, "autoplay":false, "dots":true,"arrows":false, "asNavFor": ".slider-for","focusOnSelect": true,"responsive":[{"breakpoint": 1200,"settings": {"slidesToShow": 4,"arrows":false}},{"breakpoint": 768,"settings": {"slidesToShow": 4,"arrows":false}},{"breakpoint": 576,"settings": {"slidesToShow": 2,"arrows":false}}]}'>
				<div class="box pb-6 px-0">
					<div class="bg-white p-1 shadow-hover-xs-3 h-100 rounded-lg"> <img src="{{asset("storage/{$fre->feature_image_path}")}}" alt="Gallery 00" class="h-100 w-100 rounded-lg"> </div>
				</div>
				@foreach ($fre->image as $img)
				<div class="box pb-6 px-0">
					<div class="bg-white p-1 shadow-hover-xs-3 h-100 rounded-lg"> <img src="{{asset("storage/{$img->image->path}")}}" alt="Gallery 0{{$loop->index + 1}}" class="h-100 w-100 rounded-lg"> </div>
				</div>
				@endforeach
				
			</div>
		</div>
	</div>
</section>
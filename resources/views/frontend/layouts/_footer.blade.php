<footer class="pp-footer">
    <div class="container">
        <div class="pp-footer__grid">
            <div class="pp-footer__about">
                <a class="pp-footer__logo" href="{{ route('frontend.index') }}" aria-label="Perks Properties home">
                    <img src="{{ asset('assets/frontend/img/brand/perks-logo-light.png') }}" alt="Perks Properties" width="152" height="46" loading="lazy">
                </a>
                <p class="mt-3 mb-0">
                    Buying, selling, renting and investing in residential and commercial property
                    across Mumbai and Thane since 1999.
                </p>
            </div>

            <div>
                <h2>Explore</h2>
                <ul>
                    <li><a href="{{ route('frontend.properties') }}">Properties</a></li>
                    <li><a href="{{ route('frontend.fre') }}">Fractional ownership</a></li>
                    <li><a href="{{ route('frontend.blogs') }}">Blog</a></li>
                    <li><a href="{{ route('frontend.testimonials') }}">Client stories</a></li>
                    <li><a href="{{ route('frontend.about-us') }}">About us</a></li>
                    <li><a href="{{ route('frontend.contact-us') }}">Contact</a></li>
                </ul>
            </div>

            <div>
                <h2>Visit or call</h2>
                <address>
                    <strong>Colaba</strong>
                    Office No. 32, Maker Arcade, Cuffe Parade, Mumbai 400005
                </address>
                <address>
                    <strong>Thane</strong>
                    Plot B-39, 3rd Floor, Bhoomi Velocity, Road No. 16, Wagle Industrial Estate, Thane West 400604
                </address>
                <ul>
                    @if ($config->phone_href)
                        <li><i class="fa fa-phone mr-2" aria-hidden="true"></i><a href="tel:{{ $config->phone_href }}">{{ $config->phone_display }}</a></li>
                    @endif
                    @if ($config->whatsappUrl())
                        <li><i class="fa fa-whatsapp mr-2" aria-hidden="true"></i><a href="{{ $config->whatsappUrl('Hi Perks Properties, I have a property enquiry.') }}" target="_blank" rel="noopener">WhatsApp us</a></li>
                    @endif
                    @if ($config->contact_email)
                        <li><i class="fa fa-envelope mr-2" aria-hidden="true"></i><a href="mailto:{{ $config->contact_email }}">{{ $config->contact_email }}</a></li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="pp-footer__bottom">
            <span>&copy; {{ date('Y') }} Perks Properties. All rights reserved.</span>
            <a href="{{ route('frontend.privacy') }}">Privacy policy</a>
        </div>
    </div>
</footer>

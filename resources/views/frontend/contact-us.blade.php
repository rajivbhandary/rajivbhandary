@extends('frontend.layouts.app')

@section('title', 'Contact Perks Properties | Colaba & Thane offices')
@section('seo-description'){{ optional($page_seo)->seo_description ?: 'Call, WhatsApp or visit Perks Properties at our Colaba and Thane offices, or send an enquiry and an advisor will call you back.' }}
@endsection

@section('main-content')
    @include('frontend.layouts.shared._page-hero', [
        'title' => 'Contact us',
        'subtitle' => 'Send us your requirement and an advisor will call you back, or reach us directly.',
    ])

    <section class="pp-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mb-8 mb-lg-0">
                    <div class="pp-panel">
                        <h2>Send an enquiry</h2>
                        @include('frontend.layouts.shared._enquiry-form', ['formId' => 'contactForm'])
                    </div>
                </div>
                <div class="col-lg-5">
                    @if ($config->phone_href || $config->whatsappUrl() || $config->contact_email)
                        <div class="pp-panel">
                            <h2>Talk to us</h2>
                            <ul class="pp-contact-list">
                                @if ($config->phone_href)<li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{ $config->phone_href }}">{{ $config->phone_display }}</a></li>@endif
                                @if ($config->whatsappUrl())<li><i class="fa fa-whatsapp" aria-hidden="true"></i> <a href="{{ $config->whatsappUrl('Hi Perks Properties, I have a property enquiry.') }}" target="_blank" rel="noopener">WhatsApp us</a></li>@endif
                                @if ($config->contact_email)<li><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:{{ $config->contact_email }}">{{ $config->contact_email }}</a></li>@endif
                            </ul>
                        </div>
                    @endif
                    <div class="pp-office mb-4">
                        <h3>Colaba office</h3>
                        <address>Office No. 32, Maker Arcade, Cuffe Parade, Mumbai, Maharashtra 400005</address>
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode('Maker Arcade, Cuffe Parade, Mumbai 400005') }}" target="_blank" rel="noopener"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i>Get directions</a>
                    </div>
                    <div class="pp-office">
                        <h3>Thane office</h3>
                        <address>Plot B-39, 3rd Floor, Bhoomi Velocity, Road No. 16, Wagle Industrial Estate, Thane West, Maharashtra 400604</address>
                        <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode('Bhoomi Velocity, Wagle Industrial Estate, Thane West 400604') }}" target="_blank" rel="noopener"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i>Get directions</a>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                @include('frontend.layouts._map', ['lat' => '18.91686099862324', 'lng' => '72.81799253695633', 'label' => 'Perks Properties, Colaba office'])
            </div>
        </div>
    </section>
@endsection

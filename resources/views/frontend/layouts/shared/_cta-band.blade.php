<section class="pp-section pt-0" aria-label="Talk to an advisor">
    <div class="container">
        <div class="pp-band">
            <div>
                <h2>Not sure where to start?</h2>
                <p>Tell us your budget and preferred area. An advisor will call you back with options.</p>
            </div>
            <div class="pp-band__actions">
                <button type="button" class="pp-btn pp-btn--primary" data-toggle="modal" data-target="#enquiryModal" data-enquire>Request a call back</button>
                @if ($config->whatsappUrl())
                    <a class="pp-btn pp-btn--whatsapp" href="{{ $config->whatsappUrl('Hi Perks Properties, I am looking for a property.') }}" target="_blank" rel="noopener"><i class="fa fa-whatsapp" aria-hidden="true"></i> WhatsApp</a>
                @endif
            </div>
        </div>
    </div>
</section>

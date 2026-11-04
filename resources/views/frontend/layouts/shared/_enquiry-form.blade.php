{{--
    Short lead form, posted with JavaScript (perks.js) and validated by
    CreateEnquiryRequest. Expects: $formId (unique), optional $model/$modelId.
--}}
@php
    $p = $formId;
    $fallback = $config->phone_display
        ? 'Your enquiry could not be sent. Please call us on ' . $config->phone_display . '.'
        : 'Your enquiry could not be sent. Please try again in a moment.';
@endphp
<form id="{{ $p }}" action="{{ route('frontend.enquiry') }}" method="POST" novalidate data-enquiry-form data-fallback="{{ $fallback }}">
    @csrf
    <div class="pp-form-status" data-form-status role="status" aria-live="polite" tabindex="-1" hidden></div>

    <input type="hidden" name="model" value="{{ $model ?? '' }}">
    <input type="hidden" name="model_id" value="{{ $modelId ?? '' }}">
    <div class="pp-honeypot" aria-hidden="true">
        <label for="{{ $p }}-website">Leave this empty</label>
        <input type="text" id="{{ $p }}-website" name="website" tabindex="-1" autocomplete="off">
    </div>

    <div class="pp-form-grid">
        <div class="pp-field">
            <label for="{{ $p }}-name">Your name</label>
            <input type="text" id="{{ $p }}-name" name="name" required minlength="2" maxlength="100" autocomplete="name">
        </div>
        <div class="pp-field">
            <label for="{{ $p }}-phone">Mobile number</label>
            <input type="tel" id="{{ $p }}-phone" name="phone_number" required inputmode="tel" autocomplete="tel" placeholder="98200 12345">
        </div>
        <div class="pp-field pp-field--full">
            <label for="{{ $p }}-email">Email <span class="pp-hint">(optional)</span></label>
            <input type="email" id="{{ $p }}-email" name="email" autocomplete="email" maxlength="255">
        </div>
        <div class="pp-field pp-field--full">
            <label for="{{ $p }}-message">What are you looking for? <span class="pp-hint">(optional)</span></label>
            <textarea id="{{ $p }}-message" name="message" maxlength="500" rows="3" placeholder="e.g. 2 BHK in Mulund under ₹1.5 Cr, ready to move"></textarea>
        </div>
    </div>

    <button type="submit" class="pp-btn pp-btn--primary pp-btn--block mt-3">Request a call back</button>
    <p class="pp-form-note">We only use these details to reply to your enquiry. <a href="{{ route('frontend.privacy') }}">Privacy policy</a></p>
</form>

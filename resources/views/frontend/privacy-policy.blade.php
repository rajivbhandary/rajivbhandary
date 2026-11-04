@extends('frontend.layouts.app')

@section('title', 'Privacy Policy | Perks Properties')
@section('seo-description'){{ optional($page_seo)->seo_description ?? 'How Perks Properties collects, uses and protects the personal data you share with us.' }}@endsection

@section('main-content')
    @include('frontend.layouts.shared._page-hero', ['title' => 'Privacy Policy'])

    <section class="py-10">
        <div class="container prose-container">
            <p class="text-muted">Last updated: {{ \Carbon\Carbon::parse('2026-11-04')->format('j F Y') }}</p>

            <p>Perks Properties ("we", "us") respects your privacy. This policy explains what personal data we collect through this website, why we collect it and the choices you have. It is written to meet the Digital Personal Data Protection Act, 2023.</p>

            <h2>What we collect</h2>
            <ul>
                <li><strong>Details you give us</strong> when you send an enquiry: your name, mobile number, and optionally your email address, city and message, plus the listing you asked about.</li>
                <li><strong>Visit information</strong> recorded automatically: the pages you open, your IP address, browser and device type. We use this to understand which listings are popular and to protect the site from abuse.</li>
            </ul>

            <h2>How we use it</h2>
            <ul>
                <li>To contact you about the property or investment you enquired about.</li>
                <li>To send you a confirmation email when you give us an email address.</li>
                <li>To improve the website and keep it secure.</li>
            </ul>
            <p>We do not sell your personal data. We share it only with the property owner or developer concerned when you ask us to arrange a visit or deal, and with service providers who host this website or send our email, under confidentiality obligations.</p>

            <h2>How long we keep it</h2>
            <p>We keep enquiry details for as long as we are helping you and for up to three years afterwards for our business records, unless the law requires longer. Visit logs are deleted periodically.</p>

            <h2>Your rights</h2>
            <p>You can ask us to show, correct or delete the personal data we hold about you, or withdraw your consent to being contacted, at any time. We will respond within 30 days.</p>

            <h2>Contact</h2>
            <p>
                For privacy questions or requests, contact our grievance officer
                @if ($config->contact_email)
                    at <a href="mailto:{{ $config->contact_email }}">{{ $config->contact_email }}</a>
                @endif
                @if ($config->phone_display)
                    or call <a href="tel:{{ $config->phone_href }}">{{ $config->phone_display }}</a>
                @endif
                , or write to us at Office No. 32, Maker Arcade, Cuffe Parade, Mumbai, Maharashtra 400005.
            </p>
        </div>
    </section>
@endsection

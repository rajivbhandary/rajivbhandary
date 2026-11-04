<div class="modal fade pp-modal" id="enquiryModal" tabindex="-1" role="dialog" aria-labelledby="enquiryModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="enquiryModalTitle">Get a call back</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="pp-modal__about" id="enquiryAbout">Tell us what you are looking for and we will call you back.</p>
                @include('frontend.layouts.shared._enquiry-form', ['formId' => 'enquiryForm'])
            </div>
        </div>
    </div>
</div>

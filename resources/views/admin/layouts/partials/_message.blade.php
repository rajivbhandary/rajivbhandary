@if(session()->has('success'))
    <div class="alert alert-brand fade show" role="alert">
        <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
        <div class="alert-text">{{ session()->get('success') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
@endif

@if(session()->has('error'))
<div class="alert alert-warning fade show" role="alert">
    <div class="alert-icon"><i class="flaticon2-exclamation"></i></div>
    <div class="alert-text">{{ session()->get('error') }}</div>
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="la la-close"></i></span>
        </button>
    </div>
</div>
@endif


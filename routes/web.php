<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/***************************************************
 *                  FRONT SIDE                     *
 ***************************************************/
Route::middleware(['shetabit'])->group(function () {

    Route::get('/', 'frontend\WelcomeController@index')->name('frontend.index');

    Route::get('/about-us', 'frontend\WelcomeController@about')->name('frontend.about-us');
    Route::get('/contact-us', 'frontend\WelcomeController@contact')->name('frontend.contact-us');
    Route::get('/privacy-policy', 'frontend\WelcomeController@privacy')->name('frontend.privacy');

    Route::get('/testimonials', 'frontend\TestimonialsController@index')->name('frontend.testimonials');

    Route::get('/properties-list', 'frontend\PropertiesController@index')->name('frontend.properties');
    Route::get('/properties/{slug}', 'frontend\PropertiesController@show')->name('frontend.single-property');
    // Search uses GET so results can be refreshed, bookmarked and shared.
    Route::get('/advance-search', 'frontend\PropertiesController@advanceSearch')->name('frontend.advance-search');

    Route::get('/fre-list', 'frontend\FREController@index')->name('frontend.fre');
    Route::get('/fre/{slug}', 'frontend\FREController@show')->name('frontend.single-fre');

    Route::get('/blogs', 'frontend\BlogsController@index')->name('frontend.blogs');
    Route::get('/blogs/{slug}', 'frontend\BlogsController@show')->name('frontend.single-blog');
    Route::get('/blogs/tag/{slug}', 'frontend\BlogsController@tag')->name('frontend.blogs.tag');

    Route::post('/enquiry', 'frontend\EnquiriesController@submitEnquiry')
        ->middleware('throttle:5,1')
        ->name('frontend.enquiry');
});

// Old URL that used to crash; keep links and bookmarks working.
Route::redirect('/property-list', '/properties-list', 301);

Route::get('/sitemap.xml', 'frontend\SitemapController@index')->name('sitemap');

/***************************************************
 *                  AUTH                           *
 ***************************************************/
// Public sign-up is disabled: accounts are created by a super-admin
// from the control panel.
Auth::routes(['register' => false]);

/***************************************************
 *     CONTROL PANEL: every signed-in role         *
 *     (authors only need their blogs + profile)   *
 ***************************************************/
Route::middleware(['auth'])->prefix('control-panel')->group(function () {

    Route::get('/dashboard', 'admin\DashboardController@index')->name('admin.dashboard');

    /*********** Own account ***********/
    Route::get('/users/change-password', 'admin\AccountPasswordsController@changePassword')->name('users.change-password');
    Route::put('/users/update-password', 'admin\AccountPasswordsController@updatePassword')->name('users.update-password');
    Route::resource('/users', 'admin\UsersController')->only(['edit', 'update']);

    /*********** Blogs (policies limit authors to their own posts) ***********/
    Route::delete('/blogs/trash/{blog}', 'admin\BlogsController@trash')->name('blogs.trash');
    Route::get('/blogs/trashed', 'admin\BlogsController@trashed')->name('blogs.trashed');
    Route::put('/blogs/restore/{blog}', 'admin\BlogsController@restore')->name('blogs.restore');
    Route::get('/blogs/preview/{slug}', 'admin\PreviewsController@previewSingleBlog')->name('blogs.single-blog-preview');
    Route::get('/blogs/preview/tag/{slug}', 'admin\PreviewsController@previewBlogsOfTag')->name('blogs.preview.tag');
    Route::get('/blogs/preview', 'admin\PreviewsController@previewBlogs')->name('blogs.preview');
    Route::resource('/blogs', 'admin\BlogsController');

    Route::post('/blog-image-upload', 'admin\TinyMCEUploadImagesController@uploadBlogImage')->name('blog-image-upload');
});

// Data tables. Each table checks the caller's role itself.
Route::post('/ajax', 'admin\AjaxController@getData')->middleware('auth')->name('datatable.ajax');

/***************************************************
 *     CONTROL PANEL: admins and super-admins      *
 ***************************************************/
Route::middleware(['auth', 'role:admin,super-admin'])->prefix('control-panel')->group(function () {

    /*********** Blog approval ***********/
    Route::put('/blogs/approve/{blog}', 'admin\BlogsVisibilityController@approve')->name('blogs.approve');
    Route::put('/blogs/disapprove/{blog}', 'admin\BlogsVisibilityController@disapprove')->name('blogs.disapprove');

    /*********** Users ***********/
    Route::delete('/users/trash/{user}', 'admin\UsersController@trash')->name('users.trash');
    Route::get('/users/trashed', 'admin\UsersController@trashed')->name('users.trashed');
    Route::put('/users/restore/{user}', 'admin\UsersController@restore')->name('users.restore');
    Route::put('/users/make-admin/{user}', 'admin\AdminRightsController@makeAdmin')->name('users.make-admin');
    Route::put('/users/revoke-admin/{user}', 'admin\AdminRightsController@revokeAdmin')->name('users.revoke-admin');
    Route::resource('/users', 'admin\UsersController')->except(['edit', 'update']);

    /*********** Tags ***********/
    Route::delete('/tags/trash/{tag}', 'admin\TagsController@trash')->name('tags.trash');
    Route::get('/tags/trashed', 'admin\TagsController@trashed')->name('tags.trashed');
    Route::put('/tags/restore/{tag}', 'admin\TagsController@restore')->name('tags.restore');
    Route::resource('/tags', 'admin\TagsController');

    /*********** Visits ***********/
    Route::post('/visits/delete-all', 'admin\VisitsController@deleteAll')->name('visits.delete.all');
    Route::post('/visits/trash-all', 'admin\VisitsController@trashAll')->name('visits.trash.all');
    Route::post('/visits/restore-all', 'admin\VisitsController@restoreAll')->name('visits.restore.all');
    Route::delete('/visits/trash/{visit}', 'admin\VisitsController@trash')->name('visits.trash');
    Route::get('/visits/trashed', 'admin\VisitsController@trashed')->name('visits.trashed');
    Route::put('/visits/restore/{visit}', 'admin\VisitsController@restore')->name('visits.restore');
    Route::resource('/visits', 'admin\VisitsController');

    /*********** Testimonials ***********/
    Route::delete('/testimonials/trash/{testimonial}', 'admin\TestimonialsController@trash')->name('testimonials.trash');
    Route::get('/testimonials/trashed', 'admin\TestimonialsController@trashed')->name('testimonials.trashed');
    Route::put('/testimonials/restore/{testimonial}', 'admin\TestimonialsController@restore')->name('testimonials.restore');
    Route::resource('/testimonials', 'admin\TestimonialsController');
    Route::post('/testimonial-image-upload', 'admin\TinyMCEUploadImagesController@uploadTestimonialImage')->name('testimonial-image-upload');

    /*********** FRE ***********/
    Route::delete('/fre/trash/{fre}', 'admin\FREController@trash')->name('fre.trash');
    Route::get('/fre/trashed', 'admin\FREController@trashed')->name('fre.trashed');
    Route::put('/fre/restore/{fre}', 'admin\FREController@restore')->name('fre.restore');
    Route::resource('/fre', 'admin\FREController');
    Route::post('/fre-image-upload/{folderName}', 'admin\ImageUploadController@uploadFreImage')->name('fre-image-upload');

    /*********** Properties ***********/
    Route::delete('/properties/trash/{property}', 'admin\PropertiesController@trash')->name('properties.trash');
    Route::get('/properties/trashed', 'admin\PropertiesController@trashed')->name('properties.trashed');
    Route::put('/properties/restore/{properties}', 'admin\PropertiesController@restore')->name('properties.restore');
    Route::resource('/properties', 'admin\PropertiesController');
    Route::post('/property-image-upload/{foldername}', 'admin\ImageUploadController@uploadPropertyImage')->name('property-image-upload');

    /*********** Site settings and page SEO ***********/
    Route::resource('/config', 'admin\ConfigController')->except(['create', 'store', 'destroy', 'show']);
    Route::resource('/pages', 'admin\PagesController')->except(['create', 'store', 'destroy', 'show']);

    /*********** Enquiries ***********/
    Route::get('/enquiries/export', 'admin\ExportsController@exportEnquiries')->name('enquiries.export');
    Route::post('/enquiries/delete-all', 'admin\EnquiriesController@deleteAll')->name('enquiries.delete.all');
    Route::post('/enquiries/trash-all', 'admin\EnquiriesController@trashAll')->name('enquiries.trash.all');
    Route::post('/enquiries/restore-all', 'admin\EnquiriesController@restoreAll')->name('enquiries.restore.all');
    Route::delete('/enquiries/trash/{enquiry}', 'admin\EnquiriesController@trash')->name('enquiries.trash');
    Route::get('/enquiries/trashed', 'admin\EnquiriesController@trashed')->name('enquiries.trashed');
    Route::put('/enquiries/restore/{enquiry}', 'admin\EnquiriesController@restore')->name('enquiries.restore');
    Route::resource('/enquiries', 'admin\EnquiriesController');
});

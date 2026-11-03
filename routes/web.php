<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/***************************************************
 *                  FRONT SIDE                     *
 ***************************************************/
Route::middleware(['shetabit'])->group(function (){

    Route::get(
        '/',
        'frontend\WelcomeController@index'
    )->name('frontend.index');

    Route::get('/property-list', function(){
        return view('frontend.property-list');
    })->name('frontend.properties');

    Route::get(
        '/fre-list',
        'frontend\FREController@index'
    )->name('frontend.fre');

    Route::get(
        '/fre/{slug}',
        'frontend\FREController@show'
    )->name('frontend.single-fre');

    Route::get(
        '/about-us',
        'frontend\WelcomeController@about'
    )->name('frontend.about-us');

    Route::get(
        '/contact-us',
        'frontend\WelcomeController@contact'
    )->name('frontend.contact-us');

    Route::get(
        '/testimonials',
        'frontend\TestimonialsController@index'
    )->name('frontend.testimonials');

    Route::get(
        '/properties-list',
        'frontend\PropertiesController@index'
    )->name('frontend.properties');

    Route::get(
        '/properties/{slug}',
        'frontend\PropertiesController@show'
    )->name('frontend.single-property');

    Route::get(
        '/blogs',
        'frontend\BlogsController@index'
    )->name('frontend.blogs');

    Route::get(
        '/blogs/{slug}',
        'frontend\BlogsController@show'
    )->name('frontend.single-blog');

    Route::get(
        '/blogs/tag/{slug}',
        'frontend\BlogsController@tag'
    )->name('frontend.blogs.tag');

    Route::get(
        '/fre-list',
        'frontend\FREController@index'
    )->name('frontend.fre');

    Route::get(
        '/fre/{slug}',
        'frontend\FREController@show'
    )->name('frontend.single-fre');

    /*********** Enquiry ***********/
    Route::post(
        '/enquiry',
        'frontend\EnquiriesController@submitEnquiry'
    )->name('frontend.enquiry');

     /*********** Advance Search ***********/
     Route::post(
        '/advance-search',
        'frontend\PropertiesController@advanceSearch'
    )->name('frontend.advance-search');

});
/***************************************************
 *                  AUTH                    *
 ***************************************************/
Auth::routes();


/***************************************************
 *                  ADMIN SIDE                     *
 ***************************************************/
Route::middleware(['auth'])->group(function (){

    /*********** Dashboard ***********/
    Route::get(
        '/control-panel/dashboard',
        'admin\DashboardController@index'
    )->name('admin.dashboard');

    /*********** Exports ***********/
    Route::get(
        '/control-panel/enquiries/export',
        'admin\ExportsController@exportEnquiries'
    )->name('enquiries.export');

    /*********** Users ***********/
    Route::delete(
        '/control-panel/users/trash/{user}',
        'admin\UsersController@trash'
    )->name('users.trash');
    Route::get(
        '/control-panel/users/trashed',
        'admin\UsersController@trashed'
    )->name('users.trashed');
    Route::put(
        '/control-panel/users/restore/{user}',
        'admin\UsersController@restore'
    )->name('users.restore');
    Route::get(
        '/control-panel/users/change-password',
        'admin\AccountPasswordsController@changePassword'
    )->name('users.change-password');
    Route::put(
        '/control-panel/users/update-password',
        'admin\AccountPasswordsController@updatePassword'
    )->name('users.update-password');
    Route::put(
        '/control-panel/users/make-admin/{user}',
        'admin\AdminRightsController@makeAdmin'
    )->name('users.make-admin');
    Route::put(
        '/control-panel/users/revoke-admin/{user}',
        'admin\AdminRightsController@revokeAdmin'
    )->name('users.revoke-admin');
    Route::resource(
        '/control-panel/users',
        'admin\UsersController'
    );

    /*********** Tags ***********/
    Route::delete(
        '/control-panel/tags/trash/{tag}',
        'admin\TagsController@trash'
    )->name('tags.trash');
    Route::get(
        '/control-panel/tags/trashed',
        'admin\TagsController@trashed'
    )->name('tags.trashed');
    Route::put(
        '/control-panel/tags/restore/{tag}',
        'admin\TagsController@restore'
    )->name('tags.restore');
    Route::resource(
        '/control-panel/tags',
        'admin\TagsController'
    );

    /*********** Blogs ***********/
    Route::delete(
        '/control-panel/blogs/trash/{blog}',
        'admin\BlogsController@trash'
    )->name('blogs.trash');
    Route::get(
        '/control-panel/blogs/trashed',
        'admin\BlogsController@trashed'
    )->name('blogs.trashed');
    Route::put(
        '/control-panel/blogs/restore/{blog}',
        'admin\BlogsController@restore'
    )->name('blogs.restore');
    Route::put(
        '/control-panel/blogs/approve/{blog}',
        'admin\BlogsVisibilityController@approve'
    )->name('blogs.approve');
    Route::put(
        '/control-panel/blogs/disapprove/{blog}',
        'admin\BlogsVisibilityController@disapprove'
    )->name('blogs.disapprove');
    Route::get(
        '/control-panel/blogs/preview/{slug}',
        'admin\PreviewsController@previewSingleBlog'
    )->name('blogs.single-blog-preview');
    Route::get(
        '/control-panel/blogs/preview/tag/{slug}',
        'admin\PreviewsController@previewBlogsOfTag'
    )->name('blogs.preview.tag');
    Route::get(
        '/control-panel/blogs/preview',
        'admin\PreviewsController@previewBlogs'
    )->name('blogs.preview');
    Route::resource(
        '/control-panel/blogs',
        'admin\BlogsController'
    );

    /*********** Visits ***********/
    Route::get(
        '/control-panel/visits/delete-all',
        'admin\VisitsController@deleteAll'
    )->name('visits.delete.all');
    Route::get(
        '/control-panel/visits/trash-all',
        'admin\VisitsController@trashAll'
    )->name('visits.trash.all');
    Route::get(
        '/control-panel/visits/restore-all',
        'admin\VisitsController@restoreAll'
    )->name('visits.restore.all');
    Route::delete(
        '/control-panel/visits/trash/{visit}',
        'admin\VisitsController@trash'
    )->name('visits.trash');
    Route::get(
        '/control-panel/visits/trashed',
        'admin\VisitsController@trashed'
    )->name('visits.trashed');
    Route::put(
        '/control-panel/visits/restore/{visit}',
        'admin\VisitsController@restore'
    )->name('visits.restore');
    Route::resource(
        '/control-panel/visits',
        'admin\VisitsController'
    );

    /*********** Testimonials ***********/
    Route::delete(
        '/control-panel/testimonials/trash/{testimonial}',
        'admin\TestimonialsController@trash'
    )->name('testimonials.trash');
    Route::get(
        '/control-panel/testimonials/trashed',
        'admin\TestimonialsController@trashed'
    )->name('testimonials.trashed');
    Route::put(
        '/control-panel/testimonials/restore/{testimonial}',
        'admin\TestimonialsController@restore'
    )->name('testimonials.restore');
    Route::resource(
        '/control-panel/testimonials',
        'admin\TestimonialsController'
    );

     /*********** FRE ***********/
     Route::delete(
        '/control-panel/fre/trash/{fre}',
        'admin\FREController@trash'
    )->name('fre.trash');
    Route::get(
        '/control-panel/fre/trashed',
        'admin\FREController@trashed'
    )->name('fre.trashed');
    Route::put(
        '/control-panel/fre/restore/{fre}',
        'admin\FREController@restore'
    )->name('fre.restore');
    Route::resource(
        '/control-panel/fre',
        'admin\FREController'
    );


    /*********** Property *********/
    Route::delete(
        '/control-panel/properties/trash/{property}',
        'admin\PropertiesController@trash'
    )->name('properties.trash');
    Route::get(
        '/control-panel/properties/trashed',
        'admin\PropertiesController@trashed'
    )->name('properties.trashed');
    Route::put(
        '/control-panel/properties/restore/{properties}',
        'admin\PropertiesController@restore'
    )->name('properties.restore');
    Route::resource(
        '/control-panel/properties',
        'admin\PropertiesController'
    );


     /*********** Config ***********/
     Route::resource(
        '/control-panel/config',
        'admin\ConfigController'
    )->except(['create', 'store', 'delete', 'show']);

    /*********** Pages ***********/
    Route::resource(
        '/control-panel/pages',
        'admin\PagesController'
    )->except(['create', 'store', 'delete', 'show']);
    
     /*********** Tiny MCE Image Upload ***********/
     Route::post(
        '/control-panel/blog-image-upload',
        'admin\TinyMCEUploadImagesController@uploadBlogImage'
    )->name('blog-image-upload');
    Route::post(
        '/control-panel/testimonial-image-upload',
        'admin\TinyMCEUploadImagesController@uploadTestimonialImage'
    )->name('testimonial-image-upload');
    Route::post(
        '/control-panel/diploma-image-upload',
        'admin\TinyMCEUploadImagesController@uploadDiplomaImage'
    )->name('diploma-image-upload');
    Route::post(
        '/control-panel/course-image-upload',
        'admin\TinyMCEUploadImagesController@uploadCourseImage'
    )->name('course-image-upload');
    
    
    /*********** Ajax ***********/
    Route::post(
        '/ajax',
        'admin\AjaxController@getData'
    )->name('datatable.ajax');

    /*********** Uppy Image Upload ***********/
    Route::post(
        '/control-panel/property-image-upload/{foldername}',
        'admin\ImageUploadController@uploadPropertyImage'
    )->name('property-image-upload');

    Route::post(
        '/control-panel/fre-image-upload/{folderName}',
        'admin\ImageUploadController@uploadFreImage'
    )->name('fre-image-upload');

    /*********** Enquiries ***********/
    Route::get(
        '/control-panel/enquiries/delete-all',
        'admin\EnquiriesController@deleteAll'
    )->name('enquiries.delete.all');
    Route::get(
        '/control-panel/enquiries/trash-all',
        'admin\EnquiriesController@trashAll'
    )->name('enquiries.trash.all');
    Route::get(
        '/control-panel/enquiries/restore-all',
        'admin\EnquiriesController@restoreAll'
    )->name('enquiries.restore.all');
    Route::delete(
        '/control-panel/enquiries/trash/{enquiry}',
        'admin\EnquiriesController@trash'
    )->name('enquiries.trash');
    Route::get(
        '/control-panel/enquiries/trashed',
        'admin\EnquiriesController@trashed'
    )->name('enquiries.trashed');
    Route::put(
        '/control-panel/enquiries/restore/{enquiry}',
        'admin\EnquiriesController@restore'
    )->name('enquiries.restore');
    Route::resource(
        '/control-panel/enquiries',
        'admin\EnquiriesController'
    );
});


<?php

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




Auth::routes();

Route::get('/','front\Front_Home_controller@index');

Route::group(['middleware' => ['auth']], function () {

	// Route::get('/','HomeController@index')->middleware('permission:view.dashboard');
    Route::prefix('admin')->group(function () {
        Route::get('/','HomeController@index')->middleware('permission:view.dashboard');
	    Route::resource('users','UserController');
	    Route::resource('projects','ProjectController');
	    Route::resource('project_categories','ProjectTypeController');
	    Route::resource('project_spec','ProjectSpecificationController');
		Route::resource('project_amenity','ProjectAmenitiesController');
		Route::resource('key_information','KeyInformationController');
		Route::resource('Project_booking','ProjectbookingController');

		Route::resource('photo_image','Photo_imageController');
	    Route::resource('location','LocationController');
	    Route::resource('project_gallery','ProjectGalleryController');
		Route::resource('floorplan','FloorPlanController');
		Route::resource('specification_category','Specification_categoryController');
	    Route::resource('testimonial','TestimonialController');
	    Route::resource('newsandevents','NewsAndEventController');
	    Route::resource('newsimages','NewsImageController');
	    Route::resource('customer_requests','CustomerRequestController');
	    Route::resource('video','VideoController');
	    Route::resource('photo','PhotoAlbumController');
	    Route::resource('enquiries','CustomerRequestController');
	    Route::resource('permission','PermissionController');
	    Route::resource('roles','RoleController');
	    Route::get('permission_roles','PermissionController@getAttachPermissionsToRoles');
	    Route::post('permission_roles','PermissionController@AttachPermissionsToRoles')->name('permission_role');


	    Route::get('sms','CustomerRequestController@getSms');
	    Route::post('sms','CustomerRequestController@sendSms');
	});

});


Route::get('crop-image', 'CropImageController@index');
Route::post('crop-image-before-upload-using-croppie', ['as'=>'croppie.upload-image','uses'=>'CropImageController@uploadCropImage']);

// Route::get('admin/about/create','About_controller@create');
// Route::post('admin/about/save','About_controller@save');
// Route::get('admin/about/list','About_controller@index');
// Route::get('about/actions/{id}','About_controller@edit');
// Route::post('admin/about/edit_save','About_controller@edit_save');
// Route::get('about/delete/{id}','About_controller@delete');

// Route::prefix('front')->group(function () {
Route::get('/home','front\Front_Home_controller@index');
Route::post('/request_callback','front\Front_Home_controller@postRequestCallBack');


Route::get('/projects','front\Front_Project_controller@index');
Route::get('project/view/{id}','front\Front_Project_controller@view');
Route::get('project_gallary/{id}','front\Front_Project_controller@project_gallary');
Route::get('project/category/{id}','front\Front_Project_controller@getProjects');



Route::get('testimonials','front\Front_Testimonial_controller@index');
Route::post('save_testimonoal','front\Front_Testimonial_controller@save_testimonoal');

Route::get('video_gallary','front\Front_Photo_Gallary_controller@videoindex');
Route::get('photo_gallary','front\Front_Photo_Gallary_controller@index');
Route::get('photo_gallary/view/{id}','front\Front_Photo_Gallary_controller@view');

Route::get('news_events_gallary','front\Frot_News_Events_controller@index');
Route::get('news_events_gallary/view/{id}','front\Frot_News_Events_controller@view');

Route::get('about',function(){
	return view('front_end.about');
});

Route::get('contact',function(){
	return view('front_end.contact');
});
// });

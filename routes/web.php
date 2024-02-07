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

Route::get('/foo', function()

{

    $exitCode = Artisan::call('command:composer require maatwebsite/excel', ['--option' => 'foo']);

 

    //

});



Route::get('/', function () {



    return view('welcome');



});



Route::get('/privacy-policy', function () {



    return view('privacy_policy');



});



Route::post('m-logout', 'Auth\LoginController@mobilelogout')->name('m-logout');



Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');





// Registration



Route::get('provisional-registration/{name}/{mobile}', 'Auth\RegisterController@provisionalRegistration')->name('provisional-registration');



Route::post('verify-mobile-number', 'Auth\RegisterController@verifyMobileNumber')->name('verify-mobile-number');







// Ajax Routes



Route::get('get-all-locations', 'Management\MasterController@locations')->name('get-all-locations');



Route::get('areas-of-a-location/{location_id}', 'Management\MasterController@areasOfALocation')->name('areas-of-a-location');



Route::get('housetypes-of-an-area/{area_id}', 'Management\MasterController@housetypesOfAnArea')->name('housetypes-of-an-area');



Route::get('blocks-of-a-housetype/{housetype_id}', 'Management\MasterController@blocksOfAHousetype')->name('blocks-of-a-housetype');



Route::get('housetypes-of-a-location/{location_id}', 'Management\MasterController@housetypesOfALocation')->name('housetypes-of-a-location');



Route::get('quarters-of-a-block/{block_id}', 'Management\MasterController@quartersOfABlock')->name('quarters-of-a-block');



Route::get('buildings-of-an-area/{area_id}', 'Management\MasterController@buildingsOfAnArea')->name('buildings-of-an-area');



Route::get('categories-of-a-super-category/{cat_id}', 'Management\MasterController@categoriesOfASuperCategory')->name('categories-of-a-super-category');



Route::get('subcategories-of-a-category/{area_id}', 'Management\MasterController@subcategoriesOfACategory')->name('subcategories-of-a-category');







// Dashboard Routes



Route::namespace('Management')->prefix('management')->middleware('role:super-admin,helpdesk,sse,aden,den,sden')->name('management.')->group(function () {



    Route::get('dashboard', 'ManagementController@index')->name('dashboard');



});







Route::namespace('Management')->prefix('management')->middleware('role:super-admin,sden')->name('management.')->group(function () {



    Route::resource('locations', 'LocationController', ['except' => ['show']]);



    Route::resource('areas', 'AreaController', ['except' => ['show']]);



    Route::resource('housetypes', 'HousetypeController', ['except' => ['show']]);



    Route::resource('blocks', 'BlockController', ['except' => ['show']]);



    Route::resource('quarters', 'QuarterController');



    Route::resource('categories', 'CategoryController', ['except' => ['show']]);



    Route::resource('super-categories', 'SuperCategoryController', ['except' => ['show']]);



    Route::resource('sub-categories', 'SubCategoryController', ['except' => ['show']]);



    Route::resource('service-buildings', 'ServiceBuildingController');



    Route::resource('admins', 'AdminController');

    

    Route::resource('escalations', 'EscalationController', ['except' => ['show']]);



    Route::resource('location-mapping', 'LocationMappingController');







    // Datatables AJAX Routes



    Route::get('get-locations', 'LocationController@getLocations')->name('get-locations');



    Route::get('get-areas', 'AreaController@getAreas')->name('get-areas');



    Route::get('get-housetypes', 'HousetypeController@getHousetypes')->name('get-housetypes');



    Route::get('get-blocks', 'BlockController@getBlocks')->name('get-blocks');



    Route::get('get-quarters', 'QuarterController@getQuarters')->name('get-quarters');



    Route::get('get-super-categories', 'SuperCategoryController@getSuperCategories')->name('get-super-categories');



    Route::get('get-categorixes', 'CategoryController@getCategories')->name('get-categories');



    Route::get('get-sub-categories', 'SubCategoryController@getSubCategories')->name('get-sub-categories');



    Route::get('get-service-buildings', 'ServiceBuildingController@getServiceBuildings')->name('get-service-buildings');



    Route::get('get-admins', 'AdminController@getAdmins')->name('get-admins');

    

    Route::get('get-escalations', 'EscalationController@getEscalations')->name('get-escalations');



    

    Route::get('get-complaints_esc', 'ManagementController@getcomplaints_esc')->name('get-complaints_esc');



    Route::get('get-count', 'CountController@getCount')->name('get-count');

});







Route::middleware('role:sse,helpdesk,user,sden,den,aden,super-admin')->group(function () {



    Route::resource('complaints', 'ComplaintController', ['except' => ['edit', 'update', 'delete']]);

    

    Route::get('get-all-complaints', 'ComplaintController@getAllComplaints')->name('get-all-complaints');



    Route::get('all-complaints', 'ComplaintController@getAllComp')->name('all-complaints');



    Route::get('complaint/initiated', 'ComplaintController@getInitiated')->name('complaint.initiated');



    Route::get('complaint/allocated', 'ComplaintController@getAllocated')->name('complaint.allocated');



    Route::get('complaint/resolved', 'ComplaintController@getResolved')->name('complaint.resolved');



    Route::get('complaint/complaint-report', 'ComplaintController@complaintReport')->name('complaint.complaint-report');



    Route::get('complaint/month-wise-complaint-report', 'ComplaintController@monthwisecomplaintReport')->name('complaint.month-wise-complaint-report');

    

    // Route For QuaterWiseConplaintReport By Shubham

    

    Route::get('complaint/quarter-wise-complaint-report', 'ComplaintController@quaterwisecomplaintReport')->name('complaint.quarter-wise-complaint-report');



    // Route For QuaterWiseConplaintReport By Shubham End



    Route::get('complaint/all-complaint-report', 'ComplaintController@allcomplaintReport')->name('complaint.all-complaint-report');



    Route::post('complaint/mark-duplicate/{comp_id}', 'ComplaintController@markDuplicateComp')->name('complaint.mark-duplicate');



    Route::post('complaint/{id}/allocate-job', 'SSE\AllocateJobController@allocateJob')->name('complaint.allocate-job');



    Route::post('complaint/{id}/resolve-job', 'SSE\AllocateJobController@resolveJob')->name('complaint.resolve-job');



    Route::get('complaint/{id}/feedback', 'SSE\AllocateJobController@feedback')->name('complaint.feedback');



    Route::post('complaint/{id}/feedback', 'SSE\AllocateJobController@submitFeedback')->name('complaint.submit.feedback');

    // Route::match(['get','post'] , 'complaint/{id}/feedback', [
    //     'get' => 'SSE\AllocateJobController@feedback',
    //     'post' => 'SSE\AllocateJobController@submitFeedback'
    // ])->name('complaint.feedback');

    //mobile-view create complaint routes



    Route::get('complaint/complaint-type', 'ComplaintController@getComplaintTypePage')->name('complaint.complaint-type');



    Route::get('complaint/location', 'ComplaintController@getComplaintLocationPage')->name('complaint.location');



    Route::get('complaint/building/{id}', 'ComplaintController@getComplaintBuildingPage')->name('complaint.building');



    Route::get('complaint/super-categories', 'ComplaintController@getSuperCategoryPage')->name('complaint.super-categories');



    Route::get('complaint/categories/{id}', 'ComplaintController@getCategoryPage')->name('complaint.categories');



    Route::get('complaint/sub-categories/{id}', 'ComplaintController@getSubCategoryPage')->name('complaint.sub-categories');



    Route::get('complaint/submit-complaint/{id}', 'ComplaintController@getSubmitComplaint')->name('complaint.submit-complaint');





    // Datatables AJAX Routes



    Route::get('get-complaints/{status}', 'ComplaintController@getComplaints')->name('get-complaints');



    Route::get('get-complaint-report/{data}', 'ComplaintController@getcomplaintReport')->name('get-complaint-report');



    Route::get('get-monthly-complaint-report/{data}', 'ComplaintController@getmonthlycomplaintReport')->name('get-monthly-complaint-report');

    

    //Routes added by Saurabh Negi for Escalated complaints for different roles

   

    Route::get('complaint/escalated', 'ComplaintController@getEscalated')->name('complaint.escalated');



    Route::get('get-escalated-complaints/{data}', 'ComplaintController@get_Escalated_complaints')->name('get-escalated-complaints');

    

    Route::get('location-wise-complaint', 'ComplaintController@getlocationwiseComplaint')->name('location-wise-complaint');



    Route::get('location-wise-all-complaint/{data}', 'ComplaintController@getalllocationwiseComplaints')->name('location-wise-all-complaint');





    // Get Quater Wise complaints reports created by  shubham 

    

    Route::get('get-quarter-wise-complaint-reportByLocation/{data}', 'ComplaintController@getquarterwisecomplaintReportByLocation')->name('get-quarter-wise-complaint-reportByLocation');

    

    Route::get('get-quarter-wise-complaint-reportByLocationAndHouseType/{data}', 'ComplaintController@getquarterwisecomplaintReportByLocationAndHouseType')->name('get-quarter-wise-complaint-reportByLocationAndHouseType');

    

    Route::get('get-quarter-wise-complaint-reportByLocationAndHouseTypeAndBlockNo/{data}', 'ComplaintController@getquarterwisecomplaintReportByLocationAndHouseTypeAndBlockNo')->name('get-quarter-wise-complaint-reportByLocationAndHouseTypeAndBlockNo');

    

    Route::get('get-quarter-wise-complaint-reportByLocationAndHouseTypeAndBlockNoAndQuarterNo/{data}', 'ComplaintController@getquarterwisecomplaintReportByLocationAndHouseTypeAndBlockNoAndQuarterNo')->name('get-quarter-wise-complaint-reportByLocationAndHouseTypeAndBlockNoAndQuarterNo');

    

    // Get Quater Wise complaints reports created by  shubham  End

    

    Route::get('get-count/{data}','CountController@getcount')->name('get-count');



    Route::get('get-all-complaint-report/{data}', 'ComplaintController@getallcomplaintReport')->name('get-all-complaint-report');

    // Get Resources of a Vendor AJAX Route



    Route::get('resources-of-a-vendor/{vendor_id}', 'SSE\ResourceController@resourcesOfAVendor')->name('resources-of-a-vendor');



    // Excel

    Route::get('complaint-export/{data}', 'ComplaintController@ComplaintsExport')->name('complaint-export');

});







Route::namespace('SSE')->prefix('sse')->middleware('role:sse,super-admin')->name('sse.')->group(function () {



    Route::resource('vendors', 'VendorController');



    Route::resource('resources', 'ResourceController');



    // Datatables AJAX Routes



    Route::get('get-vendors', 'VendorController@getVendors')->name('get-vendors');



    Route::get('get-resources', 'ResourceController@getResources')->name('get-resources');



});







Route::namespace('Management')->prefix('management')->middleware('role:sse,helpdesk,super-admin')->name('management.')->group(function () {



    Route::resource('users', 'UserManagementController');



    Route::get('verify-users', 'UserManagementController@getVerifyUsers')->name('verify-users');




    // Datatables AJAX Routes



    Route::get('get-users', 'UserManagementController@getUsers')->name('get-users');



    Route::get('verify-users-list', 'UserManagementController@getVerifyUsersList')->name('verify-users-list');



    Route::post('verify-user/{id}', 'UserManagementController@verifyUser')->name('verify-user');



});







Route::namespace('User')->prefix('user')->middleware('role:user')->name('user.')->group(function () {



    Route::get('dashboard', 'UserController@index')->name('dashboard');



});







Route::namespace('Settings')->prefix('settings')->name('settings.')->group(function () {



    Route::get('change-password', 'ChangePasswordController@showForm')->name('change-password');



    Route::post('post-change-password', 'ChangePasswordController@postChangePassword')->name('post-change-password');



});



// Route::get('send-dlt-sms', function() {

//     $MSG91 = new App\MSG91();

//     $MSG91->sendDltSms('621a03629b02cf387538fab4', '919458943214', 'UP', ['9458943214', 'giks@123']);

// });




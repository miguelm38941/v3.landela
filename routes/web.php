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

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('/', 'homeController@index')->name('home')->middleware('guest');
Route::get('/', 'Auth\LoginController@index')->name('home')->middleware('guest');

Auth::routes();

// Register & Login User
Route::post('/home/login', 'Auth\LoginController@processLogin')
    ->name('home.login')->middleware('guest');
Route::get('/registrations/self_register_form', 'Auth\RegisterController@self_register_form')
    ->name('self_register_form')->middleware('guest');
Route::post('/registrations/self_register', 'Auth\RegisterController@self_register')
    ->name('self_register')->middleware('guest');

// Protected Routes - allows only logged in users
Route::middleware('auth')->group(function () {
    //Consultations
    Route::post('pvv/consultations/new', 'ConsultationsController@createConsultation')->name('add_consultation');
    Route::get('pvv/consultations/index', 'ConsultationsController@index')->name('consultations_list')->middleware('can:consultation-view');
    Route::get('pvv/consultations/index/{filter}', 'ConsultationsController@index')->name('consultations_list_filter')->middleware('can:consultation-view');
    Route::get('pvv/consultations/dashboard/{id}', 'ConsultationsController@details')->name('consultation.dashboard')->middleware('can:consultation-view');
    Route::post('pvv/consultations/update/{id}/adding/infirmier', 'ConsultationsController@update')->name('consultation.update.infirmier')->middleware('can:consultation-update');
    Route::post('pvv/consultations/update/{id}/adding/medecin', 'ConsultationsController@update')->name('consultation.update.medecin')->middleware('can:consultation-update');
    Route::get('pvv/consultations/delete', 'ConsultationsController@index')->name('consultation.destroy')->middleware('can:consultation-delete');
    Route::post('pvv/consultations/{id}/diagnostic/insert', 'ConsultationsController@addDiagnostic')->name('diagnostic.add')->middleware('can:diagnostic');
    Route::post('pvv/consultations/{id}/diagnostic/insert/{diagnostic_id}', 'ConsultationsController@addDiagnostic')->name('diagnostic.edit')->middleware('can:diagnostic');
    
    Route::get('medecin/consultations/prescriptionExamens/{myid}', 'ExamensPrescrits@myExams')->name('medecin.mesexamens')->middleware('can:exams_view');
    //Route::post('pvv/{pvv_id}/consultation/{id}/prescriptionExamens/{medecin_id}', 'ExamensPrescrits@myExams')->name('mesexamens')->middleware('can:view_exams');

    Route::post('pvv/consultations/{id}/ordonnance/create', 'OrdonnancesController@save')->name('ordonnance.save')->middleware('can:diagnostic');
    Route::post('medecin/{id}/ordonnances/display/{filter}/{tag}', 'OrdonnancesController@index')->name('ordonnance.list')->middleware('can:ordonnances_view');

    Route::get('/register', 'Auth\RegisterController@register')
        ->name('register')->middleware('can:is-admin');
    /*Route::post('/register', 'Auth\RegisterController@register')
        ->name('register')->middleware('can:is-admin');        */
    Route::get('/registrations/registration_requests', 'Auth\RegisterController@temps_users')
        ->name('registration_requests')->middleware('can:is-admin');
    Route::delete('/registrations/registration_requests/delete/{id}', 'Auth\RegisterController@removeTempUserRequest')
        ->name('delete_registration_request')->middleware('can:is-admin');    
    Route::post('/registrations/approve_register', 'Auth\RegisterController@approve_register')
        ->name('approve_register')->middleware('can:is-admin');          
    Route::get('/users/displayUsersList', 'UsersController@displayUsers')
        ->name('users.list')->middleware('can:is-admin');         
    Route::get('/users/displayPvvList/pvv_role', 'PvvController@displayPvvList')
        ->name('pvv.list')->middleware('can:view-pvv');
    Route::get('/users/{id}/edit', 'UsersController@editUser')
        ->name('users.edit')->middleware('can:is-admin');
    Route::patch('/users/{id}/update', 'UsersController@update')
        ->name('users.update')->middleware('can:is-admin');
    Route::put('/user/reset_access/{id}', 'Auth\RegisterController@resetAccess')
        ->name('user.reset')->middleware('can:is-admin');
    Route::put('/user/toggle_access/{id}/{value}', 'UsersController@toggleActive')
        ->name('user.toggle.access')->middleware('can:is-admin');
    Route::delete('/user/destroy/{id}', 'UsersController@destroyUser')
        ->name('user.destroy')->middleware('can:is-admin');
    Route::get('/users/search/{searchParam}', 'UsersController@searchUsers')
        ->name('users.search');
    Route::get('/pvvs/search/{searchParam}', 'PvvController@searchPvv')
        ->name('pvvs.search');


});

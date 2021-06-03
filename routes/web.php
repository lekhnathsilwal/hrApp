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

Route::group(['middleware' => 'guest:admin'], function () {
    Route::post('/admin-login', 'AdminController@checkLogin')->name('admin.login');
    Route::get('/', 'AdminController@showLoginForm')->name('admin');
    Route::get('/forget-password','AdminController@forgetPassword')->name('forget.password');
    Route::post('/forget-password-mail','AdminController@forgetPasswordMail')->name('password.reset.mail');
    Route::get('reset-forget-password/{id}','AdminController@resetForgetPassword')->name('reset.forget.password')->middleware('signed');
    Route::post('store-forget-password/{id}','AdminController@storeForgetPassword')->name('store.forget.password');
});
Route::group(['middleware' => 'auth:admin'], function () {
//    Admin Controller
    Route::get('/admin-register', 'AdminController@showAdminRegisterForm')->name('admin.register');
    Route::post('/admin-save', 'AdminController@storeAdmin')->name('admin.store');
    Route::get('/show-admins', 'AdminController@showAdmins')->name('show.admins');
    Route::get('/dashboard', 'AdminController@showDashboard')->name('dashboard');
    Route::get('/show-admin-details/{id}', 'AdminController@showAdminDetails')->name('show.admin.details');
    Route::get('/admin-logout', 'AdminController@logout')->name('admin.logout');
    Route::get('/edit-admin/{id}','AdminController@editAdmin')->name('edit.admin');
    Route::post('/update-admin/{id}','AdminController@updateAdmin')->name('update.admin');
    Route::get('/delete-admin/{id}','AdminController@deleteAdmin')->name('delete.admin');
    Route::get('/change-password','AdminController@changePassword')->name('change.password');
    Route::post('/update-password','AdminController@updatePassword')->name('update.password');
    Route::get('/company-admin-register/{id}','AdminController@companyAdminRegister')->name('company.admin.register');
    Route::get('/remove-pp/{id}','AdminController@removePp')->name('remove.pp');
    Route::post('/upload-pp/{id}','AdminController@uploadPp')->name('upload.pp');
    Route::post('/upload-snap/{id}','AdminController@storeSnap')->name('upload.snap');

//    Department Controller
    Route::get('/show-departments', 'DepartmentController@showDepartments')->name('show.departments');
    Route::get('/add-department', 'DepartmentController@addDepartment')->name('add.department');
    Route::post('/store-department', 'DepartmentController@storeDepartment')->name('department.store');
    Route::get('/edit-department/{id}','DepartmentController@editDepartment')->name('edit.department');
    Route::post('/update-department/{id}','DepartmentController@updateDepartment')->name('update.department');
    Route::get('/delete-department/{id}','DepartmentController@deleteDepartment')->name('delete.department');

//    Section Controller
    Route::get('/show-sections/{id}', 'SectionController@showSections')->name('show.sections');
    Route::get('/add-section/{id}', 'SectionController@addSection')->name('add.section');
    Route::post('/store-section/{id}', 'SectionController@storeSection')->name('section.store');
    Route::get('employee/getSection/{id}', 'SectionController@getSection');
    Route::get('show/section-employees/{id}', 'SectionController@showSectionEmployees')->name('show.sectionEmployees');
    Route::get('/edit-section/{id}','SectionController@editSection')->name('edit.section');
    Route::post('/update-section/{id}','SectionController@updateSection')->name('update.section');
    Route::get('/delete-section/{id}','SectionController@deleteSection')->name('delete.section');

//    Employee Controller
    Route::get('/show-employees', 'EmployeeController@showEmployees')->name('show.employees');
    Route::get('/show-company-present-employees', 'EmployeeController@showCompanyPresentEmployees')->name('show.company.present.employees');
    Route::get('/show-company-past-employees', 'EmployeeController@showCompanyPastEmployees')->name('show.company.past.employees');
    Route::get('/add-employee', 'EmployeeController@addEmployee')->name('add.employee');
    Route::post('/store-employee', 'EmployeeController@storeEmployee')->name('employee.store');
    Route::get('/show-employee-details/{id}', 'EmployeeController@showEmployeeDetails')->name('show.employee.details');
    Route::get('/edit-employee/{id}', 'EmployeeController@editEmployee')->name('edit.employee');
    Route::post('/update-employee/{id}', 'EmployeeController@updateEmployee')->name('update.employee');
    Route::get('/delete-employee/{id}', 'EmployeeController@deleteEmployee')->name('delete.employee');

//    Experience Controller
    Route::get('/add-experience/{id}', 'ExperienceController@addExperience')->name('add.experience');
    Route::post('/store-employee-experience/{id}', 'ExperienceController@storeEmployeeExperience')->name('employee.experience.store');
    Route::get('edit/experience/{id}', 'ExperienceController@editExperience')->name('edit.experience');
    Route::get('delete/experience/{id}', 'ExperienceController@deleteExperience')->name('delete.experience');
    Route::post('update/experience/{id}', 'ExperienceController@updateExperience')->name('update.employee.experience');
    Route::get('show-experience-detail/{id}','ExperienceController@showExperienceDetails')->name('experience.detail');

//    Role Controller
    Route::get('/show-roles', 'RoleController@showRoles')->name('show.roles');
    Route::get('/add-roles', 'RoleController@addRole')->name('add.role');
    Route::post('/store-roles', 'RoleController@storeRole')->name('role.store');
    Route::get('/edit-roles/{id}', 'RoleController@editRole')->name('edit.role');
    Route::post('/update-roles/{id}', 'RoleController@updateRole')->name('update.role');
    Route::get('/delete-roles/{id}', 'RoleController@deleteRole')->name('delete.role');

//    Trash Controller
    Route::get('/show-admin-trash','TrashController@showTrashAdmins')->name('show.admin.trash');
    Route::get('/restore-admin/{id}','TrashController@restoreAdmin')->name('restore.admin');
    Route::get('/permanent-delete-admin/{id}','TrashController@permanentDeleteAdmin')->name('permanent.delete.admin');
    Route::get('/show-role-trash','TrashController@showTrashRoles')->name('show.role.trash');
    Route::get('/restore-role/{id}','TrashController@restoreRole')->name('restore.role');
    Route::get('/permanent-delete-role/{id}','TrashController@permanentDeleteRole')->name('permanent.delete.role');
    Route::get('/show-employee-history-trash','TrashController@showTrashExperience')->name('show.employee.history.trash');
    Route::get('/permanent-delete-experience/{id}','TrashController@permanentDeleteExperience')->name('permanent.delete.experience');
    Route::get('/restore-experience/{id}','TrashController@restoreExperience')->name('restore.experience');
    Route::get('/show-employee-trash','TrashController@showTrashEmployee')->name('show.employee.trash');
    Route::get('/permanent-delete-employee/{id}','TrashController@permanentDeleteEmployee')->name('permanent.delete.employee');
    Route::get('/restore-employee/{id}','TrashController@restoreEmployee')->name('restore.employee');
    Route::get('/show-department-trash','TrashController@showTrashDepartment')->name('show.department.trash');
    Route::get('/show-section-trash','TrashController@showTrashSection')->name('show.section.trash');
    Route::get('/show-trash-section-histories/{id}','TrashController@showTrashSectionHistories')->name('show.trash.section.histories');
    Route::get('/show-trash-department-sections/{id}','TrashController@showTrashDepartmentSections')->name('show.trash.department.sections');
    Route::get('/restore-department/{id}','TrashController@restoreDepartment')->name('restore.department');
    Route::get('/permanent-delete-department/{id}','TrashController@permanentDeleteDepartment')->name('permanent.delete.department');
    Route::get('/restore-section/{id}','TrashController@restoreSection')->name('restore.section');
    Route::get('/permanent-delete-section/{id}','TrashController@permanentDeleteSection')->name('permanent.delete.section');

    //company controller
    Route::get('/create-company','CompanyController@create')->name('create.company');
    Route::post('/store-company','CompanyController@store')->name('store.company');
    Route::get('/edit-company/{id}','CompanyController@edit')->name('edit.company');
    Route::post('/update-company/{id}','CompanyController@update')->name('update.company');
    Route::get('/show-companies','CompanyController@show')->name('show.companies');
    Route::get('/delete-company/{id}','CompanyController@delete')->name('delete.company');
    Route::get('/show-company-details/{id}','CompanyController@showCompanyDetails')->name('show.company.details');

    //super admin controller
    Route::get('/super-admin-register','SuperAdminController@registerSuperAdmin')->name('super.admin.register');
    Route::post('/super-admin-store','SuperAdminController@storeSuperAdmin')->name('super.admin.store');
    Route::get('/edit-super-admin/{id}','SuperAdminController@editSuperAdmin')->name('edit.super.admin');
    Route::post('/update-super-admin/{id}','SuperAdminController@updateSuperAdmin')->name('update.super.admin');

    //search Controller
    Route::get('search/{val}','SearchController@search')->name('search');
});
//Route::get('search/{val}','SearchController@search')->name('search')->middleware('signed');
//<a href="{{URL::SignedRoute('admin.register')}}" role="button" class="btn btn-success"><i class="fa fa-plus"> Add


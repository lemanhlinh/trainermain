<?php
# @Author: Manh Linh
# @Date:   2023-01-01T17:33:09+07:00
# @Email:  lemanhlinh209@gmail.com
# @Last modified by:   Manh Linh
# @Last modified time: 2023-01-01T16:49:02+07:00
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::group(['namespace' => 'Web'], function (){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/khoa-hoc', 'CourseController@index')->name('homeCourse');
    Route::get('/chi-tiet-khoa-hoc/{slug}/{id}', 'CourseController@detail')->name('detailCourse');
    Route::get('/dang-ky-khoa-hoc', 'CourseController@create')->name('orderCourse');
    Route::get('/dang-ky-thanh-cong/{id}', 'CourseController@success')->name('orderCourseSuccess');
    Route::get('/tin-tuc', 'ArticleController@index')->name('homeArticle');
    Route::get('/chi-tiet-tin/{slug}/{id}', 'ArticleController@detail')->name('detailArticle');
    Route::get('/tai-lieu', 'DocumentController@index')->name('homeDocument');
    Route::get('/chi-tiet-tai-lieu/{slug}/{id}', 'DocumentController@detail')->name('detailDocument');
    Route::post('/dang-ky-tai-lieu', 'DocumentController@store')->name('detailDocumentStore');
    Route::get('/lien-he', 'ContactController@index')->name('detailContact');
    Route::get('/tu-van', 'AdvisoryController@index')->name('detailAdvisory');
    Route::post('/lien-he', 'ContactController@store')->name('detailContactStore');
    Route::post('/tu-van', 'AdvisoryController@store')->name('detailAdvisoryStore');
    Route::post('/dang-ky-khoa-hoc', 'CourseController@store')->name('detailCourseStore');
    Route::post('/dang-ky-test', 'MemberTestController@store')->name('detailTestStore');
    Route::get('/chon-bai-thi/{id}', 'MemberTestController@index')->name('detailChooseTest');
    Route::post('/chon-bai-thi/{id}', 'MemberTestController@updateMember')->name('updateMember');
    Route::get('/huong-dan-thi/{id}', 'MemberTestController@guideTest')->name('guideTest');
    Route::get('/bai-thi/{id}', 'MemberTestController@examTest')->name('examTest');
    Route::post('/bai-thi/{id}', 'MemberTestController@saveTest')->name('saveTest');
    Route::get('/trang/{slug}', 'PageController@index')->name('detailPage');
});

//Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
//    ->name('ckfinder_connector');
//
//Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
//    ->name('ckfinder_browser');

//Route::any('/ckfinder/examples/{example?}', '\CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
//Route::any('/ckfinder/examples/{example?}', '\CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
//    ->name('ckfinder_examples');

Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Auth::routes();
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/change-profile', 'UserController@getProfile')->name('getProfile');
    Route::post('/change-profile', 'UserController@changeProfile')->name('changeProfile');
    Route::get('/change-password', 'UserController@changePassword')->name('changePassword');
    Route::post('/update-password', 'UserController@updatePassword')->name('updatePassword');

    Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => ['permission:view_user']], function () {
        Route::get('', 'UserController@index')->name('index');
        Route::get('/create', 'UserController@create')->name('create')->middleware('permission:create_user');
        Route::post('/store', 'UserController@store')->name('store')->middleware('permission:create_user');
        Route::get('/edit/{id}', 'UserController@edit')->name('edit')->middleware('permission:edit_user');
        Route::post('/update/{id}', 'UserController@update')->name('update')->middleware('permission:edit_user');
        Route::post('/destroy/{id}', 'UserController@destroy')->name('destroy')->middleware('permission:delete_user');
    });

    Route::group(['prefix' => 'roles', 'as' => 'roles.', 'middleware' => ['can:view_role']], function () {
        Route::get('', 'RoleController@index')->name('index');
        Route::get('/create', 'RoleController@create')->name('create')->middleware('permission:create_role');
        Route::post('/store', 'RoleController@store')->name('store')->middleware('permission:create_role');
        Route::get('/edit/{id}', 'RoleController@edit')->name('edit')->middleware('permission:edit_role');
        Route::post('/update/{id}', 'RoleController@update')->name('update')->middleware('permission:edit_role');
        Route::post('/destroy/{id}', 'RoleController@destroy')->name('destroy')->middleware('permission:delete_role');
    });

    Route::group(['prefix' => 'setting', 'as' => 'setting.', 'middleware' => ['permission:view_setting']], function () {
        Route::get('', 'SettingController@index')->name('index');
        Route::get('/create', 'SettingController@create')->name('create')->middleware('permission:create_setting');
        Route::post('/store', 'SettingController@store')->name('store')->middleware('permission:create_setting');
        Route::get('/edit/{id}', 'SettingController@edit')->name('edit')->middleware('permission:edit_setting');
        Route::post('/update/{id}', 'SettingController@update')->name('update')->middleware('permission:edit_setting');
        Route::post('/destroy/{id}', 'SettingController@destroy')->name('destroy')->middleware('permission:delete_setting');
        Route::post('/change-active-setting/{id}', 'SettingController@changeActive')->name('changeActive')->middleware('permission:edit_setting');
    });

    Route::group(['prefix' => 'menu-category', 'as' => 'menu-category.', 'middleware' => ['permission:view_menu_categories']], function () {
        Route::get('', 'MenuCategoryController@index')->name('index');
        Route::get('/create', 'MenuCategoryController@create')->name('create')->middleware('permission:create_menu_categories');
        Route::post('/store', 'MenuCategoryController@store')->name('store')->middleware('permission:create_menu_categories');
        Route::get('/edit/{id}', 'MenuCategoryController@edit')->name('edit')->middleware('permission:edit_menu_categories');
        Route::post('/update/{id}', 'MenuCategoryController@update')->name('update')->middleware('permission:edit_menu_categories');
        Route::post('/destroy/{id}', 'MenuCategoryController@destroy')->name('destroy')->middleware('permission:delete_menu_categories');
        Route::post('/update-tree', 'MenuCategoryController@updateTree')->name('updateTree')->middleware('permission:edit_menu_categories');
    });


    Route::group(['prefix' => 'menu', 'as' => 'menu.', 'middleware' => ['permission:view_menu']], function () {
        Route::get('', 'MenuController@index')->name('index');
        Route::get('/create', 'MenuController@create')->name('create')->middleware('permission:create_menu');
        Route::post('/store', 'MenuController@store')->name('store')->middleware('permission:create_menu');
        Route::get('/edit/{id}', 'MenuController@edit')->name('edit')->middleware('permission:edit_menu');
        Route::post('/update/{id}', 'MenuController@update')->name('update')->middleware('permission:edit_menu');
        Route::post('/destroy/{id}', 'MenuController@destroy')->name('destroy')->middleware('permission:delete_menu');
        Route::post('/update-tree', 'MenuController@updateTree')->name('updateTree')->middleware('permission:edit_menu');
    });

    Route::group(['prefix' => 'contact', 'as' => 'contact.', 'middleware' => ['permission:view_contact']], function () {
        Route::get('', 'ContactController@index')->name('index');
    });

    Route::group(['prefix' => 'articles', 'as' => 'article.', 'middleware' => ['permission:view_article']], function () {
        Route::get('', 'ArticleController@index')->name('index');
        Route::get('/create', 'ArticleController@create')->name('create')->middleware('permission:create_article');
        Route::post('/store', 'ArticleController@store')->name('store')->middleware('permission:create_article');
        Route::get('/edit/{id}', 'ArticleController@edit')->name('edit')->middleware('permission:edit_article');
        Route::post('/update/{id}', 'ArticleController@update')->name('update')->middleware('permission:edit_article');
        Route::post('/destroy/{id}', 'ArticleController@destroy')->name('destroy')->middleware('permission:delete_article');
        Route::post('/change-active-article/{id}', 'ArticleController@changeActive')->name('changeActive')->middleware('permission:edit_article');
        Route::post('/change-is-home-article/{id}', 'ArticleController@changeIsHome')->name('changeIsHome')->middleware('permission:edit_article');
    });

    Route::group(['prefix' => 'course', 'as' => 'course.', 'middleware' => ['permission:view_course']], function () {
        Route::get('', 'CourseController@index')->name('index');
        Route::get('/create', 'CourseController@create')->name('create')->middleware('permission:create_course');
        Route::post('/store', 'CourseController@store')->name('store')->middleware('permission:create_course');
        Route::get('/edit/{id}', 'CourseController@edit')->name('edit')->middleware('permission:edit_course');
        Route::post('/update/{id}', 'CourseController@update')->name('update')->middleware('permission:edit_course');
        Route::post('/destroy/{id}', 'CourseController@destroy')->name('destroy')->middleware('permission:delete_course');
        Route::post('/change-active-course/{id}', 'CourseController@changeActive')->name('changeActive')->middleware('permission:edit_course');
    });

    Route::group(['prefix' => 'student', 'as' => 'student.', 'middleware' => ['permission:view_student']], function () {
        Route::get('', 'StudentController@index')->name('index');
        Route::get('/create', 'StudentController@create')->name('create')->middleware('permission:create_student');
        Route::post('/store', 'StudentController@store')->name('store')->middleware('permission:create_student');
        Route::get('/edit/{id}', 'StudentController@edit')->name('edit')->middleware('permission:edit_student');
        Route::post('/update/{id}', 'StudentController@update')->name('update')->middleware('permission:edit_student');
        Route::post('/destroy/{id}', 'StudentController@destroy')->name('destroy')->middleware('permission:delete_student');
        Route::post('/change-active-student/{id}', 'StudentController@changeActive')->name('changeActive')->middleware('permission:edit_student');
    });

    Route::group(['prefix' => 'teacher', 'as' => 'teacher.', 'middleware' => ['permission:view_teacher']], function () {
        Route::get('', 'TeacherController@index')->name('index');
        Route::get('/create', 'TeacherController@create')->name('create')->middleware('permission:create_teacher');
        Route::post('/store', 'TeacherController@store')->name('store')->middleware('permission:create_teacher');
        Route::get('/edit/{id}', 'TeacherController@edit')->name('edit')->middleware('permission:edit_teacher');
        Route::post('/update/{id}', 'TeacherController@update')->name('update')->middleware('permission:edit_teacher');
        Route::post('/destroy/{id}', 'TeacherController@destroy')->name('destroy')->middleware('permission:delete_teacher');
        Route::post('/change-active-teacher/{id}', 'TeacherController@changeActive')->name('changeActive')->middleware('permission:edit_teacher');
    });

    Route::group(['prefix' => 'order', 'as' => 'order.', 'middleware' => ['permission:view_order']], function () {
        Route::get('', 'OrderController@index')->name('index');
        Route::post('/change-status-order/{orderId}/{status}', 'OrderController@changeStatus')->name('changeStatus')->middleware('permission:view_order');
    });

    Route::group(['prefix' => 'advisory', 'as' => 'advisory.', 'middleware' => ['permission:view_advisory']], function () {
        Route::get('', 'AdvisoryController@index')->name('index');
    });

    Route::group(['prefix' => 'program', 'as' => 'program.', 'middleware' => ['permission:view_program']], function () {
        Route::get('', 'ProgramController@index')->name('index');
        Route::get('/create', 'ProgramController@create')->name('create')->middleware('permission:create_program');
        Route::post('/store', 'ProgramController@store')->name('store')->middleware('permission:create_program');
        Route::get('/edit/{id}', 'ProgramController@edit')->name('edit')->middleware('permission:edit_program');
        Route::post('/update/{id}', 'ProgramController@update')->name('update')->middleware('permission:edit_program');
        Route::post('/destroy/{id}', 'ProgramController@destroy')->name('destroy')->middleware('permission:delete_program');
        Route::post('/change-active-program/{id}', 'ProgramController@changeActive')->name('changeActive')->middleware('permission:edit_program');
    });

    Route::group(['prefix' => 'banner', 'as' => 'banner.', 'middleware' => ['permission:view_banner']], function () {
        Route::get('', 'BannerController@index')->name('index');
        Route::get('/create', 'BannerController@create')->name('create')->middleware('permission:create_banner');
        Route::post('/store', 'BannerController@store')->name('store')->middleware('permission:create_banner');
        Route::get('/edit/{id}', 'BannerController@edit')->name('edit')->middleware('permission:edit_banner');
        Route::post('/update/{id}', 'BannerController@update')->name('update')->middleware('permission:edit_banner');
        Route::post('/destroy/{id}', 'BannerController@destroy')->name('destroy')->middleware('permission:delete_banner');
        Route::post('/change-active-banner/{id}', 'BannerController@changeActive')->name('changeActive')->middleware('permission:edit_banner');
    });

    Route::group(['prefix' => 'why-different', 'as' => 'why-different.', 'middleware' => ['permission:view_why_different']], function () {
        Route::get('', 'WhyDifferentController@index')->name('index');
        Route::get('/create', 'WhyDifferentController@create')->name('create')->middleware('permission:create_why_different');
        Route::post('/store', 'WhyDifferentController@store')->name('store')->middleware('permission:create_why_different');
        Route::get('/edit/{id}', 'WhyDifferentController@edit')->name('edit')->middleware('permission:edit_why_different');
        Route::post('/update/{id}', 'WhyDifferentController@update')->name('update')->middleware('permission:edit_why_different');
        Route::post('/destroy/{id}', 'WhyDifferentController@destroy')->name('destroy')->middleware('permission:delete_why_different');
        Route::post('/change-active-why-different/{id}', 'WhyDifferentController@changeActive')->name('changeActive')->middleware('permission:edit_why_different');
    });

    Route::group(['prefix' => 'lesson-test', 'as' => 'lesson-test.', 'middleware' => ['permission:view_lesson_test']], function () {
        Route::get('', 'LessonTestController@index')->name('index');
        Route::get('/create', 'LessonTestController@create')->name('create')->middleware('permission:create_lesson_test');
        Route::post('/store', 'LessonTestController@store')->name('store')->middleware('permission:create_lesson_test');
        Route::get('/edit/{id}', 'LessonTestController@edit')->name('edit')->middleware('permission:edit_lesson_test');
        Route::post('/update/{id}', 'LessonTestController@update')->name('update')->middleware('permission:edit_lesson_test');
        Route::post('/destroy/{id}', 'LessonTestController@destroy')->name('destroy')->middleware('permission:delete_lesson_test');
        Route::post('/change-active-lesson-test/{id}', 'LessonTestController@changeActive')->name('changeActive')->middleware('permission:edit_lesson_test');
    });

    Route::group(['prefix' => 'member-test', 'as' => 'member-test.', 'middleware' => ['permission:view_member_test']], function () {
        Route::get('', 'MemberTestController@index')->name('index');
        Route::get('/create', 'MemberTestController@create')->name('create')->middleware('permission:create_member_test');
        Route::post('/store', 'MemberTestController@store')->name('store')->middleware('permission:create_member_test');
        Route::get('/edit/{id}', 'MemberTestController@edit')->name('edit')->middleware('permission:edit_member_test');
        Route::post('/update/{id}', 'MemberTestController@update')->name('update')->middleware('permission:edit_member_test');
        Route::post('/destroy/{id}', 'MemberTestController@destroy')->name('destroy')->middleware('permission:delete_member_test');
    });

    Route::group(['prefix' => 'question-type-test', 'as' => 'question-type-test.', 'middleware' => ['permission:view_question_type_test']], function () {
        Route::get('', 'QuestionTypeTestController@index')->name('index');
        Route::get('/create', 'QuestionTypeTestController@create')->name('create')->middleware('permission:create_question_type_test');
        Route::post('/store', 'QuestionTypeTestController@store')->name('store')->middleware('permission:create_question_type_test');
        Route::get('/edit/{id}', 'QuestionTypeTestController@edit')->name('edit')->middleware('permission:edit_question_type_test');
        Route::post('/update/{id}', 'QuestionTypeTestController@update')->name('update')->middleware('permission:edit_question_type_test');
        Route::post('/destroy/{id}', 'QuestionTypeTestController@destroy')->name('destroy')->middleware('permission:delete_question_type_test');
    });

    Route::group(['prefix' => 'question-test', 'as' => 'question-test.', 'middleware' => ['permission:view_question_test']], function () {
        Route::get('', 'QuestionTestController@index')->name('index');
        Route::get('/create', 'QuestionTestController@create')->name('create')->middleware('permission:create_question_test');
        Route::post('/store', 'QuestionTestController@store')->name('store')->middleware('permission:create_question_test');
        Route::get('/edit/{id}', 'QuestionTestController@edit')->name('edit')->middleware('permission:edit_question_test');
        Route::post('/update/{id}', 'QuestionTestController@update')->name('update')->middleware('permission:edit_question_test');
        Route::post('/destroy/{id}', 'QuestionTestController@destroy')->name('destroy')->middleware('permission:delete_question_test');
        Route::post('/destroy-item/{id}', 'QuestionTestController@destroyItem')->name('destroyItem')->middleware('permission:delete_question_test');
        Route::post('/change-active-question-test/{id}', 'QuestionTestController@changeActive')->name('changeActive')->middleware('permission:edit_question_test');
    });

    Route::group(['prefix' => 'page', 'as' => 'page.', 'middleware' => ['permission:view_page']], function () {
        Route::get('', 'PageController@index')->name('index');
        Route::get('/create', 'PageController@create')->name('create')->middleware('permission:create_page');
        Route::post('/store', 'PageController@store')->name('store')->middleware('permission:create_page');
        Route::get('/edit/{id}', 'PageController@edit')->name('edit')->middleware('permission:edit_page');
        Route::post('/update/{id}', 'PageController@update')->name('update')->middleware('permission:edit_page');
        Route::post('/destroy/{id}', 'PageController@destroy')->name('destroy')->middleware('permission:delete_page');
        Route::post('/change-active-page/{id}', 'PageController@changeActive')->name('changeActive')->middleware('permission:edit_page');
    });

    Route::group(['prefix' => 'store', 'as' => 'store.', 'middleware' => ['permission:view_store']], function () {
        Route::get('', 'StoreController@index')->name('index');
        Route::get('/create', 'StoreController@create')->name('create')->middleware('permission:create_store');
        Route::post('/store', 'StoreController@store')->name('store')->middleware('permission:create_store');
        Route::get('/edit/{id}', 'StoreController@edit')->name('edit')->middleware('permission:edit_store');
        Route::post('/update/{id}', 'StoreController@update')->name('update')->middleware('permission:edit_store');
        Route::post('/destroy/{id}', 'StoreController@destroy')->name('destroy')->middleware('permission:delete_store');
        Route::post('/change-active-store/{id}', 'StoreController@changeActive')->name('changeActive')->middleware('permission:edit_store');
    });

    Route::group(['prefix' => 'documents', 'as' => 'document.', 'middleware' => ['permission:view_document']], function () {
        Route::get('', 'DocumentController@index')->name('index');
        Route::get('/create', 'DocumentController@create')->name('create')->middleware('permission:create_document');
        Route::post('/store', 'DocumentController@store')->name('store')->middleware('permission:create_document');
        Route::get('/edit/{id}', 'DocumentController@edit')->name('edit')->middleware('permission:edit_document');
        Route::post('/update/{id}', 'DocumentController@update')->name('update')->middleware('permission:edit_document');
        Route::post('/destroy/{id}', 'DocumentController@destroy')->name('destroy')->middleware('permission:delete_document');
        Route::post('/change-active-document/{id}', 'DocumentController@changeActive')->name('changeActive')->middleware('permission:edit_document');
    });

    Route::group(['prefix' => 'document-download', 'as' => 'document-download.', 'middleware' => ['permission:view_document_download']], function () {
        Route::get('', 'DocumentDownloadController@index')->name('index');
    });
});



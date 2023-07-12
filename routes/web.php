<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Exam\ExamController;
use App\Http\Controllers\Fees\FeesController;
use App\Http\Controllers\Quiz\QuizController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Subject\SubjectController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Fees\FeesInvoicesController;
use App\Http\Controllers\Question\QuestionController;
use App\Http\Controllers\Student\AttendanceController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Fees\ReceiptStudentController;
use App\Http\Controllers\Graduated\GraduatedController;
use App\Http\Controllers\Promotion\PromotionController;
use App\Http\Controllers\Student\OnlineClassController;
use App\Http\Controllers\Classrooms\ClassroomController;

Route::get('/', [HomeController::class, 'index'])->name('selection');


Route::get('login/{type}', [LoginController::class, 'loginForm'])->name('login.show');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout/{type}', [LoginController::class, 'logout'])->name('logout');   
Route::group([
    'middleware' =>['auth']
], function () {

    Route::get('/dashborad', [DashboardController::class,'index']);
   
  
    //Route::get('/student/dashboard', [DashboardController::class,'student'])->name('student.dashboard');
    // Route::get('parent_dashboard', [DashboardController::class,'parent']);
    // Route::get('teacher_dashboard', [DashboardController::class,'teacher']);
    Route::resource('/grades', GradeController::class);
    Route::resource('student', StudentController::class);

    Route::prefix("student")->group(function () {
        Route::controller(StudentController::class)->group(function () {
            Route::get('/classes/{id}', 'classrooms');
            Route::get('/sections/{id}', 'sections');
            Route::post('Upload_attachment', 'Upload_attachment')->name('Upload_attachment');
            Route::get('Download_attachment/{studentname}/{filename}', 'Download_attachment')->name('Download_attachment');
            Route::post('Delete_attachment', 'Delete_attachment')->name('Delete_attachment');
        });
    });


    Route::resource('classrooms', ClassroomController::class);
    Route::prefix("classrooms")->group(function () {
        Route::controller(ClassroomController::class)->group(function () {
            Route::post('delete/all', 'delete')->name('deleteAll');
            // Route::get('classes/{id}', 'filter')->name('class.filter');

        });
    });

    Route::resource('section', SectionController::class);
    Route::resource('Promotion', PromotionController::class);
    Route::resource('Teachers', TeacherController::class);
    Route::resource('graduated', GraduatedController::class);
    Route::resource('Fees', FeesController::class);
    Route::resource('Fees_Invoices', FeesInvoicesController::class);
    Route::resource('receipt_students', ReceiptStudentController::class);
    Route::resource('attendance', AttendanceController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('exams', ExamController::class);
    Route::resource('quiz', QuizController::class);
    Route::resource('questions', QuestionController::class);
    Route::get('create/{id}', [QuestionController::class, 'createQuestion'])->name('create.question');
    Route::view('add/parent', 'livewire.form')->name('addParent');
    Route::resource('online_classes', OnlineClassController::class);
    Route::get('zoom/callback', [OnlineClassController::class, 'callback']);
    Route::get('zoom/user', [OnlineClassController::class, 'user']);
    Route::get('auth/zoom', [OnlineClassController::class, 'auth']);
    Route::prefix("offlineClass")->group(function () {
        Route::controller(OnlineClassController::class)->group(function () {
            Route::post('/store', 'indirectStore')->name('indirect.store');
            Route::get('/create', 'indirectCreate')->name('indirect.create');
        });
    });
    Route::resource('settings', SettingController::class);
});

require __DIR__.'/student.php';
require __DIR__.'/parent.php';
require __DIR__.'/teacher.php';
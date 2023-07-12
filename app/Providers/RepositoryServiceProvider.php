<?php

namespace App\Providers;

use App\Repository\Exam\ExamRepository;
use App\Repository\Quiz\QuizRepository;
use Illuminate\Support\ServiceProvider;
use App\Repository\Section\SectionRepository;
use App\Repository\Setting\SettingRepository;
use App\Repository\Student\StudentRepository;
use App\Repository\Subject\SubjectRepository;
use App\Repository\Teacher\TeacherRepository;
use App\Repository\Fees\FeeInvoicesRepository;
use App\Repository\Question\QuestionRepository;
use App\Repository\Exam\ExamRepositoryInterface;
use App\Repository\Quiz\QuizRepositoryInterface;
use App\Repository\Fees\ReceiptStudentRepository;
use App\Repository\Graduated\GraduatedRepository;
use App\Repository\Promotion\PromotionRepository;
use App\Repository\Attendance\AttendanceRepository;
use App\Repository\Section\SectionRepositoryInterface;
use App\Repository\Setting\SettingRepositoryInterface;
use App\Repository\Student\StudentRepositoryInterface;
use App\Repository\Subject\SubjectRepositoryInterface;
use App\Repository\Teacher\TeacherRepositoryInterface;
use App\Repository\Fees\FeeInvoicesRepositoryInterface;
use App\Repository\Question\QuestionRepositoryInterface;
use App\Repository\Fees\ReceiptStudentRepositoryInterface;
use App\Repository\Graduated\GraduatedRepositoryInterface;
use App\Repository\Promotion\PromotionRepositoryInterface;
use App\Repository\Attendance\AttendanceRepositoryInterface;


class RepositoryServiceProvider extends ServiceProvider
{
   
    public function register()
    {
        $this->app->bind(SectionRepositoryInterface::class,SectionRepository::class);
        $this->app->bind(StudentRepositoryInterface::class,StudentRepository::class);
        $this->app->bind(TeacherRepositoryInterface::class,TeacherRepository::class);
        $this->app->bind(PromotionRepositoryInterface::class,PromotionRepository::class);
        $this->app->bind(GraduatedRepositoryInterface::class,GraduatedRepository::class);
        $this->app->bind(FeeInvoicesRepositoryInterface::class,FeeInvoicesRepository::class);
        $this->app->bind(ReceiptStudentRepositoryInterface::class,ReceiptStudentRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class,AttendanceRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class,SubjectRepository::class);
        $this->app->bind(ExamRepositoryInterface::class,ExamRepository::class);
        $this->app->bind(QuizRepositoryInterface::class,QuizRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class,QuestionRepository::class);
        $this->app->bind(SettingRepositoryInterface::class,SettingRepository::class);





        
    
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

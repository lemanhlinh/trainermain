<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Repositories\Contracts\UserInterface', 'App\Repositories\Eloquents\UserRepository');
        $this->app->bind('App\Repositories\Contracts\RoleInterface', 'App\Repositories\Eloquents\RoleRepository');
        $this->app->bind('App\Repositories\Contracts\PermissionInterface', 'App\Repositories\Eloquents\PermissionRepository');
        $this->app->bind('App\Repositories\Contracts\ArticleInterface', 'App\Repositories\Eloquents\ArticleRepository');
        $this->app->bind('App\Repositories\Contracts\SettingInterface', 'App\Repositories\Eloquents\SettingRepository');
        $this->app->bind('App\Repositories\Contracts\MenuCategoryInterface', 'App\Repositories\Eloquents\MenuCategoryRepository');
        $this->app->bind('App\Repositories\Contracts\MenuInterface', 'App\Repositories\Eloquents\MenuRepository');
        $this->app->bind('App\Repositories\Contracts\BannerInterface', 'App\Repositories\Eloquents\BannerRepository');
        $this->app->bind('App\Repositories\Contracts\CourseInterface', 'App\Repositories\Eloquents\CourseRepository');
        $this->app->bind('App\Repositories\Contracts\ProgramInterface', 'App\Repositories\Eloquents\ProgramRepository');
        $this->app->bind('App\Repositories\Contracts\StudentInterface', 'App\Repositories\Eloquents\StudentRepository');
        $this->app->bind('App\Repositories\Contracts\TeacherInterface', 'App\Repositories\Eloquents\TeacherRepository');
        $this->app->bind('App\Repositories\Contracts\WhyDifferentInterface', 'App\Repositories\Eloquents\WhyDifferentRepository');
        $this->app->bind('App\Repositories\Contracts\LessonTestInterface', 'App\Repositories\Eloquents\LessonTestRepository');
        $this->app->bind('App\Repositories\Contracts\MemberTestInterface', 'App\Repositories\Eloquents\MemberTestRepository');
        $this->app->bind('App\Repositories\Contracts\QuestionTypeTestInterface', 'App\Repositories\Eloquents\QuestionTypeTestRepository');
        $this->app->bind('App\Repositories\Contracts\QuestionTestInterface', 'App\Repositories\Eloquents\QuestionTestRepository');
        $this->app->bind('App\Repositories\Contracts\PageInterface', 'App\Repositories\Eloquents\PageRepository');
        $this->app->bind('App\Repositories\Contracts\StoreInterface', 'App\Repositories\Eloquents\StoreRepository');
        $this->app->bind('App\Repositories\Contracts\OrderInterface', 'App\Repositories\Eloquents\OrderRepository');
        $this->app->bind('App\Repositories\Contracts\DocumentInterface', 'App\Repositories\Eloquents\DocumentRepository');
    }
}

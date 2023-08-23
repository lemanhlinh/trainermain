<?php

namespace App\Providers;

use App\Repositories\Contracts\CourseInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\SettingInterface;
use App\Repositories\Contracts\ProgramInterface;
use App\Repositories\Contracts\MenuInterface;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(SettingInterface $settingRepository, MenuInterface $menuRepository, CourseInterface $courseRepository, ProgramInterface $programRepository)
    {
        $menu = null;
        $setting = null;
        $courses = null;
        $program = null;
        if (!Request::is('admin/*')) {
            if (Schema::hasTable('setting')) {
                $setting = $settingRepository->getAll()->pluck('value', 'key');
            }
            if (Schema::hasTable('menu')) {
                $menu = $menuRepository->getMenusByCategoryId(1)->toTree();
            }
            if (Schema::hasTable('course')) {
                $courses = $courseRepository->getList(['active' => 1],['id','title','slug'],0);
            }
            if (Schema::hasTable('programs')) {
                $program = $programRepository->getList(['active' => 1],['id','title','total_day','total_time'],0);
            }
//            View::composer(['web.partials._header', 'web.partials._footer'], function ($view) {
//                $config = Setting::all();
//                $view->with('menus', $config);
//            });
        }
        View::share('setting', $setting);
        View::share('course_all', $courses);
        View::share('program_all', $program);
        View::composer(['web.partials._header', 'web.partials._footer'], function ($view) use ($menu) {
            $view->with('menus', $menu);
        });
    }
}

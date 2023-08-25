<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">@lang('form.final_style')</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item @if (request()->is('admin/users*') || request()->is('admin/role*')) menu-open @endif">
                    <a href="#" class="nav-link @if (request()->is('admin/users*') || request()->is('admin/role*')) active @endif">
                        <i class="fas fa-user"></i>
                        <p>
                            @lang('form.user.title')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link @if (request()->is('admin/users*')) active @endif">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    @lang('form.user.')
                                </p>
                            </a>
                        </li>
                        @can('view_role')
                            <li class="nav-item">
                                <a href="{{ route('admin.roles.index') }}" class="nav-link @if (request()->is('admin/role*')) active @endif">
                                    <i class="nav-icon far fa-plus-square" aria-hidden="true"></i>
                                    <p>
                                        @lang('form.roles.')
                                    </p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @can('view_menu')
                    <li class="nav-item @if (request()->is('admin/menu*')) menu-open @endif">
                        <a href="#" class="nav-link @if (request()->is('admin/menu*')) active @endif">
                            <i class="fab fa-mendeley"></i>
                            <p>
                                @lang('form.menu.')
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.menu-category.index') }}" class="nav-link @if (request()->is('admin/menu-category')) active @endif">
                                    <i class="nav-icon fas fa-layer-group"></i>
                                    <p>
                                        @lang('form.menu_category.')
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.menu.index') }}" class="nav-link @if (request()->is('admin/menu')) active @endif">
                                    <i class="nav-icon fab fa-mendeley"></i>
                                    <p>
                                        @lang('form.menu.')
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('view_page')
                    <li class="nav-item @if (request()->is('admin/page*')) menu-open @endif">
                        <a href="{{ route('admin.page.index') }}" class="nav-link @if (request()->is('admin/page*')) active @endif">
                            <i class="fas fa-sticky-note"></i>
                            <p>
                                @lang('form.page.')
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view_article')
                    <li class="nav-item @if (request()->is('admin/article*')) menu-open @endif">
                        <a href="{{ route('admin.article.index') }}" class="nav-link @if (request()->is('admin/article*')) active @endif">
                            <i class="fas fa-newspaper"></i>
                            <p>
                                @lang('form.article.')
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item @if (request()->is('admin/document*')) menu-open @endif">
                    <a href="#" class="nav-link @if (request()->is('admin/document*')) active @endif">
                        <i class="fas fa-book"></i>
                        <p>
                            @lang('form.document.')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('view_document')
                            <li class="nav-item">
                                <a href="{{ route('admin.document.index') }}" class="nav-link @if (request()->is('admin/documents')) active @endif">
                                    <i class="fas fa-file-alt"></i>
                                    <p>
                                        @lang('form.document.')
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can('view_document_download')
                            <li class="nav-item">
                                <a href="{{ route('admin.document-download.index') }}" class="nav-link @if (request()->is('admin/document-download')) active @endif">
                                    <i class="fas fa-address-book"></i>
                                    <p>
                                        @lang('form.document_download.')
                                    </p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @can('view_course')
                    <li class="nav-item @if (request()->is('admin/course*')) menu-open @endif">
                        <a href="{{ route('admin.course.index') }}" class="nav-link @if (request()->is('admin/course*')) active @endif">
                            <i class="fas fa-graduation-cap"></i>
                            <p>
                                @lang('form.course.')
                            </p>
                        </a>
                    </li>
                @endcan
                @can(['view_setting'])
                    <li class="nav-item">
                        <a href="{{ route('admin.setting.index') }}" class="nav-link @if (request()->is('admin/setting*')) active @endif">
                            <i class="fas fa-cog"></i>
                            <p>
                                @lang('form.setting.')
                            </p>
                        </a>
                    </li>
                @endcan
                @can(['view_contact'])
                    <li class="nav-item">
                        <a href="{{ route('admin.contact.index') }}" class="nav-link @if (request()->is('admin/contact')) active @endif">
                            <i class="far fa-id-card"></i>
                            <p>
                                @lang('form.contact.')
                            </p>
                        </a>
                    </li>
                @endcan
                @can(['view_advisory'])
                    <li class="nav-item">
                        <a href="{{ route('admin.advisory.index') }}" class="nav-link @if (request()->is('admin/advisory')) active @endif">
                            <i class="fas fa-info-circle"></i>
                            <p>
                                @lang('form.advisory.')
                            </p>
                        </a>
                    </li>
                @endcan

                @can(['view_order'])
                    <li class="nav-item">
                        <a href="{{ route('admin.order.index') }}" class="nav-link @if (request()->is('admin/order*')) active @endif">
                            <i class="fas fa-scroll"></i>
                            <p>
                                @lang('form.order.')
                            </p>
                        </a>
                    </li>
                @endcan
                @can(['view_student'])
                    <li class="nav-item">
                        <a href="{{ route('admin.student.index') }}" class="nav-link @if (request()->is('admin/student*')) active @endif">
                            <i class="fas fa-user-graduate"></i>
                            <p>
                                @lang('form.student.')
                            </p>
                        </a>
                    </li>
                @endcan
                @can(['view_teacher'])
                    <li class="nav-item">
                        <a href="{{ route('admin.teacher.index') }}" class="nav-link @if (request()->is('admin/teacher*')) active @endif">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <p>
                                @lang('form.teacher.')
                            </p>
                        </a>
                    </li>
                @endcan
                @can(['view_banner'])
                    <li class="nav-item">
                        <a href="{{ route('admin.banner.index') }}" class="nav-link @if (request()->is('admin/banner*')) active @endif">
                            <i class="fas fa-image"></i>
                            <p>
                                @lang('form.banner.')
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view_program')
                    <li class="nav-item @if (request()->is('admin/program*')) menu-open @endif">
                        <a href="{{ route('admin.program.index') }}" class="nav-link @if (request()->is('admin/program*')) active @endif">
                            <i class="fas fa-road"></i>
                            <p>
                                @lang('form.program.')
                            </p>
                        </a>
                    </li>
                @endcan
                @can(['view_why_different'])
                    <li class="nav-item">
                        <a href="{{ route('admin.why-different.index') }}" class="nav-link @if (request()->is('admin/why-different*')) active @endif">
                            <i class="fas fa-exchange-alt"></i>
                            <p>
                                @lang('form.why_different.')
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item @if (request()->is('admin/*-test*')) menu-open @endif">
                    <a href="#" class="nav-link @if (request()->is('admin/*-test*')) active @endif">
                        <i class="fas fa-spell-check"></i>
                        <p>
                            @lang('form.test.')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can(['view_member_test'])
                            <li class="nav-item">
                                <a href="{{ route('admin.member-test.index') }}" class="nav-link @if (request()->is('admin/member-test*')) active @endif">
                                    <i class="fas fa-registered"></i>
                                    <p>
                                        @lang('form.member_test.')
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can(['view_lesson_test'])
                            <li class="nav-item">
                                <a href="{{ route('admin.lesson-test.index') }}" class="nav-link @if (request()->is('admin/lesson-test*')) active @endif">
                                    <i class="fas fa-layer-group"></i>
                                    <p>
                                        @lang('form.lesson_test.')
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can(['view_question_type_test'])
                            <li class="nav-item d-none">
                                <a href="{{ route('admin.question-type-test.index') }}" class="nav-link @if (request()->is('admin/question-type-test*')) active @endif">
                                    <i class="fas fa-exchange-alt"></i>
                                    <p>
                                        @lang('form.question_type_test.')
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can(['view_question_test'])
                            <li class="nav-item">
                                <a href="{{ route('admin.question-test.index') }}" class="nav-link @if (request()->is('admin/question-test*')) active @endif">
                                    <i class="fas fa-question"></i>
                                    <p>
                                        @lang('form.question_test.')
                                    </p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @can(['view_store'])
                    <li class="nav-item">
                        <a href="{{ route('admin.store.index') }}" class="nav-link @if (request()->is('admin/store*')) active @endif">
                            <i class="fas fa-store"></i>
                            <p>
                                @lang('form.store.')
                            </p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

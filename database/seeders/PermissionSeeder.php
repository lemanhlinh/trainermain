<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models as Database;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = static::getDefaultPermission();

        foreach($permissions as $permission ) {
            Permission::updateOrCreate($permission);
        }

        $allPermissionNames = Database\Permission::pluck('name')->toArray();

        $roleAdmin = Database\Role::updateOrCreate([
            'name' => 'admin',
            'display_name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $roleAdmin->givePermissionTo($allPermissionNames);

        $user = Database\User::find(1);

        if ($user) {
            $user->assignRole($roleAdmin);
        }
    }

    public static function getDefaultPermission()
    {
        return [
            ['name' => 'view_user', 'display_name' => 'Xem danh sách người dùng', 'guard_name' => 'web'],
            ['name' => 'create_user', 'display_name' => 'Thêm mới người dùng', 'guard_name' => 'web'],
            ['name' => 'edit_user', 'display_name' => 'Sửa thông tin người dùng', 'guard_name' => 'web'],
            ['name' => 'delete_user', 'display_name' => 'Xóa người dùng', 'guard_name' => 'web'],

            ['name' => 'view_role', 'display_name' => 'Xem danh sách phân quyền', 'guard_name' => 'web'],
            ['name' => 'create_role', 'display_name' => 'Thêm mới phân quyền', 'guard_name' => 'web'],
            ['name' => 'edit_role', 'display_name' => 'Sửa thông tin phân quyền', 'guard_name' => 'web'],
            ['name' => 'delete_role', 'display_name' => 'Xóa phân quyền', 'guard_name' => 'web'],

            ['name' => 'view_menu_categories', 'display_name' => 'Xem danh sách nhóm menu', 'guard_name' => 'web'],
            ['name' => 'create_menu_categories', 'display_name' => 'Thêm mới nhóm menu', 'guard_name' => 'web'],
            ['name' => 'edit_menu_categories', 'display_name' => 'Sửa nhóm menu', 'guard_name' => 'web'],
            ['name' => 'delete_menu_categories', 'display_name' => 'Xóa nhóm menu', 'guard_name' => 'web'],

            ['name' => 'view_menu', 'display_name' => 'Xem danh sách menu', 'guard_name' => 'web'],
            ['name' => 'create_menu', 'display_name' => 'Thêm mới menu', 'guard_name' => 'web'],
            ['name' => 'edit_menu', 'display_name' => 'Sửa menu', 'guard_name' => 'web'],
            ['name' => 'delete_menu', 'display_name' => 'Xóa menu', 'guard_name' => 'web'],

            ['name' => 'view_setting', 'display_name' => 'Xem danh sách cài đặt', 'guard_name' => 'web'],
            ['name' => 'create_setting', 'display_name' => 'Thêm mới cài đặt', 'guard_name' => 'web'],
            ['name' => 'edit_setting', 'display_name' => 'Sửa cài đặt', 'guard_name' => 'web'],
            ['name' => 'delete_setting', 'display_name' => 'Xóa cài đặt', 'guard_name' => 'web'],

            ['name' => 'view_article', 'display_name' => 'Xem danh sách tin tức', 'guard_name' => 'web'],
            ['name' => 'create_article', 'display_name' => 'Thêm mới tin tức', 'guard_name' => 'web'],
            ['name' => 'edit_article', 'display_name' => 'Sửa tin tức', 'guard_name' => 'web'],
            ['name' => 'delete_article', 'display_name' => 'Xóa tin tức', 'guard_name' => 'web'],

            ['name' => 'view_contact', 'display_name' => 'Xem danh sách liên hệ', 'guard_name' => 'web'],

            ['name' => 'view_course', 'display_name' => 'Xem danh sách khóa học', 'guard_name' => 'web'],
            ['name' => 'create_course', 'display_name' => 'Thêm mới khóa học', 'guard_name' => 'web'],
            ['name' => 'edit_course', 'display_name' => 'Sửa khóa học', 'guard_name' => 'web'],
            ['name' => 'delete_course', 'display_name' => 'Xóa khóa học', 'guard_name' => 'web'],

            ['name' => 'view_student', 'display_name' => 'Xem danh sách Học viên', 'guard_name' => 'web'],
            ['name' => 'create_student', 'display_name' => 'Thêm mới Học viên', 'guard_name' => 'web'],
            ['name' => 'edit_student', 'display_name' => 'Sửa Học viên', 'guard_name' => 'web'],
            ['name' => 'delete_student', 'display_name' => 'Xóa Học viên', 'guard_name' => 'web'],

            ['name' => 'view_teacher', 'display_name' => 'Xem danh sách Giáo viên', 'guard_name' => 'web'],
            ['name' => 'create_teacher', 'display_name' => 'Thêm mới Giáo viên', 'guard_name' => 'web'],
            ['name' => 'edit_teacher', 'display_name' => 'Sửa Giáo viên', 'guard_name' => 'web'],
            ['name' => 'delete_teacher', 'display_name' => 'Xóa Giáo viên', 'guard_name' => 'web'],

            ['name' => 'view_order', 'display_name' => 'Xem danh sách mua khóa học', 'guard_name' => 'web'],

            ['name' => 'view_advisory', 'display_name' => 'Xem danh sách liên hệ tư vấn', 'guard_name' => 'web'],

            ['name' => 'view_program', 'display_name' => 'Xem danh sách chương trình học', 'guard_name' => 'web'],
            ['name' => 'create_program', 'display_name' => 'Thêm mới chương trình học', 'guard_name' => 'web'],
            ['name' => 'edit_program', 'display_name' => 'Sửa chương trình học', 'guard_name' => 'web'],
            ['name' => 'delete_program', 'display_name' => 'Xóa chương trình học', 'guard_name' => 'web'],

            ['name' => 'view_banner', 'display_name' => 'Xem danh sách Banner', 'guard_name' => 'web'],
            ['name' => 'create_banner', 'display_name' => 'Thêm mới Banner', 'guard_name' => 'web'],
            ['name' => 'edit_banner', 'display_name' => 'Sửa Banner', 'guard_name' => 'web'],
            ['name' => 'delete_banner', 'display_name' => 'Xóa Banner', 'guard_name' => 'web'],

            ['name' => 'view_why_different', 'display_name' => 'Xem danh sách Sự khác biệt', 'guard_name' => 'web'],
            ['name' => 'create_why_different', 'display_name' => 'Thêm mới Sự khác biệt', 'guard_name' => 'web'],
            ['name' => 'edit_why_different', 'display_name' => 'Sửa Sự khác biệt', 'guard_name' => 'web'],
            ['name' => 'delete_why_different', 'display_name' => 'Xóa Sự khác biệt', 'guard_name' => 'web'],

            ['name' => 'view_lesson_test', 'display_name' => 'Xem danh sách bài thi', 'guard_name' => 'web'],
            ['name' => 'create_lesson_test', 'display_name' => 'Thêm mới bài thi', 'guard_name' => 'web'],
            ['name' => 'edit_lesson_test', 'display_name' => 'Sửa bài thi', 'guard_name' => 'web'],
            ['name' => 'delete_lesson_test', 'display_name' => 'Xóa bài thi', 'guard_name' => 'web'],

            ['name' => 'view_member_test', 'display_name' => 'Xem danh sách đăng ký test', 'guard_name' => 'web'],
            ['name' => 'create_member_test', 'display_name' => 'Thêm mới đăng ký test', 'guard_name' => 'web'],
            ['name' => 'edit_member_test', 'display_name' => 'Sửa đăng ký test', 'guard_name' => 'web'],
            ['name' => 'delete_member_test', 'display_name' => 'Xóa đăng ký test', 'guard_name' => 'web'],

            ['name' => 'view_question_type_test', 'display_name' => 'Xem danh sách loại câu hỏi', 'guard_name' => 'web'],
            ['name' => 'create_question_type_test', 'display_name' => 'Thêm mới loại câu hỏi', 'guard_name' => 'web'],
            ['name' => 'edit_question_type_test', 'display_name' => 'Sửa loại câu hỏi', 'guard_name' => 'web'],
            ['name' => 'delete_question_type_test', 'display_name' => 'Xóa loại câu hỏi', 'guard_name' => 'web'],

            ['name' => 'view_question_test', 'display_name' => 'Xem danh sách câu hỏi', 'guard_name' => 'web'],
            ['name' => 'create_question_test', 'display_name' => 'Thêm mới câu hỏi', 'guard_name' => 'web'],
            ['name' => 'edit_question_test', 'display_name' => 'Sửa câu hỏi', 'guard_name' => 'web'],
            ['name' => 'delete_question_test', 'display_name' => 'Xóa câu hỏi', 'guard_name' => 'web'],

            ['name' => 'view_page', 'display_name' => 'Xem danh sách trang tĩnh', 'guard_name' => 'web'],
            ['name' => 'create_page', 'display_name' => 'Thêm mới trang tĩnh', 'guard_name' => 'web'],
            ['name' => 'edit_page', 'display_name' => 'Sửa trang tĩnh', 'guard_name' => 'web'],
            ['name' => 'delete_page', 'display_name' => 'Xóa trang tĩnh', 'guard_name' => 'web'],

            ['name' => 'view_store', 'display_name' => 'Xem danh sách trung tâm', 'guard_name' => 'web'],
            ['name' => 'create_store', 'display_name' => 'Thêm mới trung tâm', 'guard_name' => 'web'],
            ['name' => 'edit_store', 'display_name' => 'Sửa trung tâm', 'guard_name' => 'web'],
            ['name' => 'delete_store', 'display_name' => 'Xóa trung tâm', 'guard_name' => 'web'],

            ['name' => 'view_document', 'display_name' => 'Xem danh sách tài liệu', 'guard_name' => 'web'],
            ['name' => 'create_document', 'display_name' => 'Thêm mới tài liệu', 'guard_name' => 'web'],
            ['name' => 'edit_document', 'display_name' => 'Sửa tài liệu', 'guard_name' => 'web'],
            ['name' => 'delete_document', 'display_name' => 'Xóa tài liệu', 'guard_name' => 'web'],
        ];
    }
}

<?php

namespace App\Models;


class Role extends \Spatie\Permission\Models\Role
{
    protected $fillable = ['name', 'display_name', 'guard_name'];
}

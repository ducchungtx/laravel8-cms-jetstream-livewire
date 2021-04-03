<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;
    protected $fillable = ['role', 'route_name'];

    /**
     * The list of routes when authenticated
     * @return string[]
     */
    public static function routeNameList() {
        return [
            'pages',
            'navigation-menus',
            'users',
            'user-permissions'
        ];
    }
}

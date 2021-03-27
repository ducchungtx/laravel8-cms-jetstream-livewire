<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    /**
     * Nếu như $fillable dùng để lưu danh sách các thuộc tính "được phép" (white list) mass-assign,
     * bạn có thể sử dụng $guarded để lưu các thuộc tính mà không được phép mass-assign.
     * Các thuộc tính khác không lưu trong $guarded sẽ được mass-assign.
     * Vì thế, $guarded được coi như là một "black list".
     * Bạn có thể sử dụng một trong hai, hoặc $fillable hoặc $guarded, chứ không được dùng cả hai cùng một lúc
     **/
    protected $guarded = [];

}

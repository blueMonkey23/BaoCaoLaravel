<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Cho phép nhập các cột này từ API
    protected $fillable = ['title', 'description', 'status', 'progress_percent'];
}
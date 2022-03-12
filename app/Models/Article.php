<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'subtitle',
        'catergory',
        'status',
        'thumbnail',
        'byuserid',
        'content',
        'date',
        'authorizedbyid',
        'authorizeddate',
    ];


    protected $hidden = [
        'status',
        'authorizedbyid',
        'authorizeddate',
    ];







}

<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    use HasFactory;
    protected $table = 'page';
     public $timestamps = false;
    // protected $dates = [
    //     'create_at',
    //     'update_at',
    // ];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // public $timestamps = true;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classifications extends Model
{
    use HasFactory;

    protected $table = 'classifications';
    public $timestamps = false;

    protected $fillable = [
        'e_id','doc_id','paragraph_num'
    ];
}

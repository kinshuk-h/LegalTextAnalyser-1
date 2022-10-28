<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paragraphs extends Model
{
    use HasFactory;

    protected $fillable = [
        'content','page','paragraph_num','doc_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassifiedLabels extends Model
{
    use HasFactory;

    protected $table = 'classified_labels';

    protected $fillable = [
        'e_id','doc_id','paragraph_num','label_num'
    ];
}

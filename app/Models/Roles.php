<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $table = 'roles';

    public const SUPER_ADMIN = 'SuperAdmin';
    public const ADMIN = 'Admin';
    public const ANNOTATOR = 'Annotator';
}

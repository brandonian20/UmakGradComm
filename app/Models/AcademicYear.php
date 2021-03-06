<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "academicyear";
    protected $primaryKey = "acadYrID";
    protected $fillable = ["year", "theme", "updatedBy", "updatedAt"];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "program";
    protected $primaryKey = "programID";
    protected $fillable = ["programName", "collegeID", "updatedBy", "updatedAt"];

}

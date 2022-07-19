<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduates extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "graduates";
    protected $primaryKey = "studentID";
    protected $fillable = ["studentID", "entID", "semID", "updatedBy", "updatedAt"];

}

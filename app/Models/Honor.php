<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Honor extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "honor";
    protected $primaryKey = "honorID";
    protected $fillable = ["honorName", "updatedBy", "updatedAt"];

}

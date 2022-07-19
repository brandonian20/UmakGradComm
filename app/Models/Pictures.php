<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pictures extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "pictures";
    protected $primaryKey = "pictureID";
    protected $fillable = ["pictureFile", "fileFormat"];

}

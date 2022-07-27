<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnSitePics extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "onsitepics";
    protected $primaryKey = "siteID";
    protected $fillable = ["siteID", "image", "title", "subtitle", "acadYrID", "updatedBy", "updatedAt"];

}

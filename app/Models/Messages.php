<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "messages";
    protected $primaryKey = "messageID";
    protected $fillable = ["messageID", "header", "body", "name", "image", "updatedBy", "updatedAt"];

}

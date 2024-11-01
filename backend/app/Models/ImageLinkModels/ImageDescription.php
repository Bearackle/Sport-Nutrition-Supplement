<?php

namespace App\Models\ImageLinkModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageDescription extends Model
{
    use HasFactory;
    protected $table= "image_description";
    protected $fillable = ['image_url', 'public_id'];
    const UPDATED_AT = null;
    const CREATED_AT = 'created_at';
}

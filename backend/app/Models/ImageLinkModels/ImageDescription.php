<?php

namespace App\Models\ImageLinkModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageDescription extends Model
{
    use HasFactory;
    protected $table= "image_descriptions";
    protected $fillable = ['image_url', 'public_id'];
    protected $primaryKey = 'image_id';
    const UPDATED_AT = null;
    const CREATED_AT = 'created_at';
}

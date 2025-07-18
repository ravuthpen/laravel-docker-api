<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageCrud extends Model
{
    use HasFactory;

    protected $table = 'image_profile';
    protected $fillable = [
        'user_id',
        'image'
    ];

    public $appends = [
        'image_url'
    ];

    public function getImageUrlAttribute()
    {
        //return assert("/storage/app/public/.$this->image");
        return url(\Storage::url("app/public/{$this->image}"));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'product_images';

    protected $fillable = [
        'image_name','product_id'
    ];
    /* public function setFilenamesAttribute($value)
    {
        $this->attributes['filenames'] = json_encode($value);
    } */
}

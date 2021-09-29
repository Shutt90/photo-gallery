<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file_path',
        'category_id',
    ];

    public function categoryRelation()
    {

        return $this->belongsTo(Category::class);

    }
}

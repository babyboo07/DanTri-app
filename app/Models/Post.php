<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'title',
        'shortContent',
        'content',
        'thumbnail',
        'status',
        'author_id',
        'created_date',
        'approved_id',
        'cate_id',
        'approved_date',
        'cate_id',
    ];


    public function category()
    {
        return $this->hasMany(CategoryPost::class);
    }

    public function parentCate()
    {
        $parent = Category::find('id');
        return $parent;
    }

    public function comment()
    {
        return $this->morphToMany(Comment::class, "comments");
    }

    public $sortable = [
        'status',
        'created_date',
        'approved_date',
    ];
}

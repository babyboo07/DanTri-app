<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'cateName',
        'parent_id',
        'status'
    ];

    public function parent()
    {
        $parent = Category::where('id', $this->id);
        return $parent;
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getHotPost()
    {
        $post = Post::where('cate_id', $this->id)->where('status', 2)->where('hot', 1)->orderBy('created_date', 'desc')->first();
        return $post;
    }

    public function getChildrenCateId()
    {
        $childIds = $this->children()->pluck('id')->toArray();
        return $childIds;
    }

    public function getPostLeft(int $numOfPost = 6)
    {
        $categoryIds = $this->getChildrenCateId();
        $categoryIds[] = $this->id;
        $conditions = [
            ['p.status', 2],
            ['p.hot', null],
        ];
        $articles = DB::table('posts as p')
            ->where($conditions)
            ->whereIn('p.cate_id', $categoryIds)
            ->orderBy('p.created_date', 'desc')->take($numOfPost)
            ->get();
        return $articles;
    }

    public function getHotArticleBySubCate()
    {
        $subCategoryID = $this->id;
        $post = Post::where('cate_id', $subCategoryID)->where('status', 2)->where('hot', 1)->orderBy('created_date', 'desc')->first();
        return $post;
    }

    public function articleOfSubCategory(int $numOfCol = 3)
    {
        $subCategoryID = $this->id;

        $articles = DB::table('posts')
            ->where('cate_id', $subCategoryID)
            ->where('status', 2)
            ->where('hot', null)
            ->orderBy('created_date', 'desc')->take($numOfCol)
            ->get();
        return $articles;
    }

    public function articleByFirstSubCategoryHot(int $numOfFirstCategory = 3)
    {
        $subCategoryID = $this->id;

        $article = Post::where('cate_id', $subCategoryID)
            ->where('status', 2)
            ->where('hot', 1)
            ->orderBy('created_date', 'desc')->take($numOfFirstCategory)->get();
        return $article;
    }

    public function articleByFirstSubCategory(int $numOfFirstCategory = 3)
    {
        $subCategoryID = $this->id;

        $articleList = Post::where('cate_id', $subCategoryID)
            ->where('status', 2)
            ->where('hot', null)
            ->orderBy('created_date', 'desc')->take($numOfFirstCategory)->get();
        return $articleList;
    }

    public $sortable = [
        'id',
        'status'
    ];
}

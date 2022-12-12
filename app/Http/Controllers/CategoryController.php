<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where("parent_id", null)->sortable()->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'cateName' => ['required'],
        ]);

        $cate = new Category();
        $cate->cateName = $request->cateName;
        $cate->position = $request->position;
        $cate->parent_id = $request->parent_id;
        $cate->status = $request->status;
        $cate->save();

        if ($request->subCate) {
            $subCate = $request->subCate;
            foreach ($subCate as $item) {
                $child = Category::find($item);
                $child->parent_id = $cate->id;
                $child->save();
            }
        }

        return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate = Category::findOrFail($id);
        $categories = Category::where("parent_id", null)->get();
        return view('admin.category.edit', compact('cate', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $cate = Category::findOrFail($id);
        $cate->cateName = $request->cateName;
        $cate->position = $request->position;
        $cate->status = $request->status;
        $cate->save();

        //remove all children 
        DB::table('categories')->where('parent_id', $cate->id)->update([
            'parent_id' => null
        ]);
        if ($request->parent_id) {
            $newChilds = array_map('intval', $request->get('parent_id'));
            DB::table('categories')->whereIn('id', $newChilds)->update([
                'parent_id' => $cate->id
            ]);
        }


        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }

    public function updateStatus($id, Request $request)
    {
        $cate = Category::find($id);
        $childs = Category::where("parent_id", $id)->get();

        foreach ($childs as $child) {
            $child->parent_id = null;
            $child->status = 2;
            $child->save();
        }
        $cate->status = $request->status;
        $cate->save();
        return redirect('/category');
    }

    public function newsbyCate($id)
    {
        $hotcate = Category::where("parent_id", null)->where('position', 2)->get();

        return response()->json($hotcate);
    }
}

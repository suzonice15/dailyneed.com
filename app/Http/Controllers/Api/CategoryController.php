<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
 use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $data['category']=DB::table('category')->orderBy('category_id','desc')->paginate(5);

       return new CategoryCollection(Category::orderBy('category_id','desc')->paginate(10));

    }
    public function allCategoryList()
    {
         $data['category']=DB::table('categories')->select('category_title','category_id')->orderBy('category_id','desc')->get();

       
        return  response()->json($data);

    }

    public function search($field,$query)
    {
        return new CategoryCollection(DB::table('categories')->where($field,'LIKE',"%$query%")->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $this->validate($request,[
            'category_title' => 'required',
            'category_name' => 'required|unique:categories',
            'parent_id' => 'numeric',
            'rank_order' => 'required'
        ]);

        $category = new Category();
        $category->category_title = $request->category_title;
        $category->category_name = $request->category_name;
        $category->parent_id = $request->parent_id;
        $category->rank_order = $request->rank_order;
        $category->seo_title = $request->seo_title;
        $category->seo_keywords = $request->seo_keywords;
        $category->seo_description = $request->seo_description;
        $category->registered_date = date("Y-m-d",strtotime($request->registered_date));
        $category->save();
       return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CategoryResource(Category::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category_id)
    {
        $this->validate($request,[
            'category_title' => 'required',

            'parent_id' => 'numeric',
            'rank_order' => 'required'
        ]);

        $category = Category::findOrfail($category_id);

        $category->category_title = $request->category_title;
        $category->category_name = $request->category_name;
        $category->parent_id = $request->parent_id;
        $category->rank_order = $request->rank_order;
        $category->seo_title = $request->seo_title;
        $category->seo_keywords = $request->seo_keywords;
        $category->seo_description = $request->seo_description;
        $category->registered_date = date("Y-m-d",strtotime($request->registered_date));
        $category->save();
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        $category->delete();
        return new CategoryResource($category);
    }

}

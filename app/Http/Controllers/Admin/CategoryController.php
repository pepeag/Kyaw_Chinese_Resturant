<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function category()
    {
        // $data = Category::select('categories.*', DB::raw('COUNT(pizzas.category_id) as count'))
        //     ->leftJoin('pizzas', 'pizzas.category_id', 'categories.category_id')
        //     ->groupBy('categories.category_id')
        //     ->paginate(5);
        $data = Category::paginate(5);

        return view('admin.category.list')->with(['category' => $data]);
    }
    public function addCategory()
    {

        return view('admin.category.add');
    }
    public function createCategory(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = [
            'category_name' => $request->name
        ];
        Category::create($data);
        return redirect()->route('admin#category')->with(['categorySuccess' => 'Category Created Successfully']);
    }
    public function deleteCategory($id)
    {
        Category::where('category_id', $id)->delete();

        return back()->with(['categoryDelete' => 'Category Deleted Successfully']);
    }
    public  function editCategory($id)
    {
        $data = Category::where('category_id', $id)->first();
        return view('admin.category.update')->with(['category' => $data]);
    }
    public function updateCategory(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = [
            'category_name' => $request->name
        ];
        Category::where('category_id',$id)->update($data);
        return redirect()->route('admin#category')->with(['categoryUpdate'=>'Category Updated Successfully']);
    }
}

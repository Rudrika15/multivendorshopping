<?php

namespace App\Http\Controllers\Web\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::paginate(10);
        return view('Vendor.categories.index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        // return view('Vendor.categories.index', compact('categories'));
    }
    public function create()
    {
        return view('Vendor.categories.create');
    }
    public function store(Request $request)
    {
        // Validate the request
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'detail' => 'required|string',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->messages()], 422);
        // }

        // Create a new category
        $category = new Category();
        $category->userId = auth()->user()->id;
        $category->categoryName = $request->input('name');
        $category->categoryicon = $request->input('detail');
        $category->save();

        return response()->json(['status' => 201, 'success' => 'Category added successfully!']);
    }
}

<?php

namespace App\Http\Controllers\Web\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        if (request()->ajax()) {
            // Fetch the categories data
            $categories = Category::where('userId', Auth::user()->id)->get();

            // Return the data in the DataTables format
            return DataTables::of($categories)
                ->addIndexColumn() // Add an index column if needed
                ->addColumn('action', function ($row) {
                    // Modify the edit button to include the row's ID in the route
                    $btn = '<a href="' . route("category.edit", $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm" data-table="#categoryTable" data-url="' . route("category.destroy", ':id') . '">Delete</a>';
                    return $btn;
                })

                ->rawColumns(['action']) // If using HTML in columns like 'action', mark them raw
                ->make(true);
        }

        // For non-ajax requests, return the view
        return view('Vendor.categories.index');
    }
    public function create()
    {
        $categories = Category::all();
        return view('Vendor.categories.create', compact('categories'));
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
        $category->userId = Auth::user()->id;
        $category->categoryName = $request->input('name');

        if ($request->parentId == "on") {
            $category->parentId = $request->parentCategory;
        } else {
            $category->parentId = "0";
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('categories'), $filename);
            $category->categoryIcon = $filename;
        }
        $category->save();
        return response()->json(['status' => 201, 'success' => 'Category Added Successfully!']);
    }


    public function edit($id)
    {
        $categories = Category::where('userId', Auth::user()->id)->get();
        $category = Category::find($id);
        return view('Vendor.categories.edit', compact('category','categories'));
    }

    public function update(Request $request)
   {
        $id  =$request->categoryId;
       $category = Category::find($id);
       $category->categoryName = $request->categoryName;
       if ($request->parentId == "on") {
        $category->parentId = $request->parentCategory;
    } else {
        $category->parentId = "0";
    }
       if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('categories'), $filename);
        $category->categoryIcon = $filename;
    }
       $category->save();
       return response()->json(['status' => 201, 'success' => 'Category Updated Successfully!']);

   }
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('category.index')
            ->with('success', 'Category Deleted Successfully');
    }
}

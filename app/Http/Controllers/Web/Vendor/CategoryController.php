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
    //
    public function index()
    {
        if (request()->ajax()) {
            // Fetch the categories data
            $categories = Category::all();

            // Return the data in the DataTables format
            return DataTables::of($categories)
                ->addIndexColumn() // Add an index column if needed
                ->addColumn('action', function ($row) {
                    // Define action buttons (edit, delete, etc.)
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
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
        $category->userId = Auth::user()->id;
        $category->categoryName = $request->input('name');
        $category->categoryicon = $request->input('detail');
        $category->save();

        return response()->json(['status' => 201, 'success' => 'Category added successfully!']);
    }
}

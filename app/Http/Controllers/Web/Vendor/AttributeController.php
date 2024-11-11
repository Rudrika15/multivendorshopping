<?php

namespace App\Http\Controllers\Web\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AttributeController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            // Fetch the categories data
            $attributes = Attribute::with('category')->get();

            // Return the data in the DataTables format
            return DataTables::of($attributes)
                ->addIndexColumn() // Add an index column if needed
                ->addColumn('action', function ($row) {
                    // Define action buttons (edit, delete, etc.)
                    $btn = '<a href="' . route("attribute.edit", $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm" data-table="#attributeTable" data-url="' . route("attribute.destroy", ':id') . '" >Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action']) // If using HTML in columns like 'action', mark them raw
                ->make(true);
        }

        // For non-ajax requests, return the view
        return view('Vendor.attributes.index');
    }
    public function create()
    {
        $categories = Category::where('userId', Auth::user()->id)->get();
        return view('Vendor.attributes.create', compact('categories'));
    }
    public function store(Request $request)
    {

         // // Validation
        // $validated = $request->validate([
        //     'name' => 'required',
        //      'categoryId' => 'required',
        // ]);
        $attribute = new  Attribute();
        $attribute->name = $request->name;
        $attribute->categoryId = $request->catId;

        $attribute->save();
        return response()->json(['success' => 'Attribute Created Successfully.']);
    }

    public function edit($id)
    {
        $categories = Category::all();
        $attribute = Attribute::find($id);
        return view('Vendor.attributes.edit', compact('attribute','categories'));
    }

    public function update(Request $request)
   {
        $id  =$request->attributeId;
       $attribute = Attribute::find($id);
       $attribute->name = $request->name;
       $attribute->categoryId = $request->catId;
       $attribute->save();
       return response()->json(['status' => 201, 'success' => 'Attribute Updated Successfully!']);

   }
    public function destroy($id)
    {
        $attribute = Attribute::find($id);
        $attribute->delete();

        return redirect()->route('attribute.index')
            ->with('success', 'Attribute Deleted Successfully');
    }
}

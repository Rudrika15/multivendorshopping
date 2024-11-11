<?php

namespace App\Http\Controllers\Web\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class AttributeValueController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            // Fetch the categories data
            $attributeValues = AttributeValue::with('attribute')->get();

            // Return the data in the DataTables format
            return DataTables::of($attributeValues)
                ->addIndexColumn() // Add an index column if needed
                ->addColumn('action', function ($row) {
                    // Define action buttons (edit, delete, etc.)
                    $btn = '<a href="' . route("attributeValue.edit", $row->id) . '"  class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm" data-table="#attributeValueTable" data-url="' . route("attributeValue.destroy", ':id') . '" >Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action']) // If using HTML in columns like 'action', mark them raw
                ->make(true);
        }

        // For non-ajax requests, return the view
        return view('Vendor.attributeValues.index');
    }
    public function create()
    {
        $attributes = Attribute::all();
        return view('Vendor.attributeValues.create',compact('attributes'));
    }
    public function store(Request $request)
    {
         // // Validation
        // $validated = $request->validate([
        //     'value' => 'required',
        //      'attributeId' => 'required',
        // ]);

        $attributeValue = new AttributeValue();
        $attributeValue->value = $request->value;
        $attributeValue->attributeId = $request->attrId;

        $attributeValue->save();
        return response()->json(['success' => 'Attribute Value Created Successfully.']);

    }
    public function edit($id)
    {
        $attributes = Attribute::all();
        $attributeValue = AttributeValue::find($id);
        return view('Vendor.attributeValues.edit', compact('attributeValue','attributes'));
    }

    public function update(Request $request)
   {
        $id  =$request->attributeValueId;
       $attributeValue = AttributeValue::find($id);
       $attributeValue->value = $request->value;
       $attributeValue->attributeId = $request->attrId;

       $attributeValue->save();
       return response()->json(['status' => 201, 'success' => 'Attribute Updated Successfully!']);

   }
    public function destroy($id)
    {
        $attributeValue = AttributeValue::find($id);
        $attributeValue->delete();

        return redirect()->route('attributeValue.index')
            ->with('success', 'Attribute Value Deleted Successfully');
    }
}

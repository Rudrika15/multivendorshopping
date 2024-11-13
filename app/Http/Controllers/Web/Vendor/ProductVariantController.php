<?php

namespace App\Http\Controllers\Web\Vendor;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ProductVariantController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:productVariant-list|productVariant-create|productVariant-edit|productVariant-delete', ['only' => ['index']]);
        $this->middleware('permission:productVariant-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:productVariant-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:productVariant-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        if (request()->ajax()) {
            $productVariants = ProductVariant::with('product')->get();

            return DataTables::of($productVariants)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route("productVariant.edit", $row->id) . '"  class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm" data-table="#productVariantTable" data-url="' . route("productVariant.destroy", ':id') . '" >Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Vendor.productVariants.index');
    }
    public function create()
    {
        $products = Product::all();

        return view('Vendor.productVariants.create', compact('products'));
    }



    public function store(Request $request)
    {

        // // Validation
        // $validated = $request->validate([
        //     'name' => 'required',
        //     'price' => 'required',
        //      'stock' => 'required',
        // ]);

        $productVariant = new ProductVariant();

        $productVariant->variantName = $request->variantName;
        $productVariant->productId = $request->proId;
        $productVariant->price = $request->price;
        $productVariant->stock = $request->stock;

        $productVariant->save();

        // Return success response for AJAX
        return response()->json(['success' => 'Product Variant Created Successfully.']);
    }
    public function edit($id)
    {
        $products = Product::all();
        $productVariant = ProductVariant::find($id);
        return view('Vendor.productVariants.edit', compact('productVariant', 'products'));
    }

    // public function update(Request $request)
    // {
    //     $id  = $request->productVariantId;
    //     $productVariant = ProductVariant::find($id);
    //     $productVariant->variantName = $request->variantName;
    //     $productVariant->productId = $request->proId;
    //     $productVariant->price = $request->price;
    //     $productVariant->stock = $request->stock;
    //     $productVariant->save();
    //     return redirect()->route('productVariant.index')
    //         ->with('success', 'Product Variant Updated Successfully');
    // }

    public function update(Request $request, ProductVariant $productVariant)
    {
        $validator = Validator::make($request->all(), [
            'variantName' => 'required',
            'price' => 'required',
            'stock' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $productVariant->update($request->all());

        return response()->json(['success' => true, 'message' => 'Product Variant updated successfully']);
    }


    public function destroy($id)
    {
        $productVariant = ProductVariant::find($id);
        $productVariant->delete();

        return redirect()->route('productVariant.index')
            ->with('success', 'Product Variant Deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers\Web\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Attribute;

use App\Models\Product;
use App\Models\Store;
use App\Models\productGallery;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(): View
    // {
    //     $products = Product::latest()->paginate(5);

    //     return view('Vendor.products.index', compact('products'))
    //         ->with('i', (request()->input('page', 1) - 1) * 5);
    // }

    public function index()
    {
        if (request()->ajax()) {
            $products = Product::where('userId', Auth::user()->id)->get();

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route("product.edit", $row->id) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm" data-table="#productTable" data-url="' . route("product.destroy", ':id') . '" >Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action']) // If using HTML in columns like 'action', mark them raw
                ->make(true);
        }

        return view('Vendor.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $categories = Category::where('userId', Auth::user()->id)->get();
        $attributes = Attribute::all();

        return view('Vendor.products.create', compact('categories', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // // Validation
        // $validated = $request->validate([
        //     'name' => 'required',
        //     'image' => 'required',
        // ]);

        // $slug = Str::slug($request->slug);

        $storeId = Store::where('userId', Auth::user()->id)->pluck('id')->first();

        $product = new Product();
        $product->userId = Auth::user()->id;

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->categoryId = $request->input('c_id');
        $product->slug = preg_replace('/\s+/', '-', $request->input('name'));
        $product->storeId = $storeId;

        $product->save();


        $productGallery = new productGallery();
        $productGallery->productId = $product->id;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('products'), $filename);
            $productGallery->imageURL = $filename;
        }
        $productGallery->save();


        // $productGallery = new productGallery();
        // foreach ($request->file('images') as $productGallery->imageURL) {
        //      $file = $request->file('photo');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //      $file->move(public_path('products'), $filename);
        //     $productGallery->imageURL = $filename;
        //     $productGallery->productId = $product->id;
        //      $productGallery->save();
        //   }
        //  Return success response for AJAX
        return response()->json(['success' => 'Product Created Successfully.']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product): View
    {
        return view('Vendor.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('userId', Auth::user()->id)->get();
        $product = Product::find($id);
        return view('Vendor.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        // $validator = Validator::make($request->all(), [
        //             'variantName' => 'required',
        //             'price' => 'required',
        //             'stock' => 'required',

        //         ]);

        //         if ($validator->fails()) {
        //             return response()->json(['errors' => $validator->errors()], 422);
        //         }

        $product = Product::find($id);
        $product->name = request('name');
        $product->categoryId = request('cat_id');
        $product->price = request('price');
        $product->description = request('description');
        $product->save();
        return redirect()->route('product.index')
            ->with('success', 'Product  Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product Deleted Successfully');
    }
}

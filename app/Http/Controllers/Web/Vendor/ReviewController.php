<?php

namespace App\Http\Controllers\Web\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Yajra\DataTables\DataTables;


use Illuminate\Http\Request;

class ReviewController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:review-list', ['only' => ['index']]);

    }
    public function index()
    {
        if (request()->ajax()) {
            $reviews = Review::all();

            return DataTables::of($reviews)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class=" delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action']) // If using HTML in columns like 'action', mark them raw
                ->make(true);
        }

        return view('Vendor.reviews.index');
    }
}

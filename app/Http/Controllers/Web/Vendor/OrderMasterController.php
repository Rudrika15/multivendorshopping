<?php

namespace App\Http\Controllers\Web\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OrderMaster;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class OrderMasterController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $OrderMasters = OrderMaster::all();

            return DataTables::of($OrderMasters)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                    // $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class=" delete btn btn-danger btn-sm">Delete</a>';
                    // return $btn;
                })
                ->rawColumns(['action']) // If using HTML in columns like 'action', mark them raw
                ->make(true);
        }

        return view('Vendor.orderMasters.index');
    }
}

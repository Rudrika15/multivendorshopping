<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{


    public function create()
    {

        return view('Admin.stores.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        $user  =  new  User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        $user->assignRole('Store');




        $store  = new Store();
        $store->userId = $user->id;
        $store->storeName = $request->storeName;
        $store->contactNo  = $request->contactNo;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('stores'), $filename);
            $store->logo = $filename;
        }
        $store->address = $request->address;
        $store->city = $request->city;
        $store->pincode = $request->pincode;
        $store->landmark = $request->landmark;
        $store->aadharCardNo = $request->aadharCardNo;
        $store->panCardNo = $request->panCardNo;
        $store->gst = $request->gst;

        $store->storeDescription = $request->storeDescription;
        $store->save();


        return response()->json(['success' => 'Store Created Successfully.']);
    }
}

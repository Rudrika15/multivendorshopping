<?php

namespace App\Http\Controllers\Web\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

    public function profile()
    {
        $user = User::find(Auth::user()->id);

        return view('Vendor.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {

        $userId = Auth::user()->id;

        if ($userId) {

            $store  = Store::where('userId', $userId)->first();
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
            $store->storeDescription = $request->storeDescription;
            $store->save();
        } else {
            return "not found";
        }



        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }
}

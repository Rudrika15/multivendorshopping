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
            $store->save();
        } else {
            return "not found";
        }



        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }
}

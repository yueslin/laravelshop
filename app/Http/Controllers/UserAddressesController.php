<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddressRequest;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    public function index(Request $request)
    {
        return view('user_addresses.index',[
            'addresses' => $request->user()->addresses,
        ]);
    }

    public function create()
    {
        return view('user_addresses.create_and_edit',['address' => new UserAddress()]);
    }

    public function store(UserAddressRequest $request)
    {
        $request->user()->addresses()->create($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));
        return redirect()->route('user_addresses.index');

    }


    public function edit(UserAddress $userAddress)
    {
        $this->authorize('own', $userAddress);
        return view('user_addresses.create_and_edit',['address' => $userAddress]);
    }

    public function update(UserAddress $userAddress,UserAddressRequest $request)
    {
        $this->authorize('own', $userAddress);

        $userAddress->update($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }


    public function destroy(UserAddress $userAddress)
    {
        $userAddress->delete();
        return [];
    }

}

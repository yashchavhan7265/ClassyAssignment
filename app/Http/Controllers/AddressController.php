<?php

namespace App\Http\Controllers;

use App\Address;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $userAddress = Address::find($id);

        return response()->json($userAddress);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'address1' => 'bail|required|max:20',
            'address2' => 'max:20',
            'city' => 'required|max:20',
            'state' => 'required|max:20',
            'zip' => 'required',
            'country' => 'required|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        // $user = Address::where('user_id', '=', $id)->first();

        // if ($user === null) {
        $address = new Address();
        $address->user_id = $id;
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->zip = $request->zip;
        $address->country = $request->country;
        $address->save();

        return response()->json(['User address Added'], Response::HTTP_CREATED);
        // } else {
        //     return response()->json(['User address is available already'], Response::HTTP_OK);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $userAddress = $user->address;

        return response()->json($userAddress);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'address1' => 'max:20',
            'address2' => 'max:20',
            'city' => 'max:20',
            'state' => 'max:20',
            'country' => 'max:20'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $address = Address::find($id);
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->zip = $request->zip;
        $address->country = $request->country;
        $address->save();

        return response()->json(['User address Updated'], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        $address->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}

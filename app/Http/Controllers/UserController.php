<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();

        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'bail|required|unique:users|min:3',
            'last_name' => 'required|unique:users|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();


        return response()->json([
            'result' => 'User Registered Successfully',
        ], Response::HTTP_CREATED);
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

        return response()->json($user);
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
        $user = User::find($id);
        $validator = Validator::make($request->all(), [
            'first_name' => 'min:3',
            'last_name' => 'min:3',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->save();

        return response()->json([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

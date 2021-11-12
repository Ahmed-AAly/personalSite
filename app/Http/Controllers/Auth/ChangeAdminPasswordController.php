<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class ChangeAdminPasswordController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request): object
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:1', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to user
                ->withInput();
        }

        if (!$validator->fails()) {
            if (Auth::check()) {
                $loggedUser = Auth::user();
                $loggedUser->password = Hash::make($request['password']);
                $loggedUser->save();
                return back()->with('successstatus', 'Password was successfully updated!');
            }
        }
    }
}

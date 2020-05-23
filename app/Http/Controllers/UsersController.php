<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * ユーザー更新画面表示
     */
    public function edit(User $user) {
        return view('auth.edit')->with('user', $user);
    }

    /**
     * ユーザー更新処理
     */
    public function update(UserRequest $request, User $user) {
        DB::transaction(function() use ($request, $user) {
            $user->name = $request->name;
            $user->email = $request->email;
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
        });
        return redirect('/');
    }
}

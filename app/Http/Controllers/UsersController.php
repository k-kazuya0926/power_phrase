<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * ユーザー詳細画面表示
     */
    public function show(User $user) {
        return view('auth.show')->with('user', $user);
    }

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
            if (!empty($request->file('profile_image'))) {
                $filename = $request->profile_image->storeAs('public/profile_images', $user->id . '.jpg');
                $user->image_filename = basename($filename);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
        });
        return redirect("/users/$user->id");
    }
}

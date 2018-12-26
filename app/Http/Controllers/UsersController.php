<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use App\Policies\UserPolicy;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except'=>['show']]);
    }


    //
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * 用户编辑页面
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }


    public function update(UserRequest $request, User $user, ImageUploadHandler $uploadHandler)
    {
        $this->authorize('update', $user);
        $data = $request->all();

        if ($request->avatar) {

            $result = $uploadHandler->save($request->avatar, 'avatar', $user->id, 362);

            $data['avatar'] = $result['path'];
        }
        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功!');
    }
}

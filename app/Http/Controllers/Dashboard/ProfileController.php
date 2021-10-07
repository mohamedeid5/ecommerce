<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function edit()
    {
        $admin = auth('admin')->user();

        return view('dashboard.profile.edit', compact('admin'));
    }

    /**
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */

    public function update(ProfileRequest $request)
    {

        if ($request->password == null) {

            $request['password'] = auth()->user()->password;

        } else {

            $request['password'] = bcrypt($request['password']);
        }

        $admin = auth('admin')->user();

        $admin->update($request->validated());

        return back();

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        if ($request->image) {
            $imagePath = $request->image->store('profiles', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(300, 300);
            $image->save();
            auth()->user()->update(['image' => 'storage/' . $imagePath]);
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }
}

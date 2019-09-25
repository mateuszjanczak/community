<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function profile($username, UserRepository $userRepo, PostRepository $postRepo, $page = 1)
    {
        $user = $userRepo->findByUsername($username);

        if (empty($user)) {
            return abort(404);
        }

        $posts = $postRepo->getProfilePosts($user->id, $page, $username);

        return view('profile', ['user' => $user, 'posts' => $posts]);
    }

    public function avatar()
    {
        return view('settings.avatar');
    }

    public function avatarStore(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=150,min_height=150,max_width=200,max_height=200'
        ]);

        $user = Auth::user();

        $filename = $user->username . "." . request()->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('avatar'), $filename);

        $user->avatar = $filename;
        $user->save();

        return back()->with('status', 'Avatar has been changed');
    }

    public function avatarDelete()
    {
        $user = Auth::user();
        $user->avatar = 0;
        $user->save();

        return back()->with('status', 'Avatar has been deleted');
    }

    public function password()
    {
        return view('settings.password');
    }

    public function passwordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => 'required|same:password'
        ]);

        $user = Auth::user();
        $currentPassword = $user->getAuthPassword();

        if (Hash::check($request->input('current_password'), $currentPassword)) {
            $user->password = Hash:: make($request->input('password'));
            $user->save();

            return back()->with('status', 'Password has been changed');
        }

        return back()->with('status', 'Incorrect password');
    }

    public function email()
    {
        return view('settings.email');
    }

    public function emailStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);

        $user = Auth::user();
        $currentPassword = $user->getAuthPassword();

        if (Hash::check($request->input('current_password'), $currentPassword)) {
            $user->email = $request->input('email');
            $user->save();

            return back()->with('status', 'Email has been changed');
        }

        return back()->with('status', 'Incorrect password');
    }
}

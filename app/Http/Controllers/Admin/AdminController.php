<?php

namespace App\Http\Controllers\Admin;

use App\Models\File;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Banner;
use App\Models\Category;
use App\Models\File as ModelsFile;
use App\Models\Game;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Symfony\Component\HttpFoundation\File\File;

class AdminController extends Controller
{
    public function dashboard()
    {
        $categories = $this->getCategorySchema();
        $games = $this->getGameSchema();
        $banners = $this->getBannerSchema();
        $label = "Index";
        $icon = "bi bi-pie-chart";
        return view('admin.dashboard', compact('label', 'icon', 'categories', 'games', 'banners'));
    }

    // public function dashboardCreate()
    // {

    //     return view('admin.dashboard-create',compact('categories','games','banners'));
    // }



    public function register()
    {
        return view('admin.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            // 'email' => ['required', 'unique:'.Admin::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required'],
            'password' => ['required'],
        ]);

        $admin = new Admin();
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);


        $admin->save();
        return view('admin.loginForm');
    }
    public function loginForm()
    {

        return view('admin.loginForm');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $admin = Admin::where('email', $request->input('email'))->first();


        if (!$admin) {
            return back()->withErrors(['email' => 'This email is not registered.']);
        }

        // Check the password
        if (!Hash::check($request->input('password'), $admin->password)) {
            return back()->withErrors(['password' => 'The password is incorrect.']);
        }
        Auth::guard('admin')->login($admin);
        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.loginForm');
    }

    public function profile()
    {
        $admin = auth()->guard('admin')->user();

        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {


        $admin = auth()->guard('admin')->user();

        if (!$admin) {
            return redirect()->back()->with('error', 'You are not authenticated.');
        }

        $admin->first_name = $request->input('first_name');
        $admin->last_name = $request->input('last_name');
        $admin->email = $request->input('email');
        $admin->country_code = $request->input('country_code');
        $admin->mobile_number = $request->input('mobile_number');


        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $imageDirectoryPath = 'admins';
            $imagePath = $image->storeAs($imageDirectoryPath, $filename, 'public');
            $admin->profile_photo = $imagePath;
        }
        $admin->save();
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function forgotpassword()
    {
        return view('admin.forgotpassword');
    }

    protected function getCategorySchema()
    {
        return Category::where('status', 1)->count();
    }

    protected function getGameSchema()
    {
        return Game::where('status', 1)->count();
    }
    protected function getBannerSchema()
    {
        return Banner::where('status', 1)->count();
    }
}

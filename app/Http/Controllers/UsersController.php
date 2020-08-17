<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;
use App\Post;
use App\Photo;

class UsersController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'name'=>'required|max:100',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:6',
            
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        Auth::login($user);
        return redirect('/dashboard');
    }

    public function login(Request $request){
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required|min:4'
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/dashboard');
        }
        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }

    public function getDashboard(){
        $posts = Post::latest()->get();
        return view('dashboard')->with('posts', $posts);
    }

    public function getAccount(){
        return view('account')->with('user', Auth::user());
    }

    public function postSaveAccount(Request $request){
        $user = Auth::user();
        $user->name = $request->name;
        $user->update();
        $file = $request->file('image');
        $fileName = 'profile-' . $user->id . '.jpg';
        if($file){
            $file->move('images', $fileName);
            $photo = new Photo();
            $photo->user_id = $user->id;
            $photo->name = $fileName;
            $photo->save();
            
        }
        return redirect()->route('dashboard');
    }

}

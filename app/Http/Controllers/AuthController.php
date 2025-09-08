<?php

namespace App\Http\Controllers;

use App\Models\User;
use Doctrine\Inflector\Rules\English\Rules;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function signUp(){
        return view('signup');
    }
    public function login(){
        return view('login');
    }
    public function registerNewUser(Request $request){
        $userData=$request->validate([
            'name'=>['required','string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'phone'=>['required','unique:users,phone'],
            'type' => ['required', 'string', 'in:Advertiser,Billboard Owner'],
            'pass' => ['required', 'confirmed','min:6','regex:/[A-Z]/','regex:/[a-z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'],
        ]);
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            "phone"=>$request->phone,
            "type"=>$request->type,
            'password'=>Hash::make($request->pass)
        ]);
        Auth::login($user);
        if($user->type=="Advertiser")
            return redirect()->route('home.user');
        else
            return redirect()->route('home');
    }
    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'phone' => ['required'],
            'pass' => ['required'],
        ]);

        if (Auth::attempt(['phone' => $credentials['phone'], 'password' => $credentials['pass']], $request->has('remember'))) {
            $request->session()->regenerate();
            if(Auth::user()->type == "Advertiser")
                return redirect()->intended('/home/user');
            else
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'phone' => 'The provided credentials do not match our records.',
        ])->onlyInput('phone');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('login');
    }
    public function profile(){
        return view('profile');
    }
    public function updateProfile(Request $request){
        $user=Auth::user();
        $updatedData=$request->validate([
            "name"=>["required"],
            "email"=>["email","required", Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['required', Rule::unique('users', 'phone')->ignore($user->id)],
            'pass' => ['required', 'confirmed','min:6','regex:/[A-Z]/','regex:/[a-z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'],
        ]);
        if(isset($updatedData["pass"])){
            $updatedData["password"]=bcrypt($updatedData["pass"]);
            unset($updatedData["pass"]);}
        $updatedUser= $user->update($updatedData);
        if(!$updatedUser)
            return back()->with('error',"Profile Update failed!!");
        else
            return back()->with("success","Profile Updated sucessfully!!!");
    }
    public function deleteProfile(){
        $user= Auth::user();
        $userId=$user->id;
        Auth::logout();
        $deletedAccount=User::where('id',$userId)->delete();
        
        if($deletedAccount)
            return view("home")->with("success","Profile successfully deleted!!");
        else
            return back()->with("error","Failed to delete Account try again!");
    }
    public function forgetPassword(){
        $action = "get new pass";
        return view('gerpassword', compact(["action"]));
        
    }
    public function resetPassword(Request $request){
        // $validate= $request->validate([
        //     "pass"=>"password|required",
        //     "email"=>"string"
        // ]);
        // $user= User::where("email",$validate["email"])->first();
        // $user->password= Hash::make($validate["pass"]);
        // $user->save();
        // return view('login');
    }
   
}

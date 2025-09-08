<?php

namespace App\Http\Controllers;

use App\Mail\CompanyMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Str;
use Throwable;

class MailController extends Controller
{
    public function sendEmailToUser(Request $request){
        $validData= $request->validate([
            "email"=>"required|email"
        ]);
        $user= User::where('email',$validData["email"])->first();
        if(!$user){
            return back()->withErrors(['email'=>"email not regesterd"]);
        }
        try{
            
            $newPassword = Str::random(6);
            Mail::to($validData["email"])->send(new CompanyMail("Password Reset",
            $newPassword,
            "wamishosiraj@gmail.com",
            null,
            "forUser"
            ));
            $user->password=Hash::make($newPassword);
            $user->save();
            $passmessage= "We have sent a new password to you email use it to login";
            return view('login',compact("passmessage"));
        
        }catch(Throwable $e){
            return back()->withErrors(["email"=>"error: ".$e->getMessage()]);
        }
    }
    public function sendMailToCompany(Request $request){
        try{
            $validData= $request->validate([
                "name"=>"required|string",
                "email"=>"required|email",
                "message"=>"required|string",

            ]);
            $subject= "Reaching out from customer";
            Mail::to("wamishosiraj@gmail.com")->send(new CompanyMail($subject,
            $validData["message"],
            $validData["email"],
            $validData["name"],
            "forOwner"
            ));
            
        return back()->with('success', 'Your message was sent successfully!');

    } catch (Throwable $e) {
            echo   $e->getMessage();
        }
    }
}

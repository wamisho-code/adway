<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('cssfiles/register.css') }}">
    <title>Sign-Up | Page</title>
</head>
<body>
    <div class="registration-container">
        <div class="logo">
            <img src="{{asset('img/app_logo.png') }}" alt="logo">
            <h1>Registration</h1>
        </div>
        <div class="form-wrapper">
            <form action="{{route('signup.register')}}" method="post">
                @csrf
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required value="{{old("name")}}">
                @error('name')
                    <p style="color: rgb(228, 37, 37);padding:3px 0;">* {{ $message }}</p>
                @enderror
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required value="{{old("email")}}">
                @error('email')
                    <p style="color: rgb(228, 37, 37);padding:3px 0;">* {{ $message }}</p>
                @enderror
                <label for="phone">Phone</label>
                <input type="tel" name="phone" id="phone" required value="{{old("phone")}}">
                @error('phone')
                    <p style="color: rgb(228, 37, 37);padding:3px 0;">* {{ $message }}</p>
                @enderror
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" required>
                @error('pass')
                    <p style="color: rgb(228, 37, 37);padding:3px 0;">* {{ $message }}</p>
                @enderror

                <label for="pass_confirmation">Confirm Password</label>
                <input type="password" name="pass_confirmation" id="pass_confirmation" required>

                <label for="type">Account Type</label>
                <select name="type" id="type" required>
                    <option value="">--Select Account Type--</option>
                    <option value="Advertiser">Advertiser</option>
                    <option value="Billboard Owner">Billboard Owner</option>
                </select>
                @error('type')
                    <p style="color: rgb(228, 37, 37);padding:3px 0;">* {{ $message }}</p>
                @enderror
                <div class="checkbox-wrapper">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember Me</label>
                </div>
                  


                <input type="submit" value="Register">
            </form>
            <a href="{{route('login')}}">Already has account</a>
        </div>
    </div>
    
</body>
</html>
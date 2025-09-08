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
            <h1>Login</h1>
            @if (isset($passmessage))
                <p>{{$passmessage}}</p>
            @endif
        </div>
        <div class="form-wrapper">
            <form action="{{route('login.user')}}" method="post">
                @csrf
                <label for="phone">Phone</label>
                <input type="tel" name="phone" id="phone" required>
                @error('phone')
                    <p style="color: rgb(228, 37, 37);padding:3px 0;">* {{ $message }}</p>
                @enderror
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" required>
                @error('pass')
                    <p style="color: rgb(228, 37, 37);padding:3px 0;">* {{ $message }}</p>
                @enderror
                <div class="checkbox-wrapper">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember Me</label>
                </div>
                

                <input type="submit" value="Login">
            </form>
            <a href="{{route('signup')}}">Don't have account Register</a>
            <a href="{{route('forget-password')}}">Forget Password</a>
        </div>
    </div>
    <script>
        document.getElementById("togglePass").addEventListener("click", function () {
            const pass = document.getElementById("pass");
            const type = pass.getAttribute("type") === "password" ? "text" : "password";
            pass.setAttribute("type", type);
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });

        document.getElementById("toggleConfirm").addEventListener("click", function () {
            const confirm = document.getElementById("pass_confirmation");
            const type = confirm.getAttribute("type") === "password" ? "text" : "password";
            confirm.setAttribute("type", type);
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });
    </script>
</body>

</html>

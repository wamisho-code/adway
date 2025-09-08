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
            {{-- <img src="{{asset('img/app_logo.png') }}" alt="logo"> --}}
            <h1 style="font-size: 15px;text-align: left;color:rgb(77, 76, 76)">We will send a new password to you email address.<br>
            Latter when you login you can reset your password in acount section.
            </h1>
        </div>
        <div class="form-wrapper">
            
                <form action="{{route('get-new-pass')}}" method="post">
                    @csrf
                    <label for="phone">Email</label>
                    <input type="email" name="email" id="email" required placeholder="someone@some.com">
                    @error('email')
                        <p style="color: rgb(228, 37, 37);padding:3px 0;">* {{ $message }}</p>
                    @enderror
                    <input type="submit" value="Send new password ">
                </form>
                <a href="{{route('signup')}}">Don't have account Register</a>            
            
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
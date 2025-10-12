<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('cssfiles/register.css') }}">
    <title>Sign-Up | Page</title>
    <style>
        /* Full-screen background with image + dark overlay */
/* Full-page background with dark overlay */
body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.8)),
        url('../img/auth.jpg') no-repeat center center/cover;
}

/* Container centered in viewport */
.registration-container {
    background-color: #ffffff;
    border-radius: 16px;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
    max-width: 480px;
    width: 100%;
    padding: 40px 35px;
    box-sizing: border-box;
}

/* Logo section */
.logo {
    text-align: center;
    margin-bottom: 30px;
}

.logo img {
    height: 48px;
    margin-bottom: 12px;
}

.logo h1 {
    font-size: 24px;
    color: #1e293b;
    margin: 0;
}

/* Form wrapper and inputs */
.form-wrapper form {
    display: flex;
    flex-direction: column;
}

.form-wrapper label {
    font-weight: 600;
    margin: 14px 0 6px;
    color: #1f2937;
}

.form-wrapper input[type="text"],
.form-wrapper input[type="email"],
.form-wrapper input[type="tel"],
.form-wrapper input[type="password"],
.form-wrapper select {
    padding: 11px 14px;
    font-size: 15px;
    border: 1.5px solid #cbd5e1;
    border-radius: 8px;
    margin-bottom: 4px;
}

.form-wrapper input:focus,
.form-wrapper select:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 6px rgba(37, 99, 235, 0.2);
}

/* Checkbox */
.checkbox-wrapper {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    margin-top: 16px;
}

.checkbox-wrapper input[type="checkbox"] {
    width: 16px;
    height: 16px;
    margin: 0;
    vertical-align: middle;
    accent-color: #2563eb;
    /* nice blue for modern browsers */
}

.checkbox-wrapper label {
    vertical-align: middle;
    margin: 0;
    padding: 0;
    line-height: 1;
    cursor: pointer;
    color: #1f2937;
}

/* Submit button */
.form-wrapper input[type="submit"] {
    background-color: #2563eb;
    color: white;
    padding: 12px;
    font-weight: 600;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    margin-top: 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-wrapper input[type="submit"]:hover {
    background-color: #1e40af;
}

/* Login link */
.form-wrapper a {
    text-align: center;
    margin-top: 20px;
    display: block;
    text-decoration: none;
    color: #334155;
    font-weight: 500;
}

.form-wrapper a:hover {
    text-decoration: underline;
}

/* Responsive tweaks */
@media (max-width: 480px) {
    .registration-container {
        padding: 20px 15px;
    }

    .logo img {
        max-width: 100px;
    }

    .logo h1 {
        font-size: 20px;
    }

    input[type="submit"] {
        font-size: 15px;
        padding: 10px;
    }
}
    </style>
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

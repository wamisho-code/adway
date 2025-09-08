<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
body {
  background: linear-gradient(135deg, #f0f4f8, #dfe9f3);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin: 0;
  padding: 0;
}

/* Profile container with elevated modern style */
.profile-container {
  max-width: 600px;
  margin: 60px auto;
  background: #ffffff;
  border-radius: 20px;
  box-shadow: 0 16px 40px rgba(0, 0, 0, 0.1);
  padding: 40px 45px;
  backdrop-filter: blur(8px);
}

/* Header section with large icon */
.profile-header {
  text-align: center;
  margin-bottom: 35px;
}

.profile-header i {
  font-size: 64px;
  color: #3b82f6;
  margin-bottom: 10px;
}

.profile-header h1 {
  font-size: 26px;
  margin: 0;
  color: #1e293b;
}

.profile-summary {
  display: flex;
  justify-content: space-between;
  margin-top: 12px;
  font-size: 16px;
  color: #475569;
}

.profile-summary h3 {
  margin: 0;
}

/* Form titles and inputs */
.profile-form h2 {
  font-size: 20px;
  margin-bottom: 18px;
  color: #334155;
  border-bottom: 1px solid #e2e8f0;
  padding-bottom: 8px;
}

.profile-form label {
  display: block;
  font-weight: 600;
  margin: 14px 0 6px;
  color: #1e293b;
}

.profile-form input[type="text"],
.profile-form input[type="email"],
.profile-form input[type="tel"],
.profile-form input[type="password"] {
  width: 100%;
  padding: 12px 14px;
  border: 1.5px solid #cbd5e1;
  border-radius: 10px;
  font-size: 15px;
  transition: all 0.3s ease;
}

.profile-form input:focus {
  border-color: #3b82f6;
  box-shadow: 0 0 10px rgba(59, 130, 246, 0.25);
  outline: none;
}

/* Submit button */
.profile-form input[type="submit"] {
  margin-top: 24px;
  width: 100%;
  background-color: #3b82f6;
  color: white;
  border: none;
  padding: 13px;
  font-size: 16px;
  font-weight: 600;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.profile-form input[type="submit"]:hover {
  background-color: #2563eb;
}

/* Action links */
.profile-actions {
  margin-top: 32px;
  display: flex;
  justify-content: space-between;
}

.profile-actions a {
  text-decoration: none;
  padding: 10px 22px;
  border-radius: 6px;
  font-weight: 600;
  color: #334155;
  border: 1.5px solid #94a3b8;
  transition: all 0.3s ease;
  user-select: none;
}

.profile-actions a.logout-link:hover {
  background-color: #e2e8f0;
  border-color: #94a3b8;
  color: #1e293b;
}

.profile-actions a.delete-link {
  color: #dc2626;
  border-color: #dc2626;
}

.profile-actions a.delete-link:hover {
  background-color: #fee2e2;
  color: #991b1b;
  border-color: #dc2626;
}



</style>
@include('partials.navbar')
<div class="profile-container">
    <div class="profile-header">
        @include('partials.status')
        <i class="fa-solid fa-circle-user"></i>
        <h1>{{ Auth::user()->name }}</h1>
        @if(!Auth::user()->type == "Advertiser")
            <div class="profile-summary">
                <h3>Total Bookings: <span>--</span></h3>
                <h3>Total Earned: <span>-- birr</span></h3>
            </div>
        @endif
    </div>

    <form class="profile-form" action="{{route("profile.update")}}" method="POST">
        <h2>Update Personal Info</h2>
        @csrf
        @method("put")
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{ Auth::user()->name }}">
        @error('name')
            <p style="color: rgb(228, 37, 37);padding:3px 0;">* {{ $message }}</p>
        @enderror

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ Auth::user()->email }}">
        @error('email')
            <p style="color: rgb(228, 37, 37);padding:3px 0;">* {{ $message }}</p>
        @enderror
        <label for="phone">Phone</label>
        <input type="tel" name="phone" id="phone" required value="{{Auth::user()->phone}}">
        @error('phone')
            <p style="color: rgb(228, 37, 37);padding:3px 0;">* {{ $message }}</p>
        @enderror
        <label for="pass">Password</label>
        <div style="position: relative;">
            <input type="password" name="pass" id="pass" placeholder="Enter new password" style="padding-right: 40px;">
            <i class="fa fa-eye" id="togglePass"
                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #555;"></i>
        </div>
        @error('pass')
            <p style="color: rgb(228, 37, 37);padding:3px 0;">* {{ $message }}</p>
        @enderror
        
        
        <label for="pass_confirmation">Confirm Password</label>
        <div style="position: relative;">
            <input type="password" name="pass_confirmation" id="pass_confirmation" required style="padding-right: 40px;">
            <i class="fa fa-eye" id="toggleConfirm"
                style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #555;"></i>
        </div>

        <input type="submit" value="Update">
    </form>

    <div class="profile-actions">
        <a href="{{ route('logout') }}" class="logout-link">Logout</a>
        <a href="{{route('profile.delete')}}" class="delete-link">Delete Account</a>
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
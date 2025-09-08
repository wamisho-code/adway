<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Home</title>
      
</head>

<body>
    @include('partials.navbar')
    <main class="landing-container">
    {{ $slot }}
    </main>
    
   
  
</body>
@include('partials.chooseus')
@include('partials.pricing')
@include('partials.maps')
@include('slide')
@include('footer')


</html>
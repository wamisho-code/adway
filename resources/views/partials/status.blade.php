@if(session('success') || session("error"))
    <div id="toast" style="margin:auto; top: 60px; padding: 8px 60px;
                        border-radius: 5px; color: #000000; opacity: 1;
                        transition: opacity 0.5s ease;
                        background-color: {{ session('success') ? 'rgba(101, 228, 131, 0.4)' : '#dc3545' }};
                        z-index: 9999;">
        {{session('success') ?? session('error')}}
    </div>
    <script>
        setTimeout(function () {
            var toast = document.getElementById("toast");
            if (toast) {
                toast.style.opacity = '0';
                setTimeout(function () {
                    toast.style.display = 'none';
                }, 500); 
            }
        }, 5000);
    </script>

@endif
@php use App\Models\User; @endphp

<style>
/* Video Background */
.video-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -2;
}

#bg-video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Dark Overlay */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* semi-transparent black */
    z-index: -1;
}

/* Form Wrapper to center it */
.form-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    padding: 20px;
}

/* Form Container - Glass effect */
.form-container {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 20px;
    padding: 30px;
    width: 100%;
    max-width: 500px;
    color: #fff;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
    font-family: 'Segoe UI', sans-serif;
}

/* Typography */
.form-container h2 {
    font-size: 24px;
    margin-bottom: 10px;
}

.form-container h4 {
    font-size: 16px;
    margin-bottom: 20px;
    font-weight: normal;
}

/* Labels and Inputs */
.form-container label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #222;
}

.form-container input[type="date"],
.form-container input[type="file"],
.form-container input[type="submit"] {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 20px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
}

/* Input styles */
.form-container input[type="date"],
.form-container input[type="file"] {
    background: rgba(255, 255, 255, 0.85);
    color: #000;
}

/* Submit Button */
.form-container input[type="submit"] {
    background-color: #007bff;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-container input[type="submit"]:hover {
    background-color: #0056b3;
}



</style>
@include('partials.navbar')
<div class="video-background">
    <video autoplay muted loop id="bg-video">
        <source src="{{ asset('videos/3d without glasses 8_2.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="overlay"></div>
</div>

<div class="form-wrapper">
    
    <div class="form-container">
        @include('partials.status')
        <h2>Book a Billboard for {{ $billboard->title }}</h2>
        <h4>Owned by {{$owner->name }}</h4>
        <form action="{{route('book')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Ad Visible From</label>
            <input type="date"  min="{{$billboard->available_from}}"  max="{{$billboard->available_to}}" name="available_from" required>

            <label>Ad Visibility Ends</label>
            <input type="date" min="{{$billboard->available_from}}"  max="{{$billboard->available_to}}" name="available_to" required>
            <p id="day-count" style="margin-top: 10px; color: #fff; font-weight: bold;"></p>


            <label for="video">Upload Your Ad-Video</label>
            <input type="file" id="video" name="video">

            <input type="submit" id="submit-button" value="{{ $billboard->price_per_day }} Birr per Day">
            <input type="hidden" name="billboard_id" value="{{ $billboard->id }}">
            <input type="hidden" name="owner_id" value="{{ $owner->id }}">
            <div id="uploadProgress" style="display:none; width:100%; background:#eee; margin-top:10px;">
                <div id="progressBar" style="width:0%; height:20px; background:#4caf50;"></div>
            </div>
            <p id="progressText"></p>
              

        </form>
    </div>
</div>
@include('footer')
<script>
    const fromInput = document.querySelector('input[name="available_from"]');
    const toInput = document.querySelector('input[name="available_to"]');
    const output = document.getElementById('day-count');
    const submitButton = document.getElementById('submit-button');

    // Laravel injects PHP into HTML, so we grab the price from the blade variable
    const pricePerDay = {{ $billboard->price_per_day }};

    function updateDayCount() {
        const fromDate = new Date(fromInput.value);
        const toDate = new Date(toInput.value);

        if (fromInput.value && toInput.value) {
            const timeDiff = toDate - fromDate;
            const dayDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));

            if (dayDiff < 0) {
                output.textContent = "⚠️ End date must be after start date.";
                output.style.color = 'red';
                submitButton.value = `${pricePerDay} Birr per Day`;
            } else {
                const totalDays = dayDiff + 1;
                const totalPrice = totalDays * pricePerDay;

                output.textContent = `📅 Ad will be displayed for ${totalDays} day(s).`;
                output.style.color = '#fff';

                submitButton.value = `${totalPrice} Birr for ${totalDays} Day${totalDays > 1 ? 's' : ''}`;
            }
        } else {
            output.textContent = "";
            submitButton.value = `${pricePerDay} Birr per Day`;
        }
    }

    fromInput.addEventListener('change', updateDayCount);
    toInput.addEventListener('change', updateDayCount);
    const form = document.querySelector('form');
    const progressBar = document.getElementById('progressBar');
    const uploadProgress = document.getElementById('uploadProgress');
    const progressText = document.getElementById('progressText');

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // stop normal submit

            const formData = new FormData(form);

            const xhr = new XMLHttpRequest();

            xhr.open('POST', form.action);

            xhr.upload.addEventListener('progress', function (e) {
                if (e.lengthComputable) {
                    const percent = (e.loaded / e.total) * 100;
                    progressBar.style.width = percent + '%';
                    progressText.textContent = `Uploading: ${Math.round(percent)}%`;
                    uploadProgress.style.display = 'block';
                }
            });

            xhr.onload = function () {
                if (xhr.status === 200) {
                    progressText.textContent = "Upload complete!";
                    // optionally, redirect or reset form here
                    // location.reload();
                } else {
                    progressText.textContent = "Upload failed.";
                }
            };

            xhr.onerror = function () {
                progressText.textContent = "Upload error.";
            };

            xhr.send(formData);
        });
</script>
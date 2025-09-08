<style>
    body {
        background: #f5f7fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 20px;
    }

    .form-container {
        max-width: 600px;
        margin: 40px auto;
        background-color: #ffffff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    form label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
        color: #555;
    }

    form input[type="text"],
    form input[type="date"],
    form input[type="number"],
    form input[type="file"],
    form textarea {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
        transition: border-color 0.2s ease;
    }

    form input:focus,
    form textarea:focus {
        border-color: #007bff;
        outline: none;
    }

    form textarea {
        resize: vertical;
    }

    form button {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: #ffffff;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button:hover {
        background-color: #0056b3;
    }
</style>
</head>
    <form action="/home" method="get" style="margin-left:auto ;">
    <button type="submit" style="width:200px;;background: #007bff;color:white;border:none;border-radius:3px;padding:8px;cursor: pointer;">Go back <--</button>
    </form>
    <div class="form-container">
        @include('partials.status')
        
        <h2>Add New Billboard</h2>
        <form action="{{route('new.billboard')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label>Title</label>
            <input type="text" name="title" required>

            <label>Description</label>
            <textarea name="description" rows="3"></textarea>

            <label>Location</label>
            <input type="text" name="location" required>

            <label>Photo</label>
            <input type="file" name="photo" accept="image/*" required>

            <label>Available From</label>
            <input type="date" name="available_from" required>

            <label>Available To</label>
            <input type="date" name="available_to" required>

            <label>Price per Day</label>
            <input type="number" name="price_per_day" step="0.01" required>

            <label>Price per Month (optional)</label>
            <input type="number" name="price_per_month" step="0.01">

            <button type="submit">Add Billboard</button>
        </form>
    </div>
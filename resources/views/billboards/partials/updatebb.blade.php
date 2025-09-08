<head>
    <style>
        /* Scoped CSS inside .billboard-form-wrapper */
        .billboard-form-wrapper {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #222;
            background-color: #f9fafb;
            padding: 20px;
        }

        .billboard-form-wrapper .form-container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            padding: 30px 35px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .billboard-form-wrapper .form-container h2 {
            font-weight: 700;
            font-size: 28px;
            text-align: center;
            margin-bottom: 30px;
            color: #1a1a1a;
        }

        .billboard-form-wrapper label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #444;
        }

        .billboard-form-wrapper input[type="text"],
        .billboard-form-wrapper input[type="date"],
        .billboard-form-wrapper input[type="number"],
        .billboard-form-wrapper input[type="file"],
        .billboard-form-wrapper textarea {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 22px;
            border: 1.5px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            color: #333;
            font-family: inherit;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            box-sizing: border-box;
            resize: vertical;
        }

        .billboard-form-wrapper input[type="text"]:focus,
        .billboard-form-wrapper input[type="date"]:focus,
        .billboard-form-wrapper input[type="number"]:focus,
        .billboard-form-wrapper input[type="file"]:focus,
        .billboard-form-wrapper textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 8px rgba(37, 99, 235, 0.4);
            outline: none;
        }

        .billboard-form-wrapper button[type="submit"] {
            background-color: #2563eb;
            color: white;
            font-weight: 700;
            font-size: 17px;
            padding: 14px;
            width: 100%;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            user-select: none;
            transition: background-color 0.25s ease;
        }

        .billboard-form-wrapper button[type="submit"]:hover {
            background-color: #1e40af;
        }

        .billboard-form-wrapper form[action="/home"] {
            text-align: right;
            margin-bottom: 30px;
        }

        .billboard-form-wrapper form[action="/home"] button {
            width: 160px;
            background-color: #2563eb;
            border-radius: 8px;
            padding: 10px 0;
            font-weight: 600;
            font-size: 15px;
            border: none;
            cursor: pointer;
            color: white;
            transition: background-color 0.25s ease;
        }

        .billboard-form-wrapper form[action="/home"] button:hover {
            background-color: #1e40af;
        }

        .billboard-form-wrapper img {
            display: block;
            width: 100%;
            max-height: 250px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .billboard-form-wrapper .form-container {
                margin: 20px 15px;
                padding: 25px 20px;
            }

            .billboard-form-wrapper form[action="/home"] {
                text-align: center;
            }

            .billboard-form-wrapper form[action="/home"] button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    @include('partials.navbar')

    <div class="billboard-form-wrapper">

        <form action="/home" method="get" style="margin-left:auto;">
            <button type="submit">Go back &lt;--</button>
        </form>

        <div class="form-container">
            @include('partials.status')
            <h2>Add New Billboard</h2>
            <form action="{{ route('billboards.update', $billboard->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("put")
                <label>Title</label>
                <input type="text" name="title" required value="{{ old('title', $billboard->title) }}">

                <label>Description</label>
                <textarea name="description" rows="3">{{ old('description', $billboard->description) }}</textarea>

                <label>Location</label>
                <input type="text" name="location" required value="{{ old('location', $billboard->location) }}">

                <label>Photo</label>
                <input type="file" name="photo" accept="image/*" {{ isset($billboard->photo_path) ? '' : 'required' }}>
                @if(isset($billboard->photo_path))
                    <img src="{{ $billboard->photo_path }}" alt="Old photo">
                @endif

                <label>Available From</label>
                <input type="date" name="available_from" required
                    value="{{ old('available_from', $billboard->available_from) }}">

                <label>Available To</label>
                <input type="date" name="available_to" required
                    value="{{ old('available_to', $billboard->available_to) }}">

                <label>Price per Day</label>
                <input type="number" name="price_per_day" step="0.01" required
                    value="{{ old('price_per_day', $billboard->price_per_day) }}">

                <label>Price per Month (optional)</label>
                <input type="number" name="price_per_month" step="0.01"
                    value="{{ old('price_per_month', $billboard->price_per_month) }}">

                <button type="submit">Update Billboard</button>
            </form>
        </div>

    </div>

</body>
    
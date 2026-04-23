<!DOCTYPE html>
<html>
<head>
    <title>Volunteer Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<div class="max-w-4xl mx-auto p-6">

    <a href="{{ url('/user/explore') }}" class="text-blue-500">← Back To Explore</a>

    <div class="bg-white rounded-2xl shadow mt-4 p-6">

        <h1 class="text-3xl font-bold">{{ $volunteer->title }}</h1>

        <p class="text-sm text-gray-500 mt-2">
            by {{ $volunteer->organization->name ?? 'Organization' }}
        </p>

        @if($volunteer->image)
            <img src="{{ asset('storage/'.$volunteer->image) }}" class="mt-4 rounded-lg">
        @endif

        <div class="mt-6 text-gray-700">
            {{ $volunteer->description }}
        </div>

    </div>

</div>

</body>
</html>
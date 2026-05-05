<!DOCTYPE html>
<html>
<head>
    <title>Blog List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-5xl mx-auto mt-10">

    <h1 class="text-2xl font-bold mb-6">Blog List</h1>

    <a href="{{ route('blog.create') }}" 
       class="bg-green-600 text-white px-4 py-2 rounded">
       + Create Blog
    </a>

    @if(session('success'))
        <div class="bg-green-200 p-3 mt-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full mt-6 bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3">Title</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
            <tr class="border-t">
                <td class="p-3">{{ $blog->title }}</td>
                <td class="p-3 flex gap-2">

                    <a href="{{ route('blog.show', $blog->id) }}" 
                       class="bg-blue-500 text-white px-3 py-1 rounded">
                       View
                    </a>

                    <a href="{{ route('blog.edit', $blog->id) }}" 
                       class="bg-yellow-500 text-white px-3 py-1 rounded">
                       Edit
                    </a>

                    <form action="{{ route('blog.destroy', $blog->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

</body>
</html>
@extends('../layouts/user/master-user')

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-2 text-gray-800">Welcome, {{$User -> name}}</h2>
        <p class="text-gray-600 mb-6">Get your scholarship proposals efficiently.</p>
        @foreach($file_path as $file_paths)
            <p><strong>DKBS File:</strong> <a href="{{ asset('storage/' . $file_paths->dkbs) }}" target="_blank">View DKBS File</a></p>
        @endforeach

        <div class="flex flex-col space-y-4">

        </div>
    </div>
</div>

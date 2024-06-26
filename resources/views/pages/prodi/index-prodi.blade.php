@extends('../layouts/prodi/master-prodi')

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-2 text-gray-800">Welcome, {{ Auth::user()->name }}</h2>
        <p class="text-gray-600 mb-6">Manage scholarship proposals and student submissions efficiently.</p>
        
        {{-- <div class="flex flex-col space-y-4">
            <a href="{{ route('admin.proposals') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Pengajuan Beasiswa</a>
            <a href="{{ route('admin.users') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Kelola Pengguna</a>
            <a href="#" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Kelola Data Fakultas</a>
        </div> --}}
    </div>
</div>
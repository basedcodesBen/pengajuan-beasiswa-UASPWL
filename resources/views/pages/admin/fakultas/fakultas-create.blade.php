@extends('../layouts/admin/master-admin')

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Create New Fakultas</h2>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('fakultas.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="id_fakultas" class="block text-gray-700">ID Fakultas:</label>
                <input type="text" name="id_fakultas" id="id_fakultas" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="nama_fakultas" class="block text-gray-700">Nama Fakultas:</label>
                <input type="text" name="nama_fakultas" id="nama_fakultas" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Create</button>
        </form>
    </div>
</div>
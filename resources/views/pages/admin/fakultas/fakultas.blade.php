@extends('../layouts/admin/master-admin')

<div class="min-h-screen flex flex-col items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Fakultas List</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('fakultas.create') }}" class="mb-4 inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Tambah Fakultas</a>

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">ID Fakultas</th>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">Nama Fakultas</th>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fakultas as $item)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $item->id_fakultas }}</td>
                        <td class="py-2 px-4">{{ $item->nama_fakultas }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('fakultas.edit', $item->id_fakultas) }}" class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>
                            <form action="{{ route('fakultas.destroy', $item->id_fakultas) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah anda yakin ingin menghapus data Fakultas ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                            </form>                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
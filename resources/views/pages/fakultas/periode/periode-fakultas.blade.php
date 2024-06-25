@extends('../layouts/fakultas/master-fakultas')

@section('web-content')
<div class="min-h-screen flex flex-col items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Add New Periode</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('periode.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama_periode" class="block text-gray-700">Nama Periode:</label>
                <input type="text" name="nama_periode" id="nama_periode" class="w-full p-2 border border-gray-300 rounded" value="{{ old('nama_periode') }}">
            </div>
            <div class="mb-4">
                <label for="tanggal_mulai" class="block text-gray-700">Tanggal Mulai:</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="w-full p-2 border border-gray-300 rounded" value="{{ old('tanggal_mulai') }}">
            </div>
            <div class="mb-4">
                <label for="tanggal_selesai" class="block text-gray-700">Tanggal Selesai:</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="w-full p-2 border border-gray-300 rounded" value="{{ old('tanggal_selesai') }}">
            </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Save</button>
                <a href="{{ route('periode.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

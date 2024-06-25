@extends('../layouts/admin/master-admin')

@section('web-content')
<div class="min-h-screen flex flex-col items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Add New Beasiswa</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('beasiswa.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="jenis_beasiswa" class="block text-gray-700">Jenis Beasiswa:</label>
                <input type="text" name="jenis_beasiswa" id="jenis_beasiswa" class="w-full p-2 border border-gray-300 rounded" value="{{ old('jenis_beasiswa') }}">
            </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Save</button>
                <a href="{{ route('beasiswa.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

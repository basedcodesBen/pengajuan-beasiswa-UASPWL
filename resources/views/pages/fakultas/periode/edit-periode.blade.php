@extends('../layouts/fakultas/master-fakultas')

@section('web-content')
<div class="min-h-screen flex flex-col items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Edit Periode</h2>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('periode.update', ['tahun_ajaran' => $tahun_ajaran, 'triwulan' => $triwulan]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="tahun_ajaran" class="block text-gray-700">Tahun Ajaran:</label>
                <input type="number" name="tahun_ajaran" id="tahun_ajaran" class="w-full p-2 border border-gray-300 rounded" value="{{ $tahun_ajaran }}" disabled>
            </div>
            <div class="mb-4">
                <label for="triwulan" class="block text-gray-700">Triwulan:</label>
                <input type="text" name="triwulan" id="triwulan" class="w-full p-2 border border-gray-300 rounded" value="{{ $triwulan }}" disabled>
            </div>
            <div class="mb-4">
                <label for="start_date" class="block text-gray-700">Start Date:</label>
                <input type="date" name="start_date" id="start_date" class="w-full p-2 border border-gray-300 rounded" value="{{ $periodes->first()->start_date }}">
            </div>
            <div class="mb-4">
                <label for="end_date" class="block text-gray-700">End Date:</label>
                <input type="date" name="end_date" id="end_date" class="w-full p-2 border border-gray-300 rounded" value="{{ $periodes->first()->end_date }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Beasiswa:</label>
                @foreach($beasiswas as $beasiswa)
                    <div>
                        <input type="checkbox" name="beasiswas[]" value="{{ $beasiswa->id_beasiswa }}" id="beasiswa_{{ $beasiswa->id_beasiswa }}"
                        @if(in_array($beasiswa->id_beasiswa, $selectedBeasiswas)) checked @endif>
                        <label for="beasiswa_{{ $beasiswa->id_beasiswa }}">{{ $beasiswa->jenis_beasiswa }}</label>
                    </div>
                @endforeach
            </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update</button>
                <a href="{{ route('fakultas.periode.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('../layouts/prodi/master-prodi')

@section('web-content')
<div class="min-h-screen flex flex-col items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Select Beasiswa for Periode {{ $periode_id }}</h2>
        <ul class="list-disc pl-5">
            @foreach($beasiswas as $beasiswa)
                <li class="mb-2">
                    <a href="{{ route('prodi.pengajuan.show', [$periode_id, $beasiswa->id_beasiswa]) }}" class="text-blue-500 hover:underline">
                        {{ $beasiswa->jenis_beasiswa }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
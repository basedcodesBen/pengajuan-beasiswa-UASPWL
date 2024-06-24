@extends('../layouts/prodi/master-prodi')

@section('web-content')
<div class="min-h-screen flex flex-col items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Select Periode</h2>

        <ul class="list-disc pl-5">
            @foreach($periodes as $periode)
                <li class="mb-2">
                    <a href="{{ route('prodi.pengajuan.select-beasiswa', $periode->id_periode) }}" class="text-blue-500 hover:underline">
                        {{ $periode->tahun_ajaran }} - {{ $periode->triwulan }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection


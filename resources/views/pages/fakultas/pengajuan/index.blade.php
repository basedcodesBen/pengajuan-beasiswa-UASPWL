@extends('../layouts/fakultas/master-fakultas')

@section('web-content')
<div class="min-h-screen flex flex-col items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Select Periode</h2>

        @foreach($periodes as $periode)
            <div class="mb-4">
                @foreach($beasiswas as $beasiswa)
                    @if($beasiswa->id_beasiswa == $periode->id_beasiswa)
                        <a href="{{ route('fakultas.pengajuan.show', ['tahun_ajaran' => $periode->tahun_ajaran, 'triwulan' => $periode->triwulan, 'beasiswa_id' => $beasiswa->id_beasiswa]) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            {{ $periode->tahun_ajaran }} - {{ $periode->triwulan }} ({{ $beasiswa->jenis_beasiswa }})
                        </a>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>
</div>
@endsection

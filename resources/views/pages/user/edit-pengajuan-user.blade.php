@extends('../layouts/user/master-user')

<div class="min-h-screen flex flex-col items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mt-10">

        <div class="overflow-x-auto">
            @foreach($beasiswas as $beasiswa)
                <p>Edit Pengajuan {{$beasiswa->jenis_beasiswa}}</p>

                @foreach($pengajuan as $pengajuans)
                <form action="{{ route('update.pengajuan') }}" method="POST" class="mt-5" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="ipk" class="block text-sm font-medium text-gray-700">IPK</label>
                        <input type="text" name="ipk" id="ipk" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="poinporto" class="block text-sm font-medium text-gray-700">Poin Portofolio</label>
                        <input type="number" name="poinporto" id="poinporto" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="dkbs" class="block text-sm font-medium text-gray-700">DKBS</label>
                        <input type="file" name="dkbs" id="dkbs" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @if ($pengajuans->dkbs)
                            <p>Current file: <a href="{{ asset('storage/' . $pengajuans->dkbs) }}" target="_blank">View DKBS File</a></p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label for="surat_rekom" class="block text-sm font-medium text-gray-700">Surat Rekomendasi</label>
                        <input type="file" name="surat_rekom" id="surat_rekom" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @if ($pengajuans->surat_rekom)
                            <p>Current file: <a href="{{ asset('storage/' . $pengajuans->surat_rekom) }}" target="_blank">View Surat Rekomendasi File</a></p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label for="surat_pernyataan" class="block text-sm font-medium text-gray-700">Surat Pernyataan</label>
                        <input type="file" name="surat_pernyataan" id="surat_pernyataan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @if ($pengajuans->surat_pernyataan)
                            <p>Current file: <a href="{{ asset('storage/' . $pengajuans->surat_pernyataan) }}" target="_blank">View Surat Pernyataan File</a></p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <input type="hidden" name="id_beasiswa" id="id_beasiswa" value="{{$beasiswa->id_beasiswa}}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                </form>
                @endforeach
            @endforeach
        </div>
    </div>
</div>




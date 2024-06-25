@extends('../layouts/user/master-user')

<div class="min-h-screen flex flex-col items-center">
    @if(session('error'))
        <div class="alert text-red-700 text-xl mt-5">
            {{ session('error') }}
        </div>
    @endif
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mt-5">

        <div class="overflow-x-auto">
            @foreach($beasiswas as $beasiswa)
                <p>{{$beasiswa->jenis_beasiswa}}</p>


                <form action="{{ route('input.pengajuan') }}" method="POST" class="mt-5" enctype="multipart/form-data">
                    @csrf
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
                    </div>

                    <div class="mb-4">
                        <label for="surat_rekom" class="block text-sm font-medium text-gray-700">Surat Rekomendasi</label>
                        <input type="file" name="surat_rekom" id="surat_rekom" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="surat_pernyataan" class="block text-sm font-medium text-gray-700">Surat Pernyataan</label>
                        <input type="file" name="surat_pernyataan" id="surat_pernyataan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <input type="hidden" name="id_beasiswa" id="id_beasiswa" value="{{$beasiswa->id_beasiswa}}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="flex justify-between ">
                        <div class="text-left mr-10">
                            <p>
                                Note :
                            </p>
                            <p>* File harus PDF</p>
                            <p>* Tidak boleh ada form yang kosong </p>
                        </div>
                        <div class="  items-center mt-4 ">
                            <a href="{{Route('mahasiswa.beasiswa')}}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 mr-5"> Back </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
</div>




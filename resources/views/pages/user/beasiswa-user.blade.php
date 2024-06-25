@extends('../layouts/user/master-user')

<div class="min-h-screen flex flex-col items-center">
    @if(Session::has('confirm-delete'))
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mt-10">
            <div class="text-center mb-4">
                <p class="text-lg font-semibold">Anda yakin ingin menghapus data pengajuan ini ?</p>
                <p class="text-gray-600">{{ Session::get('confirm-delete.jenis_beasiswa') }}</p>
            </div>

            <form action="{{ route('delete.pengajuan', ['id_beasiswa' => Session::get('confirm-delete.id_beasiswa')]) }}" method="POST" class="flex justify-center">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 mr-2">Hapus</button>
                <a href="{{ route('mahasiswa.beasiswa') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Batalkan</a>
            </form>
        </div>
    @endif
    @if(session('error'))
        <div class="alert text-red-700 text-xl mt-5">
            {{ session('error') }}
        </div>
    @endif
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mt-5">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <!-- Table Header -->
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 text-center font-semibold text-gray-700">Jenis Beasiswa</th>
                    <th class="py-2 px-4 text-center font-semibold text-gray-700">Actions</th>
                </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                @foreach($beasiswa as $beasiswas)
                    <tr class="border-b">
                        <td class="py-2 px-4 text-center">{{ $beasiswas->jenis_beasiswa }}</td>
                        <td class="py-2 px-4 flex justify-center items-center space-x-2">
                            <a href="{{route('pengajuan',['id_beasiswa' => $beasiswas->id_beasiswa])}}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Masukkan Data</a>
                            <a href="{{route('edit.pengajuan.beasiswa',['id_beasiswa' => $beasiswas->id_beasiswa])}}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Perbarui Data</a>
                            <a href="{{route('delete.pengajuan.beasiswa',['id_beasiswa' => $beasiswas->id_beasiswa])}}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 ">Hapus Data</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



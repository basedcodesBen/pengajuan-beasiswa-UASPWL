@extends('../layouts/prodi/master-prodi')

@section('web-content')
<div class="min-h-screen flex flex-col items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Pengajuan List for Beasiswa in Periode</h2>

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">User</th>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">Beasiswa</th>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">IPK</th>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">Poin Portofolio</th>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">Documents</th>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengajuans as $pengajuan)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $pengajuan->user->name }}</td>
                        <td class="py-2 px-4">{{ $pengajuan->beasiswa->jenis_beasiswa }}</td>
                        <td class="py-2 px-4">{{ $pengajuan->ipk }}</td>
                        <td class="py-2 px-4">{{ $pengajuan->poin_portofolio }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('prodi.pengajuan.documents', ['id_user' => $pengajuan->id_user, 'id_beasiswa' => $pengajuan->id_beasiswa, 'id_periode' => $pengajuan->id_periode]) }}" class="text-blue-500 hover:underline">View Documents</a>
                        </td>
                        <td class="py-2 px-4">
                            @if (is_null($pengajuan->status_1))
                                <form method="POST" action="{{ route('prodi.pengajuan.approve', ['id_user' => $pengajuan->id_user, 'id_beasiswa' => $pengajuan->id_beasiswa, 'id_periode' => $pengajuan->id_periode]) }}" class="inline-block">
                                    @csrf
                                    <button type="submit" class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('prodi.pengajuan.reject', ['id_user' => $pengajuan->id_user, 'id_beasiswa' => $pengajuan->id_beasiswa, 'id_periode' => $pengajuan->id_periode]) }}" class="inline-block">
                                    @csrf
                                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Reject</button>
                                </form>
                            @else
                                <span class="{{ $pengajuan->status_1 ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $pengajuan->status_1 ? 'Approved' : 'Rejected' }}
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
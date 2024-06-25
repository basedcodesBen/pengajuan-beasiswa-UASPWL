@extends('../layouts/fakultas/master-fakultas')

@section('web-content')
<div class="min-h-screen flex flex-col items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Documents for Pengajuan</h2>

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">Document Type</th>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">File</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengajuanDocs as $document)
                    <tr class="border-b">
                        <td class="py-2 px-4">DKBS</td>
                        <td class="py-2 px-4">
                            <a href="{{ asset('storage/' . $document->dkbs) }}" target="_blank" class="text-blue-500 hover:underline">View DKBS</a>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 px-4">Surat Rekom</td>
                        <td class="py-2 px-4">
                            <a href="{{ asset('storage/' . $document->surat_rekom) }}" target="_blank" class="text-blue-500 hover:underline">View Surat Rekom</a>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2 px-4">Surat Pernyataan</td>
                        <td class="py-2 px-4">
                            <a href="{{ asset('storage/' . $document->surat_pernyataan) }}" target="_blank" class="text-blue-500 hover:underline">View Surat Pernyataan</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

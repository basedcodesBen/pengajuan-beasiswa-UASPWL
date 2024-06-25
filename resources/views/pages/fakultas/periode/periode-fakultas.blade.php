@extends('../layouts/fakultas/master-fakultas')

@section('web-content')
<div class="min-h-screen flex flex-col items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Periode List</h2>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('periode.create') }}" class="mb-4 inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Add New Periode</a>

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">Tahun Ajaran</th>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">Triwulan</th>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">Start Date</th>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">End Date</th>
                    <th class="py-2 px-4 bg-blue-50 text-left text-gray-600 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($periodes as $periode)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $periode->tahun_ajaran }}</td>
                        <td class="py-2 px-4">{{ $periode->triwulan }}</td>
                        <td class="py-2 px-4">{{ $periode->start_date }}</td>
                        <td class="py-2 px-4">{{ $periode->end_date }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('periode.edit', ['tahun_ajaran' => $periode->tahun_ajaran, 'triwulan' => $periode->triwulan]) }}" class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>
                            <form action="{{ route('periode.destroy', ['tahun_ajaran' => $periode->tahun_ajaran, 'triwulan' => $periode->triwulan]) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this periode?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

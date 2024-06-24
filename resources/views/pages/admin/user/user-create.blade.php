@extends('../layouts/admin/master-admin')

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Create New User</h2>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name:</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="nrp" class="block text-gray-700">NRP/NIK:</label>
                <input type="text" name="nrp" id="nrp" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password:</label>
                <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="role" class="block text-gray-700">Role:</label>
                <select name="role" id="role" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="admin">Admin</option>
                    <option value="prodi">Prodi</option>
                    <option value="fakultas">Fakultas</option>
                    <option value="mahasiswa">Mahasiswa</option>
                </select>
            </div>
            <div class="mb-4" id="prodi-field" style="display:none;">
                <label for="id_prodi" class="block text-gray-700">Prodi:</label>
                <select name="id_prodi" id="id_prodi" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Select Prodi</option>
                    @foreach($prodi as $item)
                        <option value="{{ $item->id_prodi }}">{{ $item->nama_prodi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4" id="fakultas-field" style="display:none;">
                <label for="id_fakultas" class="block text-gray-700">Fakultas:</label>
                <select name="id_fakultas" id="id_fakultas" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Select Fakultas</option>
                    @foreach($fakultas as $item)
                        <option value="{{ $item->id_fakultas }}">{{ $item->nama_fakultas }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Create User</button>
        </form>

        <script>
            document.getElementById('role').addEventListener('change', function() {
                var role = this.value;
                
                // Show or hide the fields based on the selected role
                document.getElementById('prodi-field').style.display = (role === 'prodi' || role === 'mahasiswa') ? 'block' : 'none';
                document.getElementById('fakultas-field').style.display = role === 'fakultas' ? 'block' : 'none';
        
                // Enable or disable the fakultas field
                if (role === 'prodi' || role === 'mahasiswa') {
                    document.getElementById('id_fakultas').disabled = true;
                } else {
                    document.getElementById('id_fakultas').disabled = false;
                }
            });
        
            document.getElementById('id_prodi').addEventListener('change', function() {
                var selectedProdi = this.options[this.selectedIndex];
                var idFakultas = selectedProdi.getAttribute('data-id-fakultas');
                var fakultasField = document.getElementById('id_fakultas');
                var roleField = document.getElementById('role');
                var selectedRole = roleField.options[roleField.selectedIndex].value;
        
                // Set the id_fakultas value for prodi and mahasiswa roles
                if (selectedRole === 'prodi' || selectedRole === 'mahasiswa') {
                    fakultasField.value = idFakultas;
                }
            });
        
            // Trigger the change event for initial page load to set correct fields visibility
            document.getElementById('role').dispatchEvent(new Event('change'));
        </script>
    </div>
</div>
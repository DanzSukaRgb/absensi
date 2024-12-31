<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pengguna') }}
        </h2>
    </x-slot>
    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold">Daftar Pengguna</h2>
                <table class="w-full border-collapse border border-gray-300 mt-4">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-2">Nama</th>
                            <th class="border border-gray-300 p-2">User ID</th>
                            <th class="border border-gray-300 p-2">Email</th>
                            <th class="border border-gray-300 p-2">Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="border border-gray-300 p-2">{{ $user->name }}</td>
                                <td class="border border-gray-300 p-2">{{ $user->user_id }}</td>
                                <td class="border border-gray-300 p-2">{{ $user->email }}</td>
                                <td class="border border-gray-300 p-2">{{ $user->role }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-app-layout>


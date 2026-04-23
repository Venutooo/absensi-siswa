<x-app-layout>

<div class="ml-64 p-10 min-h-screen bg-gray-100">

    <h2 class="text-3xl font-bold mb-8 text-gray-800">
        Edit Data Siswa
    </h2>

    <div class="bg-white p-10 rounded-2xl border border-gray-200 shadow max-w-2xl">

        <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-6">
                <label class="block font-semibold mb-2 text-sm text-gray-700">
                    NIS
                </label>

                <input
                    type="number"
                    value="{{ $siswa->nis }}"
                    readonly
                    class="w-full border border-gray-200 bg-gray-100 rounded-lg p-3 text-gray-500 cursor-not-allowed">
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2 text-sm text-gray-700">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="nama"
                    value="{{ $siswa->nama }}"
                    required
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-1 focus:ring-black focus:border-black">
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2 text-sm text-gray-700">
                    Kelas
                </label>

                <select
                    name="kelas"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-1 focus:ring-black focus:border-black">

                    @foreach(['X RPL', 'XI RPL', 'XII RPL'] as $id_kelas)
                    <option value="{{ $id_kelas }}" {{ $siswa->id_kelas == $id_kelas ? 'selected' : '' }}>
                        {{ $id_kelas }}
                    </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2 text-sm text-gray-700">
                    Jenis Kelamin
                </label>

                <select
                    name="gender"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-1 focus:ring-black focus:border-black">

                    <option value="L" {{ $siswa->gender == 'L' ? 'selected' : '' }}>
                        Laki-laki
                    </option>

                    <option value="P" {{ $siswa->gender == 'P' ? 'selected' : '' }}>
                        Perempuan
                    </option>

                </select>
            </div>

            <div class="flex gap-4">

                <button
                    type="submit"
                    class="bg-black text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition">
                    Update Data
                </button>

                <a
                    href="{{ route('siswa.index') }}"
                    class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

</x-app-layout>
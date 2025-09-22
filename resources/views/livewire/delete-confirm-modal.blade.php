<x-modal :title="''" :showClose="false">
    @section('content')
    <div class="mb-4 flex flex-col items-center">
        <img src="{{ asset("assets/icons/warning-icon.svg") }}" alt="Warning Icon" class="mb-4 h-16 w-16">
        <p class="my-4 text-center text-2xl font-semibold text-gray-700">Kamu yakin ingin menghapus makanan ini?</p>
    </div>
    <div class="flex items-center justify-between gap-4">
        <button x-on:click="open = false"
        type="button"
        class="w-1/2 cursor-pointer rounded-full bg-primary-10 px-5 py-2 font-semibold text-gray-300 outline-none hover:bg-gray-400 focus:ring-4 focus:ring-gray-300">
            Kembali
        </button>
        <button type="submit" x-on:click="$wire.$parent.deleteSelected() open = false" class="w-1/2 cursor-pointer rounded-full bg-red-600 px-5 py-2 font-semibold text-white outline-none hover:bg-red-700 focus:ring-4 focus:ring-red-500">
            Hapus
        </button>
    </div>
    @endsection
</x-modal>

<div
    x-data="{ visible: $wire::entangle('visible').live }"
    x-show="visible"
    @hide-toast.window="setTimeout(() => { visible = false }, 3000)"
    :class="{ 'bg-green-500': type === 'success', 'bg-red-500': type === 'danger', 'bg-yellow-500': type === 'warning' }"
    class="fixed bottom-5 left-1/2 z-50 w-fit min-w-72 -translate-x-1/2 transform rounded-full px-4 py-3 font-poppins shadow-md"
    x-cloak
    x-transition:enter="transition duration-300 ease-out"
    x-transition:enter-start="translate-y-2 transform opacity-0"
    x-transition:enter-end="translate-y-0 transform opacity-100"
    x-transition:leave="transition duration-300 ease-in"
    x-transition:leave-start="translate-y-0 transform opacity-100"
    x-transition:leave-end="translate-y-2 transform opacity-0">
    <div class="flex items-center gap-2">
        <img src="{{ asset("assets/icons/cart-filled-icon.svg") }}" class="h-6 w-6" alt="Cart Failed"/>
        <div>
            <p class="whitespace-nowrap font-semibold text-gray-700 text-lg">{{ $message1 }}
            </p>
            @if (true)
                <p class="whitespace-nowrap text-gray-700 text-sm font-medium">{{ $message2 }}</p>
            @endif
        </div>
    </div>

</div>

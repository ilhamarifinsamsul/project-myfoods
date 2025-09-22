<x-modal :title="'Filter'" :showClose="false">
    @section("content")
    <div class="space-y-2 pb-2  pt-4">
        @php
            $foodCategories = $categories->filter(function ($category) {
            return str_contains(strtolower($category->name), 'food');
            });
        @endphp

        @if ($foodCategories->isNotEmpty())
            <div>
                <p class="font-medium text-gray-700">Pilih kategori makanan:</p>
                <div class="mt-2 flex flex-wrap space-x-2">
                    @foreach ($foodCategories as $category)
                        <label x-data="{ checked: {{ in_array($category->id, $selectedCategories) ? 'true' : 'false' }} }"
                            wire:click="category-food-{{ $category->id }}"
                            class="mb-1 whitespace-nowrap rounded-full px-2 py-1.5 text-xs font-medium"
                            :class="checked ? 'bg-blue-500 text-white border-blue-500' : 'bg-white text-gray-700 border-gray-300'">
                            <input type="checkbox" class="hidden"
                            wire:model='selectedCategories'
                            value="{{ $category->id }}"
                            x-on:change="checked = !checked">
                            <span class="text-xs">
                                {{ $category->name }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endif

        @php
            $nonFoodCategories = $categories->filter(function ($category) {
            return ! str_contains(strtolower($category->name), "food");
            });
        @endphp

        @if ($nonFoodCategories->isNotEmpty())
            <div>
                <p class="font-medium text-gray-700">Type F&B</p>
                <div class="mt-2 flex flex-wrap space-x-2">
                    @foreach ($nonFoodCategories as $category)
                        <label x-data="{ checked: {{ in_array($category->id, $selectedCategories) ? 'true' : 'false' }} }"
                            wire:click="category-other-{{ $category->id }}"
                            class="mb-1 whitespace-nowrap rounded-full px-2 py-1.5 text-xs font-medium"
                            :class="checked ? 'bg-blue-500 text-white border-blue-500' : 'bg-white text-gray-700 border-gray-300'">
                            <input type="checkbox" class="hidden"
                            wire:model='selectedCategories'
                            value="{{ $category->id }}"
                            x-on:change="checked = !checked">
                            <span class="text-xs">
                                {{ $category->name }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <div class="flex items-center justify-between">
        <button
            type="button"
            x-on:click="$wire.resetFilter()"
            class="cursor-pointer rounded-full bg-primary-10 px-5 py-2 font-semibold text-primary-60 outline-none hover:bg-primary-20"
            >
            Reset
            </button>
            <button
                x-on:click="$wire.applyFilter()
                open = false"
                type="button"
                class="cursor-pointer rounded-full bg-primary-50 px-5 py-2 font-semibold text-white hover:bg-primary-60"
            >
            <span class="flex items-center gap-1.5">
                Terapkan
            <img
                src="{{ asset("assets/icons/arrow-right-white-icon.svg") }}"
                alt="Terapkan"
                />
            </span>
        </button>

    </div>
    @endsection

</x-modal>

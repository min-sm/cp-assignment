<div>
    <div class="mb-6">
        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity:</label>
        <div class="flex items-center gap-2">
            <input type="number" id="quantity" name="quantity" min="1" value="1"
                max="{{ $product->stock_quantity }}"
                class="w-16 text-center rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                wire:model.live.debounce.500ms="quantity">
            <span class="text-sm text-gray-500">
                (In stock: {{ $product->stock_quantity }})
            </span>
        </div>
        @error('quantity')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Buttons -->
    <div class="flex space-x-4 mb-6">
        <button
            class="flex gap-2 items-center px-6 py-2 rounded-md transition-all focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 {{ $errors->has('quantity') || !auth()->check() ? 'bg-gray-400 cursor-not-allowed' : 'bg-indigo-600 hover:bg-indigo-700 text-white' }}"
            type="button" wire:click="clicked" @if ($errors->has('quantity') || !auth()->check()) disabled @endif>
            Add to Cart
        </button>
    </div>
</div>

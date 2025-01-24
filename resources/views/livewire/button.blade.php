<div>
    <div class="mb-6">
        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" value="1" max="{{ $product->stock_quantity }}"
            class="w-16 text-center rounded-md border-gray-300  shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            wire:model="quantity">
    </div>

    <!-- Buttons -->
    <div class="flex space-x-4 mb-6">
        <button
            class="bg-indigo-600 flex gap-2 items-center text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            type="button" wire:click="clicked">
            Add to Cart
        </button>
    </div>
</div>

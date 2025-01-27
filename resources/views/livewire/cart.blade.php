<div class="font-sans max-w-6xl max-lg:max-w-2xl mx-auto bg-white p-4">
    <div class="grid lg:grid-cols-2 gap-12">
        <div>
            <div class="bg-gray-100 p-6 rounded-md">
                <h2 class="text-2xl font-bold text-gray-800">Your Cart</h2>
                <div class="space-y-4 mt-8">
                    @forelse ($products as $productId => $product)
                        <div class="flex items-center gap-4">
                            <div class="w-24 h-24 shrink-0 bg-white p-2 rounded-md">
                                <img src="{{ $product['image'] }}" class="w-full h-full object-contain"
                                    alt="{{ $product['name'] }}" />
                            </div>

                            <div class="w-full">
                                <h3 class="text-base font-semibold text-gray-800">{{ $product['name'] }}</h3>
                                <h6 class="text-sm text-gray-800 font-bold cursor-pointer mt-0.5">
                                    ${{ $product['price'] }}</h6>

                                <div class="flex gap-4 mt-4">
                                    <!-- Quantity Controls -->
                                    <div class="flex">
                                        <button type="button" wire:click="decreaseQuantity({{ $productId }})"
                                            class="flex items-center justify-center w-6 h-6 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">
                                            -
                                        </button>
                                        <span class="mx-2.5">{{ $product['quantity'] }}</span>
                                        <button type="button" wire:click="increaseQuantity({{ $productId }})"
                                            class="flex items-center justify-center w-6 h-6 border border-gray-300 text-gray-800 text-xs outline-none bg-transparent rounded-md">
                                            +
                                        </button>
                                    </div>

                                    <!-- Remove Button -->
                                    <div class="ml-auto">
                                        <button type="button" wire:click="removeFromCart({{ $productId }})">
                                            <svg class="w-6 h-6 text-red-500 hover:text-red-700" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-300" />
                    @empty
                        <p class="text-gray-500">Your cart is empty.</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-4 flex flex-wrap justify-center gap-4">
                <img src='https://readymadeui.com/images/master.webp' alt="card1" class="w-12 object-contain" />
                <img src='https://readymadeui.com/images/visa.webp' alt="card2" class="w-12 object-contain" />
                <img src='https://readymadeui.com/images/american-express.webp' alt="card3"
                    class="w-12 object-contain" />
            </div>
        </div>

        <form>
            <h2 class="text-2xl font-bold text-gray-800">Payment Details</h2>
            <div class="grid gap-4 mt-8">
                <div>
                    <label class="block text-base text-gray-800 mb-2">Name</label>
                    <input type="text" placeholder="John Doe"
                        class="px-4 py-2.5 bg-transparent text-gray-800 w-full text-sm border border-gray-300 rounded-md focus:border-purple-500 outline-none" />
                </div>

                <div>
                    <label class="block text-base text-gray-800 mb-2">Card Number</label>
                    <div
                        class="flex bg-transparent border border-gray-300 rounded-md focus-within:border-purple-500 overflow-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 ml-3" viewBox="0 0 32 20">
                            <circle cx="10" cy="10" r="10" fill="#f93232" data-original="#f93232" />
                            <path fill="#fed049"
                                d="M22 0c-2.246 0-4.312.75-5.98 2H16v.014c-.396.298-.76.634-1.107.986h2.214c.308.313.592.648.855 1H14.03a9.932 9.932 0 0 0-.667 1h5.264c.188.324.365.654.518 1h-6.291a9.833 9.833 0 0 0-.377 1h7.044c.104.326.186.661.258 1h-7.563c-.067.328-.123.66-.157 1h7.881c.039.328.06.661.06 1h-8c0 .339.027.67.06 1h7.882c-.038.339-.093.672-.162 1h-7.563c.069.341.158.673.261 1h7.044a9.833 9.833 0 0 1-.377 1h-6.291c.151.344.321.678.509 1h5.264a9.783 9.783 0 0 1-.669 1H14.03c.266.352.553.687.862 1h2.215a10.05 10.05 0 0 1-1.107.986A9.937 9.937 0 0 0 22 20c5.523 0 10-4.478 10-10S27.523 0 22 0z"
                                class="hovered-path" data-original="#fed049" />
                        </svg>
                        <input type="number" placeholder="xxxx xxxx xxxx"
                            class="px-4 py-2.5 bg-transparent text-gray-800 w-full text-sm outline-none border-none !ring-0" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-base text-gray-800 mb-2">Expiry Date</label>
                        <input type="number" placeholder="08/27"
                            class="px-4 py-2.5 bg-transparent text-gray-800 w-full text-sm border border-gray-300 rounded-md focus:border-purple-500 outline-none" />
                    </div>

                    <div>
                        <label class="block text-base text-gray-800 mb-2">CVV</label>
                        <input type="number" placeholder="XXX"
                            class="px-4 py-2.5 bg-transparent text-gray-800 w-full text-sm border border-gray-300 rounded-md focus:border-purple-500 outline-none" />
                    </div>
                </div>
            </div>

            <ul class="text-gray-800 mt-8 space-y-4">
                <li class="flex flex-wrap gap-4 text-sm">Subtotal <span
                        class="ml-auto font-bold">${{ array_sum(array_map(fn($product) => $product['price'] * $product['quantity'], $products)) }}</span>
                </li>
                <li class="flex flex-wrap gap-4 text-sm">Discount <span class="ml-auto font-bold">$0.00</span></li>
                <li class="flex flex-wrap gap-4 text-sm">Tax <span class="ml-auto font-bold">$4.00</span></li>
                <hr class="border-gray-300" />
                <li class="flex flex-wrap gap-4 text-sm font-bold">Total <span
                        class="ml-auto">${{ array_sum(array_map(fn($product) => $product['price'] * $product['quantity'], $products)) + 4 }}</span>
                </li>
            </ul>

            <button type="button"
                class="mt-8 text-sm px-4 py-2.5 w-full font-semibold tracking-wide bg-purple-600 hover:bg-purple-700 text-white rounded-md">Make
                Payment</button>
        </form>
    </div>
</div>

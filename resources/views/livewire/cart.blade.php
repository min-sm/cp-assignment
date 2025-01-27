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

        <form action="{{ route('checkout.process') }}" method="POST" x-data="{ paymentMethod: 'cash_on_delivery' }">
            @csrf
            <h2 class="text-2xl font-bold text-gray-800">Payment Details</h2>
            <div class="grid gap-4 mt-8">
                <div>
                    <label class="block text-base text-gray-800 mb-2">Name</label>
                    <input type="text" name="name" id="name" placeholder="John Doe"
                        class="px-4 py-2.5 bg-transparent text-gray-800 w-full text-sm border border-gray-300 rounded-md focus:border-purple-500 outline-none" />
                </div>

                <div>
                    <label for="address" class="block text-base text-gray-800 mb-2">Your Address</label>
                    <textarea id="address" name="address" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write your address here..."></textarea>
                </div>

                <div>
                    <label class="block text-base text-gray-800 mb-2">Payment Method</label>
                    <div class="flex items-center gap-4">
                        <label class="flex items-center">
                            <input type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery"
                                x-model="paymentMethod" class="form-radio">
                            <span class="ml-2">Cash on Delivery</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="payment_method" id="kbzpay" value="kbzpay"
                                x-model="paymentMethod" class="form-radio">
                            <span class="ml-2">KBZPay</span>
                        </label>
                    </div>
                </div>

                <div x-show="paymentMethod === 'kbzpay'" x-cloak>
                    <label class="block text-base text-gray-800 mb-2">KBZPay Number</label>
                    <div
                        class="flex bg-transparent border border-gray-300 rounded-md focus-within:border-purple-500 overflow-hidden">
                        <img src="{{ asset('img/common/kbzpay.png') }}" alt="kbzpay logo" class="h-10">
                        <input type="tel" name="kbzpay_number" id="kbzpay_number" placeholder="+959 xxxx xxxx"
                            pattern="\+959\d{5,8}"
                            class="px-4 py-2.5 bg-transparent text-gray-800 w-full text-sm outline-none border-none !ring-0" />
                    </div>
                </div>
            </div>

            <ul class="text-gray-800 mt-8 space-y-4">
                <li class="flex flex-wrap gap-4 text-sm">Subtotal <span
                        class="ml-auto font-bold">${{ array_sum(array_map(fn($product) => $product['price'] * $product['quantity'], $products)) }}</span>
                </li>
                <li class="flex flex-wrap gap-4 text-sm">Discount <span class="ml-auto font-bold">$0.00</span></li>
                <li class="flex flex-wrap gap-4 text-sm">Delivery fee <span class="ml-auto font-bold">$4.00</span></li>
                <hr class="border-gray-300" />
                <li class="flex flex-wrap gap-4 text-sm font-bold">Total <span
                        class="ml-auto">${{ array_sum(array_map(fn($product) => $product['price'] * $product['quantity'], $products)) + 4 }}</span>
                </li>
            </ul>

            <input type="hidden" name="total"
                value="{{ array_sum(array_map(fn($product) => $product['price'] * $product['quantity'], $products)) + 4 }}">

            <button type="submit"
                class="mt-8 text-sm px-4 py-2.5 w-full font-semibold tracking-wide bg-purple-600 hover:bg-purple-700 text-white rounded-md">Make
                Payment</button>
        </form>
    </div>
</div>

@extends('admin.layouts.default')

@section('title', 'All users')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Customers
    </h2>
    @if (session('success'))
        <x-alert type="success" message="{{ session('success') }}" />
    @endif
    @if (session('error'))
        <x-alert type="error" message="{{ session('error') }}" />
    @endif
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Joined date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $customer->name }}
                        </th>
                        <td class="px-6 py-4 line-clamp-1">
                            {{ $customer->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $customer->phone_number }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Str::words($customer->address, 5, '...') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $customer->created_at->diffForHumans() }}
                        </td>
                        {{-- <td class="px-6 py-4 whitespace-nowrap">
                            <ul class="flex flex-col gap-2 list-none">
                                @foreach ($brand->series as $series)
                                    <li
                                        class="flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-sm dark:text-white dark:bg-gray-800 whitespace-nowrap">
                                        <span class="mr-2">•</span> <!-- Custom bullet point -->
                                        {{ $series->name }}
                                        {{ $series->launch_year ? '| ' . $series->launch_year : '' }}
                                    </li>
                                @endforeach
                            </ul>
                        </td> --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                {{-- <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    Edit
                                </a> --}}
                                <div x-data="{ modalIsOpen: false }">
                                    <!-- Delete Trigger Button -->
                                    <button x-on:click="modalIsOpen = true" type="button"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                        Deactivate
                                    </button>

                                    <!-- Modal Overlay -->
                                    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
                                        x-trap.inert.noscroll="modalIsOpen" x-on:keydown.esc.window="modalIsOpen = false"
                                        x-on:click.self="modalIsOpen = false"
                                        class="fixed inset-0 z-30 flex w-full items-start justify-center bg-black/20 p-4 pb-8 backdrop-blur-md lg:p-8"
                                        role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle">

                                        <!-- Modal Dialog -->
                                        <div x-show="modalIsOpen"
                                            x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                            x-transition:enter-start="opacity-0 scale-50"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-sm border border-red-300 bg-white text-red-600 dark:border-red-700 dark:bg-neutral-900 dark:text-red-300">

                                            <!-- Dialog Header -->
                                            <div
                                                class="flex items-center justify-between border-b border-red-300 bg-red-50/60 p-4 dark:border-red-700 dark:bg-red-950/20">
                                                <h3 id="deleteModalTitle"
                                                    class="font-semibold tracking-wide text-red-900 dark:text-red-100">
                                                    Confirm Deactivation
                                                </h3>
                                                <button x-on:click="modalIsOpen = false" aria-label="close modal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        aria-hidden="true" stroke="currentColor" fill="none"
                                                        stroke-width="1.4" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Dialog Body -->
                                            <div class="px-4 py-8">
                                                <p>Are you sure you want to deactivate this customer? This action cannot
                                                    be undone.</p>
                                            </div>

                                            <!-- Dialog Footer -->
                                            <div
                                                class="flex flex-col-reverse justify-between gap-2 border-t border-red-300 bg-red-50/60 p-4 dark:border-red-700 dark:bg-red-950/20 sm:flex-row sm:items-center md:justify-end">
                                                <button x-on:click="modalIsOpen = false" type="button"
                                                    class="whitespace-nowrap rounded-sm px-4 py-2 text-center text-sm font-medium tracking-wide text-red-600 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 active:opacity-100 active:outline-offset-0 dark:text-red-300 dark:focus-visible:outline-red-600">
                                                    No, Cancel
                                                </button>
                                                <form method="POST"
                                                    action="{{ route('admin.users.destroy', $customer->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="whitespace-nowrap rounded-sm bg-red-600 border border-red-600 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:bg-red-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 active:bg-red-600 active:outline-offset-0">
                                                        Yes, Deactivate
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="my-3">
            {{ $customers->links() }}
        </div>
    </div>

    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Admins
    </h2>
    <div class="flex justify-end items-end mb-4 space-x-4">
        <x-button link="{{ route('admin.create') }}" label="Create new admin" />
    </div>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Joined date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $admin->name }}
                        </th>
                        <td class="px-6 py-4 line-clamp-1">
                            {{ $admin->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $admin->phone_number }}
                        </td>
                        <td class="px-6 py-4">
                            {{ Str::words($admin->address, 5, '...') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $admin->created_at->diffForHumans() }}
                        </td>
                        {{-- <td class="px-6 py-4 whitespace-nowrap">
                            <ul class="flex flex-col gap-2 list-none">
                                @foreach ($brand->series as $series)
                                    <li
                                        class="flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-sm dark:text-white dark:bg-gray-800 whitespace-nowrap">
                                        <span class="mr-2">•</span> <!-- Custom bullet point -->
                                        {{ $series->name }}
                                        {{ $series->launch_year ? '| ' . $series->launch_year : '' }}
                                    </li>
                                @endforeach
                            </ul>
                        </td> --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                {{-- @dd(auth()->user()->id) --}}
                                @if ($admin->id == auth()->user()->id)
                                    <a href="{{ route('admin.edit') }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                        Change password
                                    </a>
                                    <div x-data="{ modalIsOpen: false }">
                                        <!-- Delete Trigger Button -->
                                        <button x-on:click="modalIsOpen = true" type="button"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                            Deactivate
                                        </button>

                                        <!-- Modal Overlay -->
                                        <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms
                                            x-trap.inert.noscroll="modalIsOpen"
                                            x-on:keydown.esc.window="modalIsOpen = false"
                                            x-on:click.self="modalIsOpen = false"
                                            class="fixed inset-0 z-30 flex w-full items-start justify-center bg-black/20 p-4 pb-8 backdrop-blur-md lg:p-8"
                                            role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle">

                                            <!-- Modal Dialog -->
                                            <div x-show="modalIsOpen"
                                                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                                                x-transition:enter-start="opacity-0 scale-50"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-sm border border-red-300 bg-white text-red-600 dark:border-red-700 dark:bg-neutral-900 dark:text-red-300">

                                                <!-- Dialog Header -->
                                                <div
                                                    class="flex items-center justify-between border-b border-red-300 bg-red-50/60 p-4 dark:border-red-700 dark:bg-red-950/20">
                                                    <h3 id="deleteModalTitle"
                                                        class="font-semibold tracking-wide text-red-900 dark:text-red-100">
                                                        Confirm Deactivation
                                                    </h3>
                                                    <button x-on:click="modalIsOpen = false" aria-label="close modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            aria-hidden="true" stroke="currentColor" fill="none"
                                                            stroke-width="1.4" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>

                                                <!-- Dialog Body -->
                                                <div class="px-4 py-8">
                                                    <p>Are you sure you want to deactivate this admin? This action cannot
                                                        be undone.</p>
                                                </div>

                                                <!-- Dialog Footer -->
                                                <div
                                                    class="flex flex-col-reverse justify-between gap-2 border-t border-red-300 bg-red-50/60 p-4 dark:border-red-700 dark:bg-red-950/20 sm:flex-row sm:items-center md:justify-end">
                                                    <button x-on:click="modalIsOpen = false" type="button"
                                                        class="whitespace-nowrap rounded-sm px-4 py-2 text-center text-sm font-medium tracking-wide text-red-600 transition hover:opacity-75 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 active:opacity-100 active:outline-offset-0 dark:text-red-300 dark:focus-visible:outline-red-600">
                                                        No, Cancel
                                                    </button>
                                                    <form method="POST"
                                                        action="{{ route('admin.users.destroy', $admin->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="whitespace-nowrap rounded-sm bg-red-600 border border-red-600 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:bg-red-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 active:bg-red-600 active:outline-offset-0">
                                                            Yes, Deactivate
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

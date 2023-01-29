<template>
    <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
        <div class="px-10 max-w-xl">
            <h2 class="text-2xl text-white font-semibold"><slot name="name" /></h2>
            <button class="flex items-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                <span><slot name="single" /></span>
            </button>
        </div>
    </div>
</template>

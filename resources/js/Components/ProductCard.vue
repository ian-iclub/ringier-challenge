<template>
    <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url('https://images.unsplash.com/photo-1577655197620-704858b270ac?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1280&q=144')">
        <button class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
            <slot name="single" />
        </button>
    </div>
    <div class="px-5 py-3">
        <h3 class="text-gray-700 normal-case"><slot name="title"/></h3>
        <span class="text-gray-500 mt-2"><slot name="price"/></span>
    </div>
</template>

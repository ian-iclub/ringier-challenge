<script setup>
    import {computed} from "vue";

    const props = defineProps({
        backurl: {
            type: String,
        }
    })

    const backgroundUrl = computed(() =>{
        return `background-image : url(${props.backurl})`
    })
</script>

<template>
    <div class="flex items-end justify-end h-56 w-full bg-cover" :style="backgroundUrl">
        <button class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
            <slot name="single" />
        </button>
    </div>
    <div class="px-5 py-3">
        <h3 class="text-gray-700 normal-case"><slot name="title"/></h3>
        <span class="text-gray-500 mt-2"><slot name="price"/></span>
    </div>
</template>

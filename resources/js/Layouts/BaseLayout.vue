<script setup>
    import { Head } from '@inertiajs/vue3';
    import Navbar from "@/Components/Navbar.vue";
    // import Footer from "@/Components/Footer.vue";

    defineProps({
        title: String,
    });

    const emit = defineEmits(['search'])

    function getSearch(value) {
        emit('search', value)
    }

</script>

<template>
    <div>
        <Head :title="title" />

        <Navbar @search="getSearch"/>

        <main class="my-8">
            <slot  />
        </main>

<!--        <Footer />-->
    </div>
</template>

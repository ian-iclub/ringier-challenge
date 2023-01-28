<script setup>
    import { Head } from '@inertiajs/vue3';
    import Navbar from "@/Components/Navbar.vue";
    import Footer from "@/Components/Footer.vue";

    defineProps({
        title: String,
    });
</script>

<template>
    <div>
        <Head :title="title" />

        <Navbar />

        <main class="my-8">
            <slot name="content" />
        </main>

        <Footer />
    </div>
</template>

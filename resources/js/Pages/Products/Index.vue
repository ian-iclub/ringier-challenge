<script setup>
    import { ref } from "vue";
    import BaseLayout from "@/Layouts/BaseLayout.vue";
    import ProductListing from "@/Components/ProductListing.vue";
    import Banner from "@/Components/Banner.vue";

    const searchResult = ref('');

    const props = defineProps({
        categories: {
            type: Array,
            default: () => [],
        },
        products: {
            type: Array,
            default: () => [],
        },
    });

    function getSearch(value){
        searchResult.value = value;
    }

</script>

<template>
    <Banner />
    <BaseLayout title="Index" @search="getSearch">
        <div class="container mx-auto px-6">

            <!-- Products -->
            <ProductListing :products="props.products" :search="searchResult" />

        </div>
    </BaseLayout>

</template>

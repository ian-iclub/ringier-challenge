<script setup>
    import {computed, ref} from "vue";
    import { Link } from '@inertiajs/vue3';
    import BaseLayout from "@/Layouts/BaseLayout.vue";
    import Card from "@/Components/Card.vue";
    import ProductListing from "@/Components/ProductListing.vue";

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

    function getBackgroundImageCategory(category) {
        return `background-image : url(${category.image})`
    }

    function getSearch(value){
        searchResult.value = value;
    }

    const filteredCategories = computed(() =>{
        return props.categories.filter((category) =>{
            return category.name.toLowerCase().includes(searchResult.value.toLowerCase())
        })
    })

</script>

<template>
    <BaseLayout title="Index" @search="getSearch">
        <div class="container mx-auto px-6">

            <!-- Categories -->
            <div class="mt-4">
                <h3 class="text-gray-600 text-2xl font-medium">Categories</h3>
                <div class="grid gap-6 lg:grid-cols-2 sm:grid-cols-1 mt-6">
                    <div v-for="category in filteredCategories" :key="category.id"  class="w-full mx-auto h-64 rounded-md overflow-hidden bg-cover bg-center" :style='getBackgroundImageCategory(category)'>
                        <Card>
                            <template #name>
                                {{ category.name }}
                            </template>
                            <template #single>
                                <Link :href="route('products.index', {'category' : category.id})">
                                    View All
                                </Link>
                            </template>
                        </Card>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <ProductListing :products="props.products" :search="searchResult" />

        </div>
    </BaseLayout>

</template>

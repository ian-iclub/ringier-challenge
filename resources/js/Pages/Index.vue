<script setup>
    import { Link } from '@inertiajs/vue3';
    import {computed, ref} from "vue";
    import BaseLayout from "@/Layouts/BaseLayout.vue";
    import Card from "@/Components/Card.vue";
    import ProductCard from "@/Components/ProductCard.vue";

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
        button_title: String
    });

    function getBackgroundImage(category) {
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

    const filteredProducts = computed(() =>{
        return props.products.filter((product) =>{
            return product.title.toLowerCase().includes(searchResult.value.toLowerCase())
        })
    })

</script>

<template>
    <BaseLayout title="Index" @search="getSearch">
        <div class="container mx-auto px-6">

            <!-- Categories -->
            <div class="mt-4">
                <h3 class="text-gray-600 text-2xl font-medium">Categories</h3>
                <div class="grid gap-6 grid-cols-2 mt-6">
                    <div v-for="category in filteredCategories" :key="category.id"  class="w-full mx-auto h-64 rounded-md overflow-hidden bg-cover bg-center" :style='getBackgroundImage(category)'>
                        <Card>
                            <template #name>
                                {{ category.name }}
                            </template>
                            <template #single>
                                Filter
                            </template>
                        </Card>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="mt-16">
                <h3 class="text-gray-600 text-2xl font-medium">Products</h3>
                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                    <div v-for="product in filteredProducts" :key="product.id" class="w-full max-w-sm mx-auto rounded-md shadow-lg overflow-hidden">
                        <ProductCard :style='getBackgroundImage(product.category)'>
                            <template #single>
                                <Link :href="route('products.show', product)">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </Link>
                            </template>
                            <template #title>
                                {{ product.title.slice(0, 15) }} ...
                            </template>
                            <template #price>
                                {{ product.currency.name }} {{ product.price.toLocaleString() }}
                            </template>
                        </ProductCard>
                    </div>
                </div>
            </div>

        </div>
    </BaseLayout>

</template>

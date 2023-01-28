<script setup>
    import { Link } from '@inertiajs/vue3';
    import BaseLayout from "@/Layouts/BaseLayout.vue";
    import Card from "@/Components/Card.vue";
    import {computed, ref} from "vue";

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

    function getBackgroundImage(product) {
        return `background-image : url(${product.category.image})`
    }

    function getSearch(value){
        searchResult.value = value;
    }

    const filteredProducts = computed(() =>{
        return props.products.filter((product) =>{
            return product.title.toLowerCase().includes(searchResult.value.toLowerCase()) || product.category.name.toLowerCase().includes(searchResult.value.toLowerCase())
        })
    })

</script>

<template>
    <BaseLayout title="Index" @search="getSearch">
        <div class="container mx-auto px-6">
            <div class="mt-16">
                <h3 class="text-gray-600 text-2xl font-medium">Products</h3>
                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                    <div v-for="product in filteredProducts" :key="product.id"  class="w-full max-w-sm mx-auto h-64 rounded-md overflow-hidden bg-cover bg-center" :style='getBackgroundImage(product)'>
                        <Card>
                            <template #name>
                                {{ product.title }}
                            </template>
                            <template #single>
                                <Link :href="route('products.show', product.id)" >
                                    Show
                                </Link>
                            </template>
                        </Card>
                    </div>
                </div>
            </div>

        </div>
    </BaseLayout>

</template>

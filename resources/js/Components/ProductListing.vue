<script setup>
    import { Link } from '@inertiajs/vue3';
    import { computed } from "vue";
    import ProductCard from "@/Components/ProductCard.vue";

    const props = defineProps({
        products: {
            type: Array,
            default: () => [],
        },
        search: {
            type: String,
            default: () => '',
        },
    });

    function getBackgroundImage(product) {
        return product.media[0]?.original_url ?? product.category.image
    }

    const filteredProducts = computed(() =>{
        return props.products.filter((product) =>{
            return product.title.toLowerCase().includes(props.search.toLowerCase()) || product.category.name.toLowerCase().includes(props.search.toLowerCase())
        })
    })

</script>

<template>
    <div class="mt-16">
        <h3 class="text-gray-600 text-2xl font-medium">Products</h3>
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
            <div v-for="product in filteredProducts" :key="product.id" class="w-full max-w-sm mx-auto rounded-md shadow-lg overflow-hidden">
                <ProductCard :backurl='getBackgroundImage(product)'>
                    <template #single>
                        <Link :href="route('products.show', product)">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 16 16" >
                                <path fill="#fff" d="M8 3c-3.489 0-6.514 2.032-8 5 1.486 2.968 4.511 5 8 5s6.514-2.032 8-5c-1.486-2.968-4.511-5-8-5zM11.945 5.652c0.94 0.6 1.737 1.403 2.335 2.348-0.598 0.946-1.395 1.749-2.335 2.348-1.181 0.753-2.545 1.152-3.944 1.152s-2.763-0.398-3.945-1.152c-0.94-0.6-1.737-1.403-2.335-2.348 0.598-0.946 1.395-1.749 2.335-2.348 0.061-0.039 0.123-0.077 0.185-0.114-0.156 0.427-0.241 0.888-0.241 1.369 0 2.209 1.791 4 4 4s4-1.791 4-4c0-0.481-0.085-0.942-0.241-1.369 0.062 0.037 0.124 0.075 0.185 0.114v0zM8 6.5c0 0.828-0.672 1.5-1.5 1.5s-1.5-0.672-1.5-1.5 0.672-1.5 1.5-1.5 1.5 0.672 1.5 1.5z"></path>
                            </svg>
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
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
    import BaseLayout from "@/Layouts/BaseLayout.vue";
    import ProductCard from "@/Components/ProductCard.vue";
    import moment from 'moment';

    defineProps({
        product: {
            type: Object
        },
        category_products: {
            type: Object
        },
    });

    function getBackgroundImage(product) {
        return product.media[0]?.original_url ?? product.category.image
    }
</script>

<template>
    <BaseLayout title="Show">
        <div class="container mx-auto px-6">
            <div class="md:flex md:items-center">
                <div class="w-full h-64 md:w-1/2 lg:h-96">
                    <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" :src="getBackgroundImage(product)" alt="Nike Air">
                </div>
                <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
                    <h3 class="text-gray-700 normal-case font-bold text-lg">{{ product.title }}</h3>
                    <span class="text-gray-500 mt-3">{{ product.currency.name }} {{  product.price.toLocaleString() }}</span>
                    <h6 class="mt-4 text-sm">Date Posted: {{ moment(product.date_online).format('Do MMMM YYYY') }}</h6>

                    <hr class="my-3">
                    <div class="mt-2">
                        <label class="text-gray-700 text-sm" for="count">Category:</label>
                        <div class="flex items-center mt-1">
                            <span class="text-gray-700 text-lg">{{ product.category.name }}</span>
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="mt-2">
                        <label class="text-gray-700 text-sm" for="count">Description:</label>
                        <div class="flex items-center mt-1">
                            <span class="text-gray-700 text-lg">{{ product.description }}</span>
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="mt-2">
                        <label class="text-gray-700 text-sm" for="count">Contact owner:</label>
                        <div class="flex-col items-center mt-1">
                            <a :href="'mailto:' + product.user.email" target="_blank">
                                <span class="text-gray-700 text-sm">Email: {{ product.user.email }}</span>
                            </a>
                        </div>
                        <div class="flex-col items-center mt-1">
                            <span class="text-gray-700 text-sm">Phone: {{ product.user.phone }}</span>
                        </div>
                    </div>

                    <hr class="my-3">
                    <div class="mt-2">
                        <label class="text-gray-700 text-sm" for="count">Count:</label>
                        <div class="flex items-center mt-1">
                            <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                            <span class="text-gray-700 text-lg mx-2">1</span>
                            <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center mt-6">
                        <button class="px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500">Order Now</button>
                        <button class="mx-2 text-gray-600 border rounded-md p-2 hover:bg-gray-200 focus:outline-none">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-16">
                <h3 class="text-gray-600 text-2xl font-medium">Similar products in the same category</h3>
                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                    <div v-for="product in category_products" :key="product.id" class="w-full max-w-sm mx-auto rounded-md shadow-lg overflow-hidden">
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
        </div>
    </BaseLayout>

</template>

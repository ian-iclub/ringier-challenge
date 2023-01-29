<script setup>
    import { useForm } from '@inertiajs/vue3';
    import BaseLayout from "@/Layouts/BaseLayout.vue";
    import Banner from "@/Components/Banner.vue";

    const props = defineProps({
        categories: {
            type: Array,
            default: () => [],
        },
        currencies: {
            type: Array,
            default: () => [],
        },
        errors: {
            type: Object,
            default: () => ({}),
        },
    });

    const form = useForm({
        image: '',
        title: '',
        description: '',
        currency: '',
        price: '',
        category: '',
    });

    const submit = () => {
        form.post(route('products.store'));
    };


</script>

<template>
    <Banner />
    <BaseLayout title="Create">
        <div class="container mx-auto px-6">

            <div class="mt-4">
                <h3 class="text-gray-600 text-2xl font-medium">Post a Product</h3>
                <form class="mt-8 lg:w-full" @submit.prevent="submit">
                    <div class="mt-8">
                        <h4 class="text-sm text-gray-500 font-medium">Image</h4>
                        <div class="mt-6 flex">
                            <label class="block flex-1">
                                <input id="image" name="image" type="file" @input="form.image = $event.target.files[0]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 mt-1">
                            </label>
                        </div>
                        <div v-if="errors.image" class="text-sm text-red-600">
                            {{ errors.image }}
                        </div>
                    </div>
                    <div class="mt-8">
                        <h4 class="text-sm text-gray-500 font-medium">Title</h4>
                        <div class="mt-6 flex">
                            <label class="block flex-1">
                                <input id="title" name="title" v-model="form.title" type="text" placeholder="Product name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 mt-1">
                            </label>
                        </div>
                        <div v-if="errors.title" class="text-sm text-red-600">
                            {{ errors.title }}
                        </div>
                    </div>
                    <div class="mt-8">
                        <h4 class="text-sm text-gray-500 font-medium">Description</h4>
                        <div class="mt-6 flex">
                            <label class="block flex-1">
                                <input id="description" name="description" v-model="form.description" type="text" placeholder="Description" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 mt-1"  required>
                            </label>
                        </div>
                        <div v-if="errors.description" class="text-sm text-red-600">
                            {{ errors.description }}
                        </div>
                    </div>
                    <div class="mt-8">
                        <h4 class="text-sm text-gray-500 font-medium">Currency & Price</h4>
                        <div class="mt-6 flex">
                            <label class="block w-3/12">
                                <select id="currency" name="currency" v-model="form.currency" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 mt-1" required>
                                    <option v-for="currency in currencies" :value="currency.id">
                                        {{ currency.name }}
                                    </option>
                                </select>
                            </label>
                            <label class="block flex-1 ml-3">
                                <input id="price" name="price" v-model="form.price" type="number" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 mt-1" placeholder="Price" required>
                            </label>
                        </div>
                        <div v-if="errors.currency" class="text-sm text-red-600">
                            {{ errors.currency }}
                        </div>
                        <div v-if="errors.price" class="text-sm text-red-600">
                            {{ errors.price }}
                        </div>
                    </div>
                    <div class="mt-8">
                        <h4 class="text-sm text-gray-500 font-medium">Category</h4>
                        <div class="mt-6 flex">
                            <label class="block flex-1">
                                <select name="category" id="category" v-model="form.category" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 mt-1" required>
                                    <option v-for="category in categories" :value="category.id">
                                        {{ category.name }}
                                    </option>
                                </select>
                            </label>
                        </div>
                        <div v-if="errors.category" class="text-sm text-red-600">
                            {{ errors.category }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-8">
                        <button class="flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            <span>Submit</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </BaseLayout>

</template>























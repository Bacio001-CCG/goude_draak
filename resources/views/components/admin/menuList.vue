<script setup>
import { defineProps, ref, computed } from "vue";

const search = ref("");
const searchField = ref("");

const props = defineProps({
    categories: Array,
});

const filteredCategories = computed(() => {
    if (!search.value) {
        return props.categories;
    }

    return props.categories.flatMap((category) => {
        // Filter products in category
        const matchingProducts = category.products.filter((product) => {
            return product.name
                .toLowerCase()
                .includes(search.value.toLowerCase());
        });

        // If any products match return with those products
        if (matchingProducts.length > 0) {
            return {
                ...category,
                products: matchingProducts,
            };
        }

        // If not return empty array
        return [];
    });
});
</script>

<template>
    <div class="w-[80%] mx-auto flex flex-col gap-5">
        <div class="w-full relative">
            <div class="flex flex-col gap-1">
                <label for="search" class="text-sm">Product Zoeken</label>
                <input
                    type="text"
                    name="search"
                    v-model="search"
                    class="w-[15rem] border rounded-lg"
                />
            </div>

            <a
                class="absolute top-1/2 -translate-y-1/2 right-0 bg-blue-500 text-white px-5 py-1 rounded-lg hover:bg-blue-500/50"
                href="menu/create"
            >
                <i class="fa-solid fa-plus mr-1"></i> Nieuwe
            </a>
        </div>

        <ul
            class="mx-auto bg-white flex flex-col gap-5 rounded-lg overflow-hidden w-full"
        >
            <div class="grid grid-cols-4 bg-gray-200 p-2 text-center">
                <span>Id</span>
                <span>Weergave Nummer</span>
                <span>Naam</span>
                <span>Prijs</span>
            </div>
            <a v-for="category in filteredCategories" class="px-3">
                <h1 class="font-bold text-center bg-gray-50">
                    {{ category.name }}
                </h1>
                <ul class="flex flex-col mt-5">
                    <a
                        v-for="product in category.products"
                        class="gap-5 w-full grid grid-cols-4 text-center hover:bg-gray-100 cursor-pointer py-0.5"
                        :href="'menu/' + product.id + '/edit'"
                    >
                        <span>#{{ product.id }}</span>
                        <span>{{ product.display_number }}</span>
                        <span>{{ product.name }}</span>
                        <span>{{ product.price }}</span>
                    </a>
                </ul>
            </a>
        </ul>
    </div>
</template>

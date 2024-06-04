<script setup>
import { defineProps, defineEmits, ref, computed } from "vue";
import axios from "axios";
const search = ref("");
const searchField = ref("name");
const filter = ref("");

const props = defineProps({
    checkoutid: String,
    categories: Array,
    typeoforder: String,
});

const addProduct = async (product) => {
    try {
        let response = await axios.post(`/checkout-add/${props.checkoutid}`, [
            product.id,
            props.checkoutid,
        ]);

        await dispatchEvent(
            new CustomEvent("product-added", { detail: response.data })
        );
    } catch (error) {
        console.error(error);
    }
};

const filteredCategories = computed(() => {
    const pickupOrder = props.typeoforder == "pickup" ? 1 : 0;

    let pickupCategories = props.categories.filter(
        (category) => category.is_pickup == pickupOrder
    );

    if (!search.value && !filter.value) {
        return pickupCategories;
    }

    return pickupCategories.flatMap((category) => {
        if (filter.value != "" && filter.value != category.id) return [];

        // Filter products in category
        const matchingProducts = category.products.filter((product) => {
            if (searchField.value == "name")
                return product.name
                    .toLowerCase()
                    .includes(search.value.toLowerCase());
            else
                return product.display_number
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
    <div class="flex flex-col w-full gap-5">
        <h1>Producten</h1>

        <div class="flex gap-5">
            <div class="flex flex-col gap-1">
                <label for="search" class="text-sm">Zoeken</label>
                <input
                    type="text"
                    name="search"
                    v-model="search"
                    class="w-[15rem] border rounded-lg"
                />
            </div>

            <div class="flex flex-col gap-1">
                <label for="search" class="text-sm">Zoek Veld</label>
                <select
                    v-model="searchField"
                    class="w-[15rem] border rounded-lg"
                >
                    <option value="name">Naam</option>
                    <option value="display_number">Nummer</option>
                </select>
            </div>

            <div class="flex flex-col gap-1">
                <label for="filter" class="text-sm">Categorie</label>
                <select v-model="filter" class="w-[15rem] border rounded-lg">
                    <option value="">Alle</option>
                    <option
                        v-for="category in props.categories"
                        v-bind:value="category.id"
                    >
                        {{ category.name }}
                    </option>
                </select>
            </div>
        </div>

        <div v-for="category in filteredCategories">
            <h1 class="font-bold text-center bg-gray-50 mb-2">
                {{ category.name }}
            </h1>
            <button
                v-for="product in category.products"
                class="w-full bg-white px-3 py-1 rounded-xl"
                v-on:click="addProduct(product)"
            >
                <h1 class="text-xl pb-2 font-bold text-left">
                    {{ product.display_number }}. {{ product.name }}
                </h1>
            </button>
        </div>
    </div>
</template>

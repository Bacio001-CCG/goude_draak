<script setup>
import { defineProps, ref, computed } from "vue";

const props = defineProps({
    categories: Array,
});

const isFavorite = (product) => {
    return favorites.value.some((item) => item.id === product.id);
};

const favorites = ref(JSON.parse(localStorage.getItem("favorites")) || []);
const initialFavoritesOrder = ref([...favorites.value]);

const toggleFavorite = (product) => {
    const index = favorites.value.findIndex((item) => item.id === product.id);

    if (index !== -1) {
        favorites.value.splice(index, 1);
    } else {
        favorites.value.push(product);
    }

    localStorage.setItem("favorites", JSON.stringify(favorites.value));
};

const sortCriteriaFav = ref("none");

const sortFavorites = () => {
    if (sortCriteriaFav.value === "none") {
        favorites.value = [...initialFavoritesOrder.value];
        return;
    }

    favorites.value.sort((a, b) => {
        if (sortCriteriaFav.value === "price") {
            return a.price - b.price;
        }

        if (sortCriteriaFav.value === "display_number") {
            const numA = parseFloat(a.display_number);
            const numB = parseFloat(b.display_number);
            const nonNumericA = a.display_number.replace(/[0-9.]/g, "");
            const nonNumericB = b.display_number.replace(/[0-9.]/g, "");

            if (isNaN(numA) && isNaN(numB)) {
                return nonNumericA.localeCompare(nonNumericB);
            }

            if (isNaN(numA)) {
                return -1;
            }
            if (isNaN(numB)) {
                return 1;
            }

            if (numA !== numB) {
                return numA - numB;
            }

            return nonNumericA.localeCompare(nonNumericB);
        }

        return 0;
    });
};

const favoritesSorted = computed(() => [...favorites.value]);

const sortCriteriaMenu = ref("display_number");

const sortedCategories = computed(() => {
    const criteria = sortCriteriaMenu.value;
    return props.categories.map((category) => {
        const sortedProducts = [...category.products].sort((a, b) => {
            if (criteria === "price") {
                return a.price - b.price;
            }

            if (criteria === "display_number") {
                const numA = parseFloat(a.display_number);
                const numB = parseFloat(b.display_number);

                if (!isNaN(numA) && !isNaN(numB)) {
                    return numA - numB;
                }

                if (!isNaN(numA)) {
                    return -1;
                }
                if (!isNaN(numB)) {
                    return 1;
                }

                return a.display_number.localeCompare(b.display_number);
            }

            return 0;
        });

        return {
            ...category,
            products: sortedProducts,
        };
    });
});
</script>

<template>
    <div
        class="bg-[#edfabb] p-4 w-full text-left"
        v-if="favoritesSorted.length > 0"
    >
        <div class="flex justify-between justify-center mb-2">
            <h2 class="font-bold text-lg">Favorite Products</h2>
            <div class="flex">
                <label for="sortCriteriaFav" class="mr-2">Sort:</label>
                <select
                    id="sortCriteriaFav"
                    class="border border-black"
                    v-model="sortCriteriaFav"
                    @change="sortFavorites"
                >
                    <option value="none">---</option>
                    <option value="display_number">Display Number</option>
                    <option value="price">Price</option>
                </select>
            </div>
        </div>
        <ul class="gap-x-6 grid md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
            <li
                class="flex justify-between justify-center"
                v-for="product in favoritesSorted"
                :key="product.id"
            >
                <i
                    class="mr-2 cursor-pointer fa-star far"
                    @click="toggleFavorite(product)"
                    :class="{ fas: isFavorite(product) }"
                ></i>
                <span>{{ product.display_number }}. {{ product.name }}</span>
                <span
                    class="flex-grow mb-1 border-b border-black border-dotted"
                ></span>
                <span>€ {{ product.price }}</span>
            </li>
        </ul>
    </div>

    <div class="bg-[#edfabb] p-4 w-full text-left">
        <div class="flex justify-between justify-center mb-2">
            <h2 class="font-bold text-lg">Menu</h2>
            <div class="flex">
                <label for="sortCriteriaMenu" class="mr-2">Sorteren:</label>
                <select
                    id="sortCriteriaMenu"
                    class="border border-black"
                    v-model="sortCriteriaMenu"
                >
                    <option value="display_number">Nummer</option>
                    <option value="price">Prijs</option>
                </select>
            </div>
        </div>
        <ul class="gap-x-6 grid md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
            <li
                class="mb-4"
                v-for="category in sortedCategories"
                :key="category.id"
            >
                <h3 class="font-bold text-center text-lg">
                    {{ category.name }}
                </h3>
                <ul>
                    <li
                        class="flex justify-between justify-center"
                        v-for="product in category.products"
                        :key="product.id"
                    >
                        <i
                            class="mr-2 cursor-pointer fa-star far"
                            @click="toggleFavorite(product)"
                            :class="{ fas: isFavorite(product) }"
                        ></i>
                        <span
                            >{{ product.display_number }}.
                            {{ product.name }}</span
                        >
                        <span
                            class="flex-grow mb-1 border-b border-black border-dotted"
                        ></span>
                        <span>€ {{ product.price }}</span>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

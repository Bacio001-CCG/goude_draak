<script setup>
import { defineProps, ref, computed } from "vue";

const props = defineProps({
    categories: Array,
    tableid: Number,
});

const quantities = ref({});

const csrf = computed(() => {
    return document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
});

props.categories.forEach(category => {
    category.products.forEach(product => {
        quantities.value[product.id] = 0;
    });
});

const incrementQuantity = (productId) => {
    quantities.value[productId]++;
};

const decrementQuantity = (productId) => {
    if (quantities.value[productId] > 0) {
        quantities.value[productId]--;
    }
};

</script>

<template>
    <div>
        <form :action="'/table/' + props.tableid" method="post">
            <input type="hidden" name="_token" :value="csrf" />
            <ul>
                <li class="mb-4" v-for="category in categories" :key="category.id">
                    <h3 class="font-bold text-lg">{{ category.name }}</h3>
                    <ul>
                        <li class="flex justify-between justify-center gap-0.5 mb-0.5" v-for="product in category.products" :key="product.id">
                            <span>{{ product.display_number }}. {{ product.name }}</span>
                            <span class="flex-grow border-b border-black border-dotted mb-3"></span>
                            <span>€ {{ product.price }}</span>
                            <label class="ml-8" :for="'amount-' + product.id">aantal:</label>
                            <input class="w-10 text-center" :name="'order[' + product.id + ']'" :id="'amount-' + product.id" type="text" :value="quantities[product.id]" readonly>
                            <button class="bg-green-400 p-1 w-5" type="button" @click="incrementQuantity(product.id)">+</button>
                            <button class="bg-red-400 p-1 w-5" type="button" @click="decrementQuantity(product.id)">-</button>
                        </li>
                    </ul>
                </li>
            </ul>
            <button type="submit">Plaatsen</button>
        </form>
    </div>
</template>

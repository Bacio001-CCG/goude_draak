<script setup>
import { defineProps, reactive, computed } from "vue";
import axios from "axios";

const props = defineProps({
    products: Array,
    checkoutid: String,
});

let reactiveProducts = reactive(props.products);

window.addEventListener("product-added", (event) => {
    reactiveProducts.push(event.detail);
});

const removeProduct = async (product, index) => {
    try {
        let response = await axios.post(
            `/checkout-remove/${props.checkoutid}`,
            [product.id, props.checkoutid]
        );
        reactiveProducts.splice(index, 1);
    } catch (error) {
        console.error(error);
    }
};

const totalPrice = computed(() => {
    return reactiveProducts.reduce(
        (total, product) => total + parseInt(product.price),
        0
    );
});
</script>

<template>
    <div class="flex flex-col w-full gap-5">
        <h1>Producten in bestelling</h1>

        <button
            v-for="(product, index) in reactiveProducts"
            class="w-full bg-white shadow-lg p-4 rounded-xl"
            v-on:click="removeProduct(product, index)"
        >
            <h1 class="text-xl pb-2 font-bold" v-if="product">
                {{ product.display_number }}. {{ product.name }}
            </h1>
        </button>
    </div>

    <div class="mt-10 border-t">
        <h1>Totaal: {{ totalPrice }}</h1>
    </div>
</template>

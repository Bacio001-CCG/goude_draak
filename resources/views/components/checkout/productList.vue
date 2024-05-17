<script setup>
import { defineProps, defineEmits } from "vue";
import axios from "axios";
const props = defineProps({
    products: Array,
    checkoutid: String,
});
const addProduct = async (product) => {
    try {
        let response = await axios.post(`/checkout-add/${props.checkoutid}`, [
            product.id,
            props.checkoutid,
        ]);
        console.log(response.data);
        await dispatchEvent(
            new CustomEvent("product-added", { detail: product })
        );
    } catch (error) {
        console.error(error);
    }
};
</script>

<template>
    <div class="flex flex-col w-full gap-5">
        <h1>Producten</h1>

        <button
            v-for="product in products"
            class="w-full bg-white shadow-lg p-4 rounded-xl"
            v-on:click="addProduct(product)"
        >
            <h1 class="text-xl pb-2 font-bold text-left">
                {{ product.display_number }}. {{ product.name }}
            </h1>
        </button>
    </div>
</template>

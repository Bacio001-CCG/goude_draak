<script setup>
import { defineProps, reactive, computed } from "vue";
import axios from "axios";

const props = defineProps({
    orderproducts: Array,
    checkoutid: String,
});

let orderItems = reactive(props.orderproducts);

window.addEventListener("product-added", (event) => {
    orderItems.splice(0, orderItems.length, ...event.detail);
});

const removeProduct = async (product, index) => {
    try {
        let response = await axios.post(
            `/checkout-remove/${props.checkoutid}`,
            [product.id, props.checkoutid]
        );
        orderItems.splice(0, orderItems.length, ...response.data);
    } catch (error) {
        console.error(error);
    }
};

const totalPrice = computed(() => {
    return orderItems.reduce(
        (total, item) => total + parseInt(item.product.price),
        0
    );
});
</script>

<template>
    <div class="flex flex-col w-full gap-5 overflow-y-auto">
        <h1 class="mb-[4rem]">Producten in bestelling</h1>

        <div v-for="(item, index) in orderItems">
            <button
                v-key="index"
                class="w-full bg-white px-3 py-1 rounded-xl mb-2"
                v-on:click="removeProduct(item.product, index)"
            >
                <h1 class="text-xl pb-2 font-bold" v-if="item.product">
                    {{ item.product.display_number }}. {{ item.product.name }}
                </h1>
            </button>
            <order-item-note :product="item.product" :orderitem="item" />
        </div>
    </div>

    <div class="mt-10 border-t">
        <h1>Totaal: {{ totalPrice }}</h1>
    </div>
</template>

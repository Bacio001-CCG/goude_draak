<script setup>
import { defineProps } from "vue";

const props = defineProps({
    orders: Array,
});

const formatDate = (dateString) => {
    const date = new Date(dateString);
    const day = date.getDate().toString().padStart(2, "0");
    const month = (date.getMonth() + 1).toString().padStart(2, "0"); // Months are 0-based
    const year = date.getFullYear();
    const hours = date.getHours().toString().padStart(2, "0");
    const minutes = date.getMinutes().toString().padStart(2, "0");
    return `${hours}:${minutes} ${day}/${month}/${year}`;
};
</script>

<template>
    <div class="grid grid-cols-4 w-full gap-5">
        <a
            v-for="order in orders"
            :href="`/checkout/${order.id}`"
            class="w-full bg-white shadow-lg p-4 rounded-xl"
        >
            <h1 class="text-xl border-b pb-2 font-bold">
                Bestelling # {{ order.id }}
            </h1>
            <h2 class="mt-2 text-right">
                {{ formatDate(order.created_at) }}
            </h2>
        </a>
    </div>
</template>

<script setup>
import { defineProps, ref, computed, watch, onMounted } from "vue";

const props = defineProps({
    categories: Array,
    tableid: Number,
    lastplacedorder: String,
    round: Number,
});

const quantities = ref({});

props.categories.forEach(category => {
    category.products.forEach(product => {
        quantities.value[product.id] = 0;
    });
});

const csrf = computed(() => {
    return document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
});

const incrementQuantity = (productId) => {
    quantities.value[productId]++;
};

const decrementQuantity = (productId) => {
    if (quantities.value[productId] > 0) {
        quantities.value[productId]--;
    }
};

const remainingTime = ref("10:00");
let interval = null;

const calculateRemainingTime = () => {
    const updateTime = () => {
        const lastOrderTime = new Date(props.lastplacedorder);
        const now = new Date();
        const elapsedMilliseconds = now - lastOrderTime;
        const remainingMilliseconds = Math.max(10 * 60 * 1000 - elapsedMilliseconds, 0);

        const minutes = Math.floor((remainingMilliseconds / (1000 * 60)) % 60);
        const seconds = Math.floor((remainingMilliseconds / 1000) % 60);
        remainingTime.value = `${minutes.toString().padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;

        if (remainingMilliseconds <= 0) {
            clearInterval(interval);
            remainingTime.value = "00:00";
        }
    };

    updateTime(); 

    interval = setInterval(updateTime, 1000);
};

onMounted(() => {
    calculateRemainingTime();
});
</script>

<template>    
    <div class="flex justify-between">
        <span>Ronde {{ props.round + 1 }}/5</span>        
        <span v-if="remainingTime !== '00:00'">
            Volgende bestelling: {{ remainingTime }}
        </span>
    </div>
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
            
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"
                    type="submit"
                    v-if="remainingTime === '00:00'"
                    :disabled="remainingTime !== '00:00'">
                Plaatsen
            </button>
        </form>
    </div>
</template>

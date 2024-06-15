<script setup>
import { defineProps, ref, computed, watch, onMounted } from "vue";

const props = defineProps({
    categories: Array,
    pastorders: Object,
    tableid: Number,
    lastplacedorder: String,
    round: Number,
});

console.log(props.pastorders);

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

const repeatOrder = (order) => {
    for (const key in quantities.value) {
        quantities.value[key] = 0;
    }

    order.forEach(product => {
        if (quantities.value[product.product_id] !== undefined) {
            quantities.value[product.product_id] += 1;
        }
    });
};

const showPastOrders = ref(false);

const togglePastOrders = () => {
    showPastOrders.value = !showPastOrders.value;
};
</script>

<template>   
    <form :action="props.tableid" method="post" class="mb-5"> 
        <div class="sticky top-0 bg-white z-10 py-2">
            <div class="flex justify-between">
                <span>Ronde {{ props.round + 1 }}/5</span>        
                <span v-if="remainingTime !== '00:00'">
                    Volgende bestelling: {{ remainingTime }}
                </span>
            </div>
            <div class="relative bg-gray-100 rounded-lg px-2 pt-2 shadow-md mb-4">
                <button @click="togglePastOrders" type="button" class="bg-gray-500 text-white font-semibold py-1 px-2 rounded mb-2">Vorige rondes</button>
                <div v-if="showPastOrders">    
                    <ul class="pb-2">
                        <li v-for="(round, index) in pastorders" :key="index" class="flex justify-between justify-center gap-0.5 mb-2">
                            <span>Ronde: {{ index }}</span>
                            <span class="flex-grow border-b border-black border-dotted mb-3"></span>
                            <button class="bg-blue-400 p-1 px-2 text-white" type="button" @click="repeatOrder(round)">Herhaal</button>
                        </li>
                    </ul>
                </div>
            </div>               
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"
                    type="submit"
                    v-if="remainingTime === '00:00'"
                    :disabled="remainingTime !== '00:00'">
                Plaatsen
            </button>            
        </div>
        <div>
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
        </div>
    </form>
</template>


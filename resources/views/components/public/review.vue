<script setup>
import { defineProps, ref, computed } from "vue";

const props = defineProps();

const email = ref("");
const review = ref("");
const rating = ref(5);
const speedRating = ref(5);

const csrf = computed(() => {
    return document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
});

function setRating(value) {
    rating.value = value;
}

function setSpeedRating(value) {
    speedRating.value = value;
}

async function handleSubmit() {
    try {
        await axios.post("/review", [
            email.value,
            review.value,
            rating.value,
            speedRating.value,
        ]);
        window.alert("Bedankt voor uw review!");
        window.location.href = "/";
    } catch (error) {
        window.alert("Vul alle velden in!");
        console.error(error);
    }
}
</script>

<template>
    <form
        @submit.prevent="handleSubmit"
        class="top-1/2 left-1/2 absolute flex flex-col gap-6 border-yellow-500 bg-[#ff0000] shadow-lg p-5 border rounded-xl w-[30rem] h-max text-white -translate-x-1/2 -translate-y-1/2"
    >
        <input type="hidden" name="_token" :value="csrf" />

        <div>
            <h1 class="font-bold text-xl">Review</h1>
            <p>Geef je mening over onze service en gerechten!</p>
        </div>
        <div>
            <label for="review" class="block font-semibold"
                >Wat is uw email</label
            >
            <input
                id="email"
                v-model="email"
                class="border-yellow-500 bg-[#8b0000] p-2 border rounded-lg w-full"
                type="email"
            />
        </div>
        <div>
            <label for="review" class="block font-semibold"
                >Beschrijf je ervaring</label
            >
            <textarea
                id="review"
                v-model="review"
                class="border-yellow-500 bg-[#8b0000] p-2 border rounded-lg w-full h-24"
                placeholder="Schrijf hier je review"
            >
            </textarea>
        </div>
        <div>
            <label for="review" class="block font-semibold"
                >Gerechten qualiteit</label
            >
            <div class="grid grid-cols-5 mt-2 w-full">
                <i
                    v-for="value in [1, 2, 3, 4, 5]"
                    :key="value"
                    class="text-4xl text-center cursor-pointer fa-solid fa-star items"
                    :class="{
                        'text-yellow-400': value <= rating,
                        'text-gray-400': value > rating,
                    }"
                    @click="setRating(value)"
                ></i>
            </div>
        </div>
        <div>
            <label for="review" class="block font-semibold"
                >Service snelheid</label
            >
            <div class="grid grid-cols-5 mt-2 w-full">
                <i
                    v-for="value in [1, 2, 3, 4, 5]"
                    :key="value"
                    class="text-4xl text-center cursor-pointer fa-gauge fa-solid items"
                    :class="{
                        'text-yellow-400': value <= speedRating,
                        'text-gray-400': value > speedRating,
                    }"
                    @click="setSpeedRating(value)"
                ></i>
            </div>
        </div>

        <button
            type="submit"
            class="bg-yellow-500 hover:bg-yellow-400 py-2 rounded-xl w-full font-bold text-white transition-all duration-300"
        >
            Verstuur
        </button>
    </form>
</template>

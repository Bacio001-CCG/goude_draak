<script setup>
import { defineProps, reactive, toRefs } from "vue";

const props = defineProps({
    product: Object,
    orderitem: Object,
});

console.log(props.orderitem);

let note = reactive({ value: props.orderitem.note });
let state = reactive({ showNote: false });

const toggleNote = () => {
    state.showNote = true;
};

const opslaan = async () => {
    let response = await axios.post(`/note-add`, [
        props.orderitem.id,
        note.value,
        props.orderitem.order_id,
    ]);

    await dispatchEvent(
        new CustomEvent("product-added", { detail: response.data })
    );
};
</script>
<template>
    <div class="relative" v-if="!note.value && !state.showNote">
        <hr
            class="border border-blue-300 absolute top-1/2 -translate-y-1/2 w-full"
        />
        <button v-on:click="toggleNote">
            <i
                class="fa-solid fa-plus absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 p-0.5 px-2 bg-blue-300 rounded-lg text-white"
            ></i>
        </button>
    </div>
    <div v-if="note.value || state.showNote">
        <textarea class="w-full p-2" v-model="note.value" />
        <button v-on:click="opslaan">Opslaan</button>
    </div>
</template>

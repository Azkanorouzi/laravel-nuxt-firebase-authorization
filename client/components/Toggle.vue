<template>
    <div class="flex items-center justify-between space-x-2" @click="toggle">
        <span class="text-sm">{{ label }}</span>
        <button
            class="w-10 h-5 bg-gray-700 rounded-full relative transition-colors duration-300"
        >
            <span
                class="block w-4 h-4 bg-gray-200 rounded-full shadow absolute left-1 top-0.5 transition-all"
                :class="{ 'translate-x-5 bg-green-400': isActive }"
            ></span>
        </button>
    </div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps({
    label: {
        type: String,
        required: true,
    },
    isActive: {
        type: Boolean,
        required: true,
    },
});

const emit = defineEmits(["toggle"]);

const toggle = () => {
    emit("toggle");
};
</script>

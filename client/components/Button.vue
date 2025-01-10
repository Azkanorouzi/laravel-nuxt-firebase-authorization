<template>
    <button
        :type="type"
        class="w-full py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-md transition-all duration-300"
        :class="customClass"
    >
        <slot></slot>
    </button>
</template>

<script setup>
defineProps({
    type: {
        type: String,
        default: "button",
    },
    customClass: {
        type: String,
        default: "",
    },
});
</script>

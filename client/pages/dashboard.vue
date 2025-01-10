<template>
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <p>Welcome to your dashboard!</p>
        <button
            @click="logout"
            class="mt-4 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
        >
            Logout
        </button>
    </div>
</template>

<script setup>
const authStore = useAuthStore();

const logout = () => {
    authStore.clearToken();
    navigateTo("/");
};
</script>

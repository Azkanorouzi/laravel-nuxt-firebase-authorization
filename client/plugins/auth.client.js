// plugins/auth.js
export default defineNuxtPlugin((nuxtApp) => {
    const authStore = useAuthStore();
    authStore.initialize(); // Initialize the store
});

import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        token: null, // Initialize token as null
    }),
    actions: {
        setToken(token) {
            this.token = token;
            if (import.meta.client) {
                localStorage.setItem("token", token);
            }
        },
        clearToken() {
            this.token = null;
            if (import.meta.client) {
                localStorage.removeItem("token");
            }
        },
        initialize() {
            if (import.meta.client) {
                this.token = localStorage.getItem("token");
            }
        },
    },
    getters: {
        isAuthenticated: (state) => !!state.token,
    },
});

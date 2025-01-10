<template>
    <div
        class="flex items-center justify-center min-h-screen bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 text-gray-300"
    >
        <div
            class="relative p-8 w-full max-w-md bg-gray-800 rounded-xl shadow-lg"
        >
            <!-- Success Alert -->
            <transition name="fade">
                <div
                    v-if="successMessage"
                    class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-md text-green-400 text-sm"
                >
                    {{ successMessage }}
                </div>
            </transition>

            <!-- Toggle Switch -->
            <div class="flex justify-between mb-6">
                <h2
                    class="text-xl font-semibold transition-all duration-300"
                    :class="{ 'text-green-400': mode === 'login' }"
                >
                    {{ mode === "login" ? "Login" : "Sign Up" }}
                </h2>
                <Toggle
                    :label="mode === 'login' ? 'Sign Up' : 'Login'"
                    :isActive="mode === 'signup'"
                    @toggle="toggleMode"
                />
            </div>

            <!-- Form -->
            <form @submit.prevent="onSubmit">
                <!-- Email Field -->
                <Input
                    type="email"
                    label="Email"
                    placeholder="Email Address"
                    v-model="form.email"
                    required
                />

                <!-- Password Field -->
                <Input
                    type="password"
                    label="Password"
                    placeholder="Password"
                    v-model="form.password"
                    required
                />

                <!-- Submit Button -->
                <Button type="submit" :disabled="isSubmitting">
                    {{
                        isSubmitting
                            ? "Submitting..."
                            : mode === "login"
                            ? "Login"
                            : "Sign Up"
                    }}
                </Button>

                <!-- Error Message -->
                <p v-if="error" class="text-red-500 text-sm mt-4">
                    {{ error }}
                </p>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import Button from "~/components/Button.vue";
import Input from "~/components/Input.vue";
import Toggle from "~/components/Toggle.vue";
import { useApi } from "~/utils/api";

// Form state
const form = ref({
    email: "",
    password: "",
});

// Toggle login/signup mode
const mode = ref("login");
const toggleMode = () => {
    mode.value = mode.value === "login" ? "signup" : "login";
    clearMessages(); // Clear messages when switching modes
};

// Submission state
const isSubmitting = ref(false);
const error = ref("");
const successMessage = ref("");

// API service
const { signUp, signIn } = useApi();

// Clear error and success messages
const clearMessages = () => {
    error.value = "";
    successMessage.value = "";
};

// Handle form submission
const onSubmit = async () => {
    clearMessages(); // Reset messages
    isSubmitting.value = true;

    try {
        if (mode.value === "signup") {
            // Call the sign-up API
            await signUp(form.value.email, form.value.password);

            // Show success message
            successMessage.value = `You've been signed up with ${form.value.email}. Please login to access the dashboard.`;

            // Switch to login mode after 2 seconds
            setTimeout(() => {
                mode.value = "login";
                successMessage.value = ""; // Clear success message after switching
            }, 2000);
        } else {
            // Handle login logic
            const response = await signIn(
                form.value.email,
                form.value.password
            );

            // Store the JWT token
            const authStore = useAuthStore();
            authStore.setToken(response.user.token);

            // Redirect to the dashboard
            navigateTo("/dashboard");
        }
    } catch (err) {
        error.value =
            err.data?.message || "An error occurred. Please try again.";
        console.error("Submission Error:", err);
    } finally {
        isSubmitting.value = false;
    }
};
</script>

<style>
/* Fade transition for smooth animations */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease-in-out;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>

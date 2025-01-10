// middleware/auth.global.ts
import { validateToken } from "~/utils/validateToken"; // Import the validateToken function

export default defineNuxtRouteMiddleware(async (to) => {
    const authStore = useAuthStore();

    console.log("Middleware running...");
    console.log("Token:", authStore.token);
    console.log("Path:", to.path);

    // If the user is not authenticated and tries to access /dashboard, redirect to /
    if (!authStore.token && to.path === "/dashboard") {
        console.log("Redirecting to / - User not authenticated");
        return navigateTo("/");
    }

    // If the user is authenticated, validate the token
    if (authStore.token) {
        try {
            // Validate the token using the validateToken function
            const isValid = await validateToken(authStore.token);

            if (!isValid) {
                console.log("Token is invalid - Redirecting to /");
                authStore.clearToken(); // Clear the invalid token
                return navigateTo("/");
            }
        } catch (error) {
            console.error("Token validation failed:", error);
            authStore.clearToken(); // Clear the token if validation fails
            return navigateTo("/");
        }
    }
});

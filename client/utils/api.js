export const useApi = () => {
    const baseURL = "http://localhost:8000/api"; // Replace with your Laravel API base URL

    // Generic function to handle API requests
    const request = async (url, method, body) => {
        try {
            const response = await $fetch(url, {
                baseURL,
                method,
                body,
                headers: {
                    "Content-Type": "application/json",
                },
            });
            return response;
        } catch (error) {
            console.error("API Error:", error);
            throw error;
        }
    };

    // Sign-up function
    const signUp = async (email, password) => {
        return await request("/sign-up", "POST", { email, password });
    };

    const signIn = async (email, password) => {
        return await request("/sign-in", "POST", { email, password });
    };

    return {
        signUp,
        signIn,
    };
};

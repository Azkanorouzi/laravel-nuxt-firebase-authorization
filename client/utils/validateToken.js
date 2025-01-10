// utils/validateToken.ts
export async function validateToken(token) {
    try {
        const response = await $fetch(
            "http://localhost:8000/api/validate-token",
            {
                method: "GET",
                headers: {
                    Authorization: `Bearer ${token}`, // Send the token in the Authorization header
                },
            }
        );

        // Assuming the API returns { valid: true } if the token is valid
        return response.message;
    } catch (error) {
        console.error("Token validation failed:", error);
        return false; // Return false if the request fails or the token is invalid
    }
}

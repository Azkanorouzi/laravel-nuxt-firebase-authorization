// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    devtools: { enabled: true },
    modules: ["@nuxtjs/tailwindcss", "@pinia/nuxt"],
    plugins: ["~/plugins/auth.client.js"],
    compatibilityDate: "2025-01-10",
    ssr: false,
});

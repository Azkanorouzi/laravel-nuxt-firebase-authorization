# 🔥 Firebase + Laravel + Nuxt Authentication Project

Welcome to my **Firebase + Laravel + Nuxt Authentication Project**! This project was built to test and showcase my web development skills, focusing on **authentication** using a modern tech stack. It combines the power of Firebase for authentication, Laravel for the backend API, and Nuxt for the frontend.

1- For starting up the project first setup your environment variables in laravel.

2- Then run composer install && php artisan serve to run the backend

3- Head over to /client and run npm install && npm run dev

# ! > [!CAUTION]

> You have to create a firebase-service-account.json and put your own credentials there.

# ! > [!CAUTION]

> You must create an environment variable that holds the address to firebase-service-account which is normally in /storage/app, it's better for the path to be an absolute path.

for example:
FIREBASE_CREDENTIALS=/home/azka/workstation/projects/laravel/laravel-firebase-app/storage/app/firebase-service-account.json

---

## 🚀 Features

- **User Authentication**:
  - Sign up with email and password.
  - Login with email and password.
  - Protected routes using middleware.
- **Backend API**:
  - Built with Laravel for handling authentication logic.
  - JWT (JSON Web Token) for secure user sessions.
- **Frontend**:
  - Built with Nuxt.js for a seamless user experience.
  - Responsive and modern UI.
- **Firebase Integration**:
  - Firebase Authentication for secure and scalable user management.

---

## 🛠️ Tech Stack

- **Frontend**:
  - [Nuxt.js](https://nuxtjs.org/) - A powerful Vue.js framework for building modern web applications.
  - [Tailwind CSS](https://tailwindcss.com/) - A utility-first CSS framework for styling.
- **Backend**:
  - [Laravel](https://laravel.com/) - A PHP framework for building robust APIs.
  - [Firebase Authentication](https://firebase.google.com/products/auth) - For secure user authentication.
- **Other Tools**:
  - [Pinia](https://pinia.vuejs.org/) - State management for Vue.js.
  - [Axios](https://axios-http.com/) - For making HTTP requests to the Laravel API.
  - [JWT (JSON Web Tokens)](https://jwt.io/) - For secure user sessions.

---

## 📂 Project Structure

.
├── client/                  # Nuxt.js frontend
│   ├── assets/              # Static assets (images, fonts, etc.)
│   ├── components/          # Reusable Vue components
│   ├── layouts/             # Layouts for pages
│   ├── middleware/          # Nuxt middleware for route protection
│   ├── pages/               # Application pages
│   ├── plugins/             # Nuxt plugins (e.g., Pinia, Axios)
│   ├── store/               # Pinia store for state management
│   └── nuxt.config.ts       # Nuxt configuration file
│
├── server/                  # Laravel backend
│   ├── app/                 # Application logic
│   ├── config/              # Configuration files
│   ├── database/            # Database migrations and seeders
│   ├── routes/              # API routes
│   └── .env                 # Environment variables
│
└── README.md                # This file

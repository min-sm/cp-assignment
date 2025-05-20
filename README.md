# Tech Giant

<p align="center">
  <img src="public/img/common/logo.png" alt="Logo" width="15%">
</p>

**Tech Giant** is a web-based e-commerce platform designed for a specialized electronics store focusing on laptop sales and repair services. This project was developed as part of a college assignment. The platform aims to modernize and unify Tech Giant's retail and repair operations into a single responsive system.

## 📌 Project Overview

Tech Giant's platform provides an intuitive interface for both customers and administrators. Customers can browse and purchase laptops, submit repair inquiries, and manage orders. Administrators can manage inventory, respond to customer inquiries, and monitor sales performance.

The project uses the **TALL Stack** (Tailwind CSS, Alpine.js, Laravel, and Livewire) and follows Agile development methodology.

## 🎯 Project Objectives

- Build a responsive web-based e-commerce system.
- Implement real-time inventory management.
- Support essential retail and repair services online.
- Deliver a smooth user experience for both customers and administrators.
- Ensure security, performance, and scalability.

## 🛠️ Technology Stack

- **Tailwind CSS** – Utility-first CSS framework for responsive UI.
- **Alpine.js** – Lightweight JS framework for simple interactivity.
- **Laravel** – PHP backend framework for routing, authentication, and database management.
- **Livewire** – Enables real-time UI updates with minimal JavaScript.

Additional Tools:
- Laravel Socialite (GitHub login)
- Livewire Charts (Admin dashboard visualizations)
- MySQL Workbench
- Flowbite (UI components)

## 🚀 Key Features

### Customer-Side
- Laptop browsing with search, filtering, and sorting
- Shopping cart and checkout system
- Repair inquiry form with image upload
- Order history and account management

### Admin-Side
- Product/brand/category management
- Sales tracking and visualization
- Inquiry management (view/respond via email)
- User and admin account control

## ✅ Functional Requirements Highlights

- Authentication system for users and admins
- Real-time stock updates
- Secure order processing
- SEO-friendly dynamic product URLs
- Fully responsive UI

## 📦 Requirements

To run this project locally, ensure you have the following installed:

- **PHP 8.2**
- **MySQL 8.0**
- **Node.js 20.x**
- **Composer**
- **npm** (bundled with Node.js)
- **XAMPP** (or any local server supporting PHP & MySQL)

## 🛠️ Installation

Follow these steps to set up the project locally:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/min-sm/cp-assignment
   cd cp-assignment

2. **Install PHP dependencies via Composer:**

   ```bash
   composer install
   ```

3. **Install JavaScript dependencies via npm:**

   ```bash
   npm install
   ```

4. **Compile frontend assets:**

   ```bash
   npm run dev
   ```

5. **Copy the `.env` file and set up environment variables:**

   ```bash
   cp .env.example .env
   ```

   * Update `.env` with your local database credentials:

     ```
     DB_DATABASE=tech_giant
     DB_USERNAME=root
     DB_PASSWORD=
     ```

6. **Generate the application key:**

   ```bash
   php artisan key:generate
   ```

7. **Run database migrations:**

   ```bash
   php artisan migrate
   ```

8. **Start the local development server:**

   ```bash
   php artisan serve
   ```

Then visit `http://localhost:8000` in your browser to access the application.
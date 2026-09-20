# 👗 FashionNest — Fashion E-Commerce Website

FashionNest is a full-stack **fashion e-commerce website** built with **PHP, MySQL, HTML5, CSS3, and JavaScript**. The platform provides a complete shopping experience with product browsing, categories, user authentication, cart management, checkout flow, order handling, and an admin dashboard for managing products and orders.

---

## 🌟 Project Overview

FashionNest is designed as a modern online fashion store where users can explore fashion products across different categories, view product details, add products to their cart, and complete the checkout process.

The project also includes an **Admin Panel** that allows administrators to manage products and monitor customer orders.

### 🎯 Main Objectives

* Build a functional fashion e-commerce platform
* Provide a simple and user-friendly shopping experience
* Implement product category navigation
* Provide user registration and login functionality
* Implement shopping cart functionality
* Implement checkout and order confirmation
* Create an admin dashboard for product and order management
* Store and retrieve product and order data using MySQL

---

# ✨ Features

## 🛍️ Customer Features

* 🏠 Fashion-focused homepage
* 👗 Product browsing
* 🧥 Men's fashion section
* 👚 Women's fashion section
* 🆕 New arrivals
* 🛒 Shopping cart
* 📦 Product details
* 🔐 User registration
* 🔑 User login
* 🚪 User logout
* 💳 Checkout flow
* ✅ Order confirmation
* 🎉 Thank-you page
* 🔎 Category-based product browsing
* 🖼️ Product images and promotional banners
* 📱 Responsive-friendly UI

---

## 👨‍💼 Admin Features

FashionNest includes a dedicated administration section.

### Admin Dashboard

* 📊 Admin dashboard
* ➕ Add products
* ✏️ Edit products
* 🗑️ Delete products
* 👀 View products
* 📦 View customer orders
* 🔐 Admin login
* 🚪 Admin logout

---

# 🛠️ Technologies Used

| Technology     | Purpose                       |
| -------------- | ----------------------------- |
| **PHP**        | Backend development           |
| **MySQL**      | Database management           |
| **HTML5**      | Website structure             |
| **CSS3**       | Styling and responsive design |
| **JavaScript** | Client-side interactions      |
| **PDO**        | Secure database connectivity  |
| **XAMPP**      | Local development server      |
| **Git**        | Version control               |
| **GitHub**     | Source code hosting           |

---

# 📁 Project Structure

```text
FashionNest/
│
├── admin/
│   ├── add_product.php
│   ├── dashboard.php
│   ├── delete_product.php
│   ├── edit_product.php
│   ├── login.php
│   ├── logout.php
│   ├── view_orders.php
│   └── view_products.php
│
├── css/
│   ├── arch.css
│   ├── category.css
│   ├── coverflow.css
│   ├── new_arrivals.css
│   ├── product_slider.css
│   └── style.css
│
├── images/
│   └── Product and website images
│
├── FashionNest/
│   └── Additional FashionNest images/assets
│
├── includes/
│   ├── all_product_sections.php
│   ├── category_buttons.php
│   ├── category_sections.php
│   └── db.php
│
├── js/
│   ├── category_scroll.js
│   ├── coverflow.js
│   ├── order_popup.js
│   └── product_slider.js
│
├── pages/
│   ├── cart.php
│   ├── checkout_success.php
│   ├── login.php
│   ├── logout.php
│   ├── register.php
│   └── thanks.php
│
├── continue_order.php
├── index.php
├── new_arrivals.php
├── product_details.php
├── test_db.php
├── .gitignore
└── README.md
```

---

# 🖥️ Application Pages

## 🏠 Home Page

The homepage provides access to the major sections of the FashionNest store, including product categories, promotional content, and featured products.

## 🆕 New Arrivals

Displays recently added fashion products and allows users to explore the latest products.

## 🛍️ Product Details

Users can view individual product information and proceed with shopping actions.

## 🛒 Shopping Cart

Users can review selected products before proceeding to checkout.

## 🔐 Authentication

The application provides:

* User registration
* User login
* User logout

## 📦 Checkout

Users can proceed through the checkout flow and receive an order confirmation after completing the process.

---

# 👨‍💼 Admin Panel

The admin panel provides management functionality for the store.

### Product Management

Administrators can:

```text
Add Product
     ↓
View Products
     ↓
Edit Product
     ↓
Delete Product
```

### Order Management

Administrators can also view customer orders through the admin order management section.

---

# 🗄️ Database

FashionNest uses **MySQL** for storing application data.

The PHP application connects to MySQL through:

```text
includes/db.php
```

The database connection uses **PDO**.

Example local configuration:

```php
$host = "localhost";
$port = "3307";
$dbname = "e-commerce";
$username = "root";
$password = "";
```

> ⚠️ These settings are intended for local XAMPP development. When deploying the application to a hosting provider, update the database configuration with the hosting database credentials.

---

# 🚀 Installation & Setup

## 1️⃣ Install XAMPP

Download and install XAMPP on your Windows system.

Start:

```text
Apache
MySQL
```

from the XAMPP Control Panel.

---

## 2️⃣ Clone the Repository

Open your terminal and run:

```bash
git clone https://github.com/devika119-45/FashionNest.git
```

Move into the project:

```bash
cd FashionNest
```

---

## 3️⃣ Move Project to XAMPP

Place the project inside:

```text
C:\xampp\htdocs\
```

For example:

```text
C:\xampp\htdocs\e-commerce
```

---

## 4️⃣ Create MySQL Database

Open:

```text
http://localhost/phpmyadmin
```

Create a database named:

```text
e-commerce
```

Import the project's database SQL file if available.

---

## 5️⃣ Configure Database Connection

Open:

```text
includes/db.php
```

Configure:

```php
$host = "localhost";
$port = "3307";
$dbname = "e-commerce";
$username = "root";
$password = "";
```

Update these values according to your local MySQL configuration.

---

## 6️⃣ Run the Website

Open your browser and visit:

```text
http://localhost/e-commerce/
```

The FashionNest homepage should now load.

---

# 🔑 Admin Panel

The administrator section is available through:

```text
http://localhost/e-commerce/admin/
```

Use the configured admin credentials to access the dashboard.

From the dashboard, administrators can manage:

* Products
* Product information
* Product images
* Customer orders

---

# 📸 Screenshots

Screenshots can be added here to showcase the application.

### 🏠 Homepage

Add your homepage screenshot:

```text
![FashionNest Homepage](screenshots/homepage.png)
```

### 🛍️ Products

```text
![FashionNest Products](screenshots/products.png)
```

### 🛒 Shopping Cart

```text
![FashionNest Cart](screenshots/cart.png)
```

### 👨‍💼 Admin Dashboard

```text
![FashionNest Admin Dashboard](screenshots/admin-dashboard.png)
```

> Create a `screenshots` folder in the project and place your screenshots inside it.

---

# 🎥 Project Demo

Add your project demonstration video here:

```text
## 🎥 Demo

[Watch FashionNest Project Demo](YOUR_VIDEO_LINK)
```

You can use a YouTube, Google Drive, or other publicly accessible demo link.

---

# 🔄 Application Flow

```text
                ┌─────────────────┐
                │   FashionNest   │
                │    Homepage     │
                └────────┬────────┘
                         │
            ┌────────────┼────────────┐
            ↓            ↓            ↓
        Categories   New Arrivals   Products
            │            │            │
            └────────────┼────────────┘
                         ↓
                  Product Details
                         │
                         ↓
                    Add to Cart
                         │
                         ↓
                      Checkout
                         │
                         ↓
                  Order Confirmation
```

### Admin Flow

```text
Admin Login
     ↓
Admin Dashboard
     │
     ├── Add Product
     ├── View Products
     ├── Edit Product
     ├── Delete Product
     └── View Orders
```

---

# 🔐 Security Considerations

For development purposes, the project uses a local MySQL configuration.

Before production deployment, the following improvements are recommended:

* Store database credentials securely
* Use environment variables
* Hash user passwords using PHP password hashing
* Add server-side input validation
* Add CSRF protection
* Validate uploaded product images
* Restrict admin access
* Use HTTPS
* Add secure session handling
* Sanitize and validate user input
* Avoid exposing database credentials in source code

---

# 🚧 Future Improvements

Future versions of FashionNest can include:

* 💳 Online payment gateway integration
* 📧 Email order confirmation
* ❤️ Wishlist functionality
* ⭐ Product reviews and ratings
* 🔍 Advanced product search
* 🎯 Product filtering and sorting
* 📱 Improved mobile responsiveness
* 👤 User profile management
* 📦 Order tracking
* 🧾 Downloadable invoices
* 📊 Advanced admin analytics
* 🔔 Order notifications
* ☁️ Production hosting and deployment

---

# 📌 Project Status

```text
Status: 🚀 Active Development
```

The current version focuses on the core e-commerce workflow, including product browsing, authentication, cart functionality, checkout, order handling, and administration.

---

# 🤝 Contributing

Contributions are welcome.

To contribute:

```bash
git clone https://github.com/devika119-45/FashionNest.git
```

Create a new branch:

```bash
git checkout -b feature/new-feature
```

Make your changes and commit:

```bash
git add .
git commit -m "Add new feature"
```

Push your branch:

```bash
git push origin feature/new-feature
```

Then open a Pull Request on GitHub.

---

# 📄 License

This project is currently intended for educational and portfolio purposes.

A specific open-source license can be added in the future if required.

---

# 👩‍💻 Developer

**Devika**

FashionNest — Fashion E-Commerce Website

Built with ❤️ using:

```text
PHP • MySQL • HTML • CSS • JavaScript
```

---

## ⭐ Support

If you find this project useful, consider giving the repository a ⭐ on GitHub.

**FashionNest — Discover. Shop. Style.**

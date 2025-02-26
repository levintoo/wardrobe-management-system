# 🚀 Project Setup

## 📦 Prerequisites
- 🐘 PHP >= 8.2
- 📦 Composer
- 🟢 Node.js & npm
- 🗄️ MySQL, SQLite, or your preferred database

## 🔧 Installation
1. **Clone the repository:**
```bash
git clone https://github.com/levintoo/wardrobe-management-system
cd wardrobe-management-system
```

2. **Install dependencies:**
```bash
composer install
npm install
npm run build
```

3. **Environment setup:**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure `.env` file:**

You have **two choices** for the database connection: **SQLite** or **MySQL**. Pick the one that fits your setup:

#### 🟦 **Option 1: SQLite (Simple Setup)**

- Configure the `.env` file:  
```env
DB_CONNECTION=sqlite
# DB_DATABASE=database
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_USERNAME=root
# DB_PASSWORD=
```

- Create the SQLite database file:
```bash
mkdir -p database
touch database/database.sqlite
```

#### 🟧 **Option 2: MySQL (Advanced Setup)**

- Configure the `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

- Create the MySQL database:

5. **Run migrations and seeders:**
```bash
php artisan migrate --seed
```

## 🔑 Test Login
- **Email:** `test@example.com`
- **Password:** `password`

## 🖥️ Development Server
```bash
php artisan serve
```

Open [http://localhost:8000](http://localhost:8000) in your browser.

## 🧹 Additional Commands
- **Clear cache:**
```bash
php artisan optimize:clear
```

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
- Set up your database connection (Example for SQLite):
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

- Create the SQLite database file:
```bash
mkdir -p database
touch database/database.sqlite
```

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

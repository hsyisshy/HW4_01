#!/bin/bash

echo "🚀 Starting Laravel project initialization..."

# 1. Composer install
echo "📦 Installing PHP dependencies (composer install)..."
composer install

# 2. Create .env if it doesn't exist
if [ ! -f .env ]; then
  echo "📝 Creating .env file..."
  cp .env.example .env
else
  echo "✅ .env file already exists. Skipping."
fi

# 3. Generate application key
echo "🔐 Generating Laravel APP_KEY..."
php artisan key:generate

# 4. Create SQLite database if not exists
if [ ! -f database/database.sqlite ]; then
  echo "📁 Creating SQLite database file..."
  touch database/database.sqlite
else
  echo "✅ SQLite database file already exists. Skipping."
fi

# 5. Clear Laravel caches
echo "🧹 Clearing Laravel caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# 6. Run migrations + seed
read -p "❓ Do you want to reset and seed the database (php artisan migrate:fresh --seed)? (y/N): " run_seed
if [[ "$run_seed" == "y" || "$run_seed" == "Y" ]]; then
  echo "🧱 Rebuilding database with seed data..."
  php artisan migrate:fresh --seed
else
  echo "🚫 Skipping migrate:fresh --seed."
fi

# 7. Install front-end dependencies (if package.json exists)
if [ -f package.json ]; then
  echo "🎨 Installing front-end dependencies (npm install)..."
  npm install
else
  echo "⚠️  No package.json found. Skipping npm install."
fi

# 8. Start Laravel development server
echo "🌐 Starting Laravel development server..."
php artisan serve

#!/bin/bash
# =====================================================================
#  fix_storage_server.sh
#  Run this script on the production server after deploying the code.
#  Usage: bash fix_storage_server.sh
# =====================================================================

set -e
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$SCRIPT_DIR"

echo "=== Step 1: Create required storage directories ==="
mkdir -p storage/app/public/horses
mkdir -p storage/app/public/categories
mkdir -p storage/app/public/galleries
mkdir -p storage/app/public/news
mkdir -p storage/app/public/products
mkdir -p storage/app/public/product_sliders
mkdir -p storage/app/public/home_sliders
mkdir -p storage/app/public/catalog
mkdir -p storage/app/public/category_sliders
mkdir -p public/storage
echo "Directories created."

echo ""
echo "=== Step 2: Create/verify public/storage symlinks per disk ==="
create_link() {
    local link="$1"
    local target="$2"
    if [ -L "$link" ]; then
        echo "  [OK]  $link already exists as symlink"
    elif [ -e "$link" ]; then
        echo "  [SKIP] $link exists as a real file/dir (not a symlink) — skipping"
    else
        ln -s "$(realpath "$target")" "$link"
        echo "  [CREATED] $link -> $target"
    fi
}

create_link "public/storage/horses"          "storage/app/public/horses"
create_link "public/storage/categories"      "storage/app/public/categories"
create_link "public/storage/galleries"       "storage/app/public/galleries"
create_link "public/storage/news"            "storage/app/public/news"
create_link "public/storage/products"        "storage/app/public/products"
create_link "public/storage/product_sliders" "storage/app/public/product_sliders"
create_link "public/storage/home_sliders"    "storage/app/public/home_sliders"
create_link "public/storage/catalog"         "storage/app/public/catalog"
create_link "public/storage/category_sliders" "storage/app/public/category_sliders"

echo ""
echo "=== Step 3: Fix file permissions ==="
chmod -R 755 storage/app/public/horses 2>/dev/null || true
echo "Permissions set."

echo ""
echo "=== Step 4: Regenerate Spatie MediaLibrary conversions ==="
php artisan media-library:regenerate --only-missing --force
echo "Conversions regenerated."

echo ""
echo "=== Step 5: Clear all caches ==="
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
echo "Caches cleared."

echo ""
echo "=== Done! ==="
echo "Verify by visiting: https://akbulut.com.tm/en/horses"

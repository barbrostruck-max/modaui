#!/usr/bin/env bash
# Auto deployment script for the modaui Laravel project.
# Usage: ./deploy.sh [branch]
# Example: ./deploy.sh main

set -euo pipefail
IFS=$'\n\t'

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
cd "$ROOT_DIR"

BRANCH="${1:-main}"

if [[ -n "$(git status --porcelain)" ]]; then
  echo "ERROR: Working tree is dirty. Commit or stash changes before deploying."
  git status --short
  exit 1
fi

echo "Deploying branch: $BRANCH"

echo "Fetching latest changes..."
git fetch origin --prune

echo "Checking out branch $BRANCH..."
git checkout "$BRANCH"

echo "Resetting local branch to origin/$BRANCH..."
git reset --hard "origin/$BRANCH"

if [[ -f composer.json ]]; then
  echo "Installing PHP dependencies..."
  composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
fi

if [[ -f package.json ]]; then
  if [[ -f package-lock.json ]]; then
    echo "Installing Node dependencies with npm ci..."
    npm ci
  elif [[ -f yarn.lock ]]; then
    echo "Installing Node dependencies with yarn install..."
    yarn install --frozen-lockfile
  fi

  if [[ -f package.json ]]; then
    if grep -q '"build"' package.json; then
      echo "Building frontend assets..."
      npm run build
    fi
  fi
fi

if [[ -f artisan ]]; then
  echo "Running database migrations..."
  php artisan migrate --force

  echo "Clearing and caching configuration..."
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache

  echo "Ensuring storage symlink exists..."
  php artisan storage:link || true
fi

echo "Deployment complete."

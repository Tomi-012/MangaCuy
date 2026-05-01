# 🌌 MangaCuy: Advanced reading Hub

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="MangaCuy Logo">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Version-3.1.0-6366f1?style=for-the-badge" alt="Version">
  <img src="https://img.shields.io/badge/Framework-Laravel%2010-ff2d20?style=for-the-badge" alt="Framework">
  <img src="https://img.shields.io/badge/Design-Pure%20Cyber--Dark-0f172a?style=for-the-badge" alt="Design">
</p>

---

## 🚀 Overview

**MangaCuy** is a high-performance, premium digital comic library platform built with a sophisticated **"Pure Cyber-Dark"** aesthetic. Designed for maximum visual comfort and an elite reading experience, it eliminates distractions by focusing on a deep, dark, and immersive interface.

### ✨ Highlights
- 🌑 **Pure Cyber-Dark Design**: A curated dark aesthetic with neon accents and deep slate tones for eye-comfort.
- 🪟 **Glassmorphism UI**: High-end interface using frosted glass effects, backdrop blurs, and dynamic shadows.
- ⚡ **High Velocity Feed**: Optimized comic listing with real-time update tracking and "Hot" labels.
- 📖 **Focus Canvas Reader**: Immersive reading experience with "Technical Telemetry" layout.
- 🛠️ **Terminal-Style Admin Dashboard**: A sleek command center for managing comic metadata, chapters, and global settings.
- 🔍 **Intelligent Search**: Real-time suggestion engine with terminal-style visual feedback.

---

## 🏗️ Technology Stack

| Layer | Technology | Version | Description |
| :--- | :--- | :--- | :--- |
| **Core Framework** | [Laravel](https://laravel.com) | `^10.10` | High-performance PHP engine |
| **Styling Engine** | [Tailwind CSS](https://tailwindcss.com) | `^3.4` | Utility-first "Cyber-Dark" styling |
| **Interactivity** | [Alpine.js](https://alpinejs.dev) | `v3.x` | Ultra-light micro-interactions |
| **Build Tooling** | [Vite](https://vitejs.dev) | `^5.0` | Ultra-fast asset compilation |
| **Database** | MySQL | `8.0+` | Reliable relational data storage |
| **Typography** | Plus Jakarta Sans | *N/A* | Modern & Premium font system |

---

## 🛠️ System Requirements

- **PHP**: `^8.1`
- **Node.js**: `18.x` or higher
- **Web Server**: Laragon / Apache / Nginx
- **Database**: MySQL 8.0 / MariaDB 10.4+

---

## 📥 Installation Guide

Follow these protocols to initialize **MangaCuy Node #012**:

### 1. Clone & Setup
```bash
git clone https://github.com/Tomi-012/MangaCuy.git
cd MangaCuy
```

### 2. Dependency Modules
```bash
# Backend Setup
composer install

# Frontend Setup
npm install
```

### 3. Environment Config
```bash
cp .env.example .env
```
> [!IMPORTANT]
> Configure your database in `.env`:
> - `DB_DATABASE=manga_cuy`
> - `DB_USERNAME=root`
> - `DB_PASSWORD=` (Leave blank if using Laragon)

### 4. Create Database
Open your database manager (HeidiSQL/phpMyAdmin) and run:
```sql
CREATE DATABASE manga_cuy;
```

### 5. System Boot
```bash
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

---

## 🛰️ Running the Platform

### Development Mode
```bash
# Terminal A (App)
php artisan serve

# Terminal B (Assets)
npm run dev
```

### Production Mode
```bash
npm run build
```

---

## 📂 Project Navigation

- `app/` — Backend Logic & Models
- `resources/views/frontend/` — Immersive User Interface
- `resources/views/admin/` — Admin Command Center
- `resources/css/` — Design Tokens & Core Styling
- `routes/` — Application Networking

---

## 🛡️ License

MangaCuy is open-sourced software licensed under the **MIT license**.

---

<p align="center">
  <font size="2"><i>&copy; 2026 MangaCuy Node #012. System status: <b>Operational</b>.</i></font>
</p>

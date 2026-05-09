# SoulSync: Holistic Mental Wellness & Community Support Platform

## Project Overview
**SoulSync** is a professional-grade web application designed to promote mental well-being through reflection, gratitude, and community support. Built with Laravel, it provides users with a safe space to document their thoughts, interact with a supportive community, and visualize their emotional journey through data analytics.

## Key Features
- **Secure Authentication:** Full user lifecycle management (Register, Login, Profile) using Laravel Breeze.
- **Dynamic Community Feed:** A real-time board of reflections (Sparks) with category filtering and social interactions (Ignites/Likes).
- **Personal Wellness Dashboard:** Advanced data visualization using Chart.js to track mood trends and activity distribution.
- **Smart Categorization:** Organized reflections into domains like Personal Growth, Work, Health, and Social.
- **Premium UI/UX:** A modern, glassmorphic interface designed for a calm and premium user experience.

## Technical Stack
- **Backend:** Laravel 11/13, MySQL
- **Frontend:** Blade, Vanilla CSS (Premium Custom Design), Tailwind CSS (Auth)
- **Analytics:** Chart.js
- **Auth:** Laravel Breeze

## Implementation Details
- **Architecture:** Model-View-Controller (MVC) with specialized Service-like Controllers for analytics.
- **Database Schema:** Relational design with foreign key constraints and optimized queries for analytics.
- **Data Visualization:** Real-time generation of charts based on user activity and mood scores.

## Installation & Setup
1. **Clone & Install:**
   ```bash
   composer install
   npm install && npm run build
   ```
2. **Environment:**
   Configure `.env` with your MySQL credentials.
3. **Database:**
   ```bash
   php artisan migrate --seed
   ```
4. **Run:**
   ```bash
   php artisan serve
   ```

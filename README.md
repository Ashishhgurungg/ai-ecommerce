# AI Solutions (AI Studio)

A Laravel 12 web application for an AI-solutions company. It has a public marketing site (home, about, services, articles, galleries, events, FAQ, contact) and a logged-in management area where an admin can create and edit all of that content, review customer inquiries, moderate reviews and see event registrations. An AI chatbot widget on the public pages talks to a separate FastAPI service.

---

## Table of contents

1. [Features](#features)
2. [Tech stack](#tech-stack)
3. [Requirements](#requirements)
4. [Installation (XAMPP on Windows)](#installation-xampp-on-windows)
5. [Running the app](#running-the-app)
6. [AI chatbot (FastAPI backend)](#ai-chatbot-fastapi-backend)
7. [How to use the app](#how-to-use-the-app)
8. [Routes overview](#routes-overview)
9. [Database tables](#database-tables)
10. [Project structure](#project-structure)
11. [Running tests](#running-tests)
12. [Troubleshooting](#troubleshooting)

---

## Features

**Public site**
- Home page with approved customer reviews
- Services list with 1–5 star ratings (one rating per IP address per service)
- Articles, galleries (multi-image) and events pages
- Event registration form (name, email, phone)
- Contact / inquiry form
- Review submission form (reviews wait for admin approval)
- About and FAQ pages
- Floating AI chatbot widget (needs the FastAPI service, see below)

**Management area (login required)**
- Dashboard with counters: services, articles, galleries, events, attendees, inquiries
- Create, edit and delete services, articles, galleries and events (with image upload)
- View and delete contact inquiries
- Approve, hide or delete reviews
- View and remove event attendees
- Profile page (update name and email, change password, delete account)
- Authentication scaffolding from Laravel Breeze (register, login, forgot/reset password)
- Destructive actions (delete) ask the user to confirm their password first

## Tech stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.2+, Laravel 12 |
| Auth | Laravel Breeze |
| Database | MySQL / MariaDB (XAMPP) |
| Frontend | Blade templates, Tailwind CSS 3, Alpine.js, Vite 7 |
| Extras | Font Awesome, SwiperJS (via CDN), Google Fonts |
| Chatbot | Separate FastAPI service (not in this repository) |

## Requirements

Install these before you start:

| Tool | Version | Notes |
|---|---|---|
| [XAMPP](https://www.apachefriends.org/) | with **PHP 8.2 or newer** | Provides Apache, MySQL and PHP |
| [Composer](https://getcomposer.org/) | 2.x | PHP dependencies |
| [Node.js](https://nodejs.org/) | 18 or newer (LTS recommended) | Builds the CSS/JS with Vite |
| [Git](https://git-scm.com/) | any | To clone the project |

Check your versions in a terminal:

```bash
php -v
composer -V
node -v
npm -v
```

> If `php -v` is not recognised, add `C:\xampp\php` to your Windows **PATH** environment variable and open a new terminal. If it shows a version lower than 8.2, install a newer XAMPP release; Laravel 12 will not run on older PHP.

PHP extensions needed (all enabled by default in XAMPP; check `C:\xampp\php\php.ini` if something is missing): `mbstring`, `openssl`, `pdo_mysql`, `fileinfo`, `curl`, `zip`, `tokenizer`, `ctype`.

---

## Installation (XAMPP on Windows)

### 1. Start XAMPP services

Open the **XAMPP Control Panel** and start **Apache** and **MySQL**.

### 2. Clone the project

Clone anywhere you like. Putting it inside `C:\xampp\htdocs` is convenient if you plan to use Apache (Option B below).

```bash
cd C:\xampp\htdocs
git clone <your-repository-url> ai-ecommerce
cd ai-ecommerce
```

### 3. Create the database

Open **http://localhost/phpmyadmin**, click **New**, and create a database named `project` (collation `utf8mb4_unicode_ci`).

Or from the terminal:

```bash
C:\xampp\mysql\bin\mysql -u root -e "CREATE DATABASE project CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 4. Install PHP dependencies

```bash
composer install
```

### 5. Create the environment file

```bash
copy .env.example .env
php artisan key:generate
```

Open `.env` and check the database section. XAMPP's default MySQL user is `root` with an empty password:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project
DB_USERNAME=root
DB_PASSWORD=
```

Also set the app name and URL (use the URL you will actually open in the browser, see [Running the app](#running-the-app)):

```env
APP_NAME="AI Solutions"
APP_URL=http://localhost:8080
```

> This project uses the **database** driver for sessions, cache and queues, so the migrations in the next step must run before the site will load.

### 6. Run the migrations (and optionally seed a test user)

```bash
php artisan migrate
php artisan db:seed
```

The seeder creates one test account:

| Email | Password |
|---|---|
| `test@example.com` | `password` |

Change this password or delete the account before putting the app anywhere public. You can also just register your own account at `/register`.

### 7. Link the storage folder (needed for uploaded images)

```bash
php artisan storage:link
```

This creates `public/storage` pointing at `storage/app/public`, where uploaded service, article, gallery and event images are saved. On Windows, if you get a permissions error, open the terminal **as Administrator** and run it again.

### 8. Install and build the frontend assets

```bash
npm install
npm run build
```

> The layouts use `@vite(...)`, so the app shows a "Vite manifest not found" error until you run `npm run build` (or keep `npm run dev` running while developing).

### Shortcut

After creating the database (step 3), `composer setup` runs steps 4, 5 (copy + key), 6 (migrate only), and 8 in one go. You still need to edit `.env` if your DB settings differ and run `php artisan storage:link`.

---

## Running the app

You can use **either** option. Both use XAMPP's MySQL.

### Option A: Laravel's built-in server (simplest)

You do not need Apache for this, only MySQL.

```bash
php artisan serve --port=8080
```

Open **http://localhost:8080** and set `APP_URL=http://localhost:8080` in `.env`.

> Use port `8080` (not the default `8000`) because the chatbot widget expects the FastAPI service on port `8000`.

For frontend development with hot reload, run this in a second terminal:

```bash
npm run dev
```

### Option B: Apache virtual host (closest to production)

1. Open `C:\xampp\apache\conf\httpd.conf` and make sure this line is **not** commented out:
   ```apache
   Include conf/extra/httpd-vhosts.conf
   ```
2. Edit `C:\xampp\apache\conf\extra\httpd-vhosts.conf` and add:
   ```apache
   # Keep plain http://localhost working for phpMyAdmin etc.
   <VirtualHost *:80>
       ServerName localhost
       DocumentRoot "C:/xampp/htdocs"
   </VirtualHost>

   <VirtualHost *:80>
       ServerName ai-ecommerce.test
       DocumentRoot "C:/xampp/htdocs/ai-ecommerce/public"
       <Directory "C:/xampp/htdocs/ai-ecommerce/public">
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```
   Adjust the path if you cloned the project somewhere else.
3. Open Notepad **as Administrator**, edit `C:\Windows\System32\drivers\etc\hosts` and add:
   ```
   127.0.0.1   ai-ecommerce.test
   ```
4. Set `APP_URL=http://ai-ecommerce.test` in `.env`.
5. **Restart Apache** from the XAMPP Control Panel and open **http://ai-ecommerce.test**.

Apache's `mod_rewrite` is enabled by default in XAMPP, and Laravel's `public/.htaccess` handles the routing.

> Avoid opening the project as `http://localhost/ai-ecommerce/public`; always point the web server at the `public` folder.

---

## AI chatbot (FastAPI backend)

The chat bubble (bottom-right of the public pages) is defined in `resources/views/components/chatbot.blade.php`. It does **not** use Laravel for answers. It sends the message from the browser to a separate FastAPI service:

```
POST http://127.0.0.1:8000/chat
Content-Type: application/json

{ "message": "Hello" }
```

and expects a JSON reply:

```json
{ "response": "Hi! How can I help?" }
```

The FastAPI project is **not part of this repository**, so start your own chatbot service before testing the widget. If it is not running, the widget shows "Could not connect to the AI server. Is it running?"; the rest of the site keeps working.

Because the browser calls the API from a different origin, the FastAPI app must allow **CORS** for the URL you use for this site. A minimal compatible service for testing:

```python
# main.py
from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel

app = FastAPI()

app.add_middleware(
    CORSMiddleware,
    allow_origins=[
        "http://localhost:8080",
        "http://127.0.0.1:8080",
        "http://ai-ecommerce.test",
    ],
    allow_methods=["*"],
    allow_headers=["*"],
)

class ChatRequest(BaseModel):
    message: str

@app.post("/chat")
def chat(req: ChatRequest):
    return {"response": f"You said: {req.message}"}
```

```bash
pip install fastapi uvicorn
uvicorn main:app --port 8000 --reload
```

To point the widget at a different host or port, change the `fetch("http://127.0.0.1:8000/chat", ...)` line in `chatbot.blade.php`.

---

## How to use the app

### As a visitor (no login)

| Page | URL | What you can do |
|---|---|---|
| Home | `/` | Landing page and approved reviews |
| Services | `/services` | Browse services and rate them 1–5 stars (once per IP) |
| Articles | `/articles` | Read articles; open one at `/article/{id}` |
| Galleries | `/galleries` | Browse image galleries; open one at `/galleries/{id}` |
| Events | `/event` | Browse events; see details at `/event/details/{id}` |
| Event registration | `/events/{id}` | Register for an event |
| Contact | `/contact` | Send an inquiry (all fields are required) |
| Leave a review | `/review` | Submit a review. It appears on the home page only after an admin approves it |
| About / FAQ | `/about`, `/faq` | Static information pages |

### As an admin (login required)

1. Register at `/register` or log in at `/login` (for example with the seeded `test@example.com` / `password`).
2. You land on the **Dashboard** (`/dashboard`) showing totals for each content type.
3. Use the top navigation to manage content:
   - **Services / Articles / Galleries / Events** open the "all" lists (`/all-services`, `/all-articles`, `/all-galleries`, `/all-events`) with edit and delete actions.
   - **Inquiries** (`/inquiries`) lists messages from the contact form; delete the ones you have handled.
   - **Reviews** (`/reviews`) lists submitted reviews; set each one to approved or pending, or delete it.
4. Use the **New** dropdown in the navigation to create a Gallery, Article, Service or Event.
5. For events, open the attendees list at `/events/{id}/attendees` to see who registered, and remove entries if needed.
6. Deleting anything asks you to re-enter your password.

**Image uploads:** JPG/JPEG/PNG up to 2 MB. Files are stored in `storage/app/public/{services|articles|galleries|events}` and served through the `public/storage` link.

---

## Routes overview

| Method | URL | Purpose | Login required |
|---|---|---|---|
| GET | `/` | Home | No |
| GET | `/about`, `/faq`, `/contact` | Static pages | No |
| GET | `/services`, `/articles`, `/galleries`, `/event` | Public listing pages | No |
| GET | `/article/{id}`, `/galleries/{id}`, `/event/details/{id}` | Detail pages | No |
| POST | `/services/{id}/rate` | Rate a service | No |
| GET/POST | `/events/{id}`, `/events/{id}/register` | Event registration | No |
| POST | `/submit-contact` | Send inquiry | No |
| GET/POST | `/review`, `/submit-review` | Submit a review | No |
| GET | `/dashboard` | Admin dashboard | Yes |
| GET | `/inquiries`, `/inquiries-delete/{id}` | Manage inquiries | Yes |
| GET | `/events/{id}/attendees`, `/events/attendees/delete/{id}` | Manage attendees | Yes |
| GET/PATCH/DELETE | `/profile` | Profile settings | Yes |
| GET | `/delete-service/{id}`, `/delete-article/{id}`, `/delete-gallery/{id}`, `/delete-event/{id}`, `/delete-review/{id}` | Delete content | Yes + password confirmation |
| GET/POST | `/add-services`, `/article-form`, `/gallery-form`, `/add-events` | Create content | See note |
| GET/POST | `/all-services`, `/all-articles`, `/all-galleries`, `/all-events`, `/update-*` | List and edit content | See note |
| GET | `/reviews`, POST `/reviews/{id}/status` | Moderate reviews | See note |
| — | `/register`, `/login`, `/forgot-password`, `/reset-password/{token}` | Authentication (Breeze) | Guests only |

> **Note:** the create, edit, list and review-moderation routes are currently defined without the `auth` middleware in `routes/web.php`, so they can be opened without logging in. Add `->middleware('auth')` (or wrap them in a `Route::middleware('auth')->group(...)`) before deploying this anywhere public.

## Database tables

| Table | Purpose |
|---|---|
| `users` | Admin accounts (Breeze) |
| `sessions`, `cache`, `jobs` | Laravel's database-backed session, cache and queue drivers |
| `services` | name, description, image, price |
| `ratings` | 1–5 ratings per service, with the rater's IP address |
| `articles` | title, description, image |
| `galleries` | title, description, JSON list of images |
| `events` | name, description, date, image, price |
| `event_registrations` | name, email, phone, linked to an event |
| `contacts` | Contact-form inquiries |
| `reviews` | Customer reviews with a `status` (0 = pending, 1 = approved) |

## Project structure

```
app/
  Http/Controllers/   Home, Service, Article, Gallery, Event, Review, Contact, Profile + Auth/
  Http/Requests/      Form requests (AddServices, LoginRequest, ProfileUpdateRequest)
  Models/             Service, Rating, Article, Gallery, Event, EventRegistration, Contact, Review, User
database/
  migrations/         Table definitions
  seeders/            DatabaseSeeder (creates the test user)
resources/
  views/              Blade templates (services/, articles/, galleries/, events/, review/, auth/, profile/)
  views/components/   Reusable pieces, including chatbot.blade.php
  views/headerfooter/ Public-page header, footer and <head> boilerplate
  css/, js/           Tailwind and Alpine entry points (built by Vite)
routes/
  web.php             Application routes
  auth.php            Breeze authentication routes
public/               Web root (index.php, images, build/ and storage/ after setup)
storage/app/public/   Uploaded images (exposed through public/storage)
```

## Running tests

Tests use an in-memory SQLite database (see `phpunit.xml`), so the `pdo_sqlite` PHP extension must be enabled.

```bash
php artisan test
```

---

## Troubleshooting

| Problem | Fix |
|---|---|
| `Vite manifest not found` | Run `npm install` then `npm run build` (or keep `npm run dev` running). |
| `SQLSTATE[HY000] [1049] Unknown database 'project'` | Create the database (step 3) or change `DB_DATABASE` in `.env`. |
| `SQLSTATE[HY000] [2002] Connection refused` | Start **MySQL** in the XAMPP Control Panel and check `DB_HOST` / `DB_PORT`. |
| `Base table or view not found: sessions` | Run `php artisan migrate`. |
| Uploaded images are broken | Run `php artisan storage:link`. If `public/storage` already exists as a normal folder, delete it first. |
| `Your PHP version does not satisfy the requirement` during `composer install` | XAMPP's PHP is older than 8.2; install a newer XAMPP. |
| `No application encryption key has been specified` | Run `php artisan key:generate`. |
| 404 on every page except `/` (Apache) | Make sure `DocumentRoot` points to the `public` folder, `AllowOverride All` is set, and Apache was restarted. |
| Chatbot says "Could not connect to the AI server" | Start the FastAPI service on port 8000 and allow your site's origin in its CORS settings. |
| Chatbot request blocked by CORS (browser console) | Add the exact origin you are using (scheme + host + port) to `allow_origins`. |
| Changes to `.env` are ignored | Run `php artisan config:clear`. |
| Password-reset emails never arrive | `MAIL_MAILER=log` writes emails to `storage/logs/laravel.log`. Configure SMTP in `.env` to send real emails. |

Useful commands:

```bash
php artisan route:list        # see every route
php artisan optimize:clear    # clear config, route, view and cache
php artisan migrate:fresh --seed   # reset the database (deletes all data!)
```

## License

This project is built on the Laravel framework, which is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
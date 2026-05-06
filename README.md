# Booking App

Laravel application for managing hotels, rooms, and availability search (web UI + JSON API with Laravel Sanctum).

---

## Step 1 — Get the code (Git)

**Option A — Clone an existing remote**

Replace the URL with your real repository when you have one (GitHub, GitLab, Bitbucket, etc.):

```bash
git clone https://github.com/YOUR_USERNAME/booking-app.git
cd booking-app
```

**Option B — This folder is not a clone yet**

Initialize Git and add your remote after you create an empty repository on your host:

```bash
cd booking-app
git init
git add .
git commit -m "Initial commit"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/booking-app.git
git push -u origin main
```

There is no fixed “official” URL until you host the project yourself; use your own clone URL in place of the placeholders above.

---

## Step 2 — Prerequisites

- PHP **7.3+** or **8.x** with extensions Laravel needs (`openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath` recommended)
- [Composer](https://getcomposer.org/)
- A database: **MySQL/MariaDB** (typical) or **SQLite** for a quick local setup

---

## Step 3 — Install PHP dependencies

```bash
composer install
```

---

## Step 4 — Environment file

Copy the example env file and generate an application key:

**Windows (PowerShell / CMD)**

```powershell
copy .env.example .env
```

**macOS / Linux**

```bash
cp .env.example .env
```

Then:

```bash
php artisan key:generate
```

Edit `.env` and set at least:

| Variable | Description |
|----------|-------------|
| `APP_NAME` | Shown in the UI (default: `Booking App`) |
| `APP_URL` | Must match how you open the app (e.g. `http://127.0.0.1:8000`) |
| `DB_*` | Database connection (see Step 5) |

---

## Step 5 — Database

### MySQL / MariaDB

Create an empty database, then in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=booking_app
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

### SQLite (quick local option)

1. Create an empty database file:

   ```bash
   type nul > database\database.sqlite
   ```

   On macOS/Linux: `touch database/database.sqlite`

2. In `.env`:

   ```env
   DB_CONNECTION=sqlite
   ```

   Comment out or remove `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` if your Laravel version expects only `sqlite` + path (default file is `database/database.sqlite`).

---

## Step 6 — Migrate and seed (sample data)

```bash
php artisan migrate --seed
```

This runs `SampleDataSeeder`, which creates:

- **Demo user** (web + API login):  
  - Email: `demo@booking-app.test`  
  - Password: `password`
- **Hotels** in Lisbon and Porto with several **rooms** (prices, occupancy, inventory).

To wipe tables and rebuild:

```bash
php artisan migrate:fresh --seed
```

---

## Step 7 — Run the application

```bash
php artisan serve
```

Open in a browser:

- **Web:** [http://127.0.0.1:8000](http://127.0.0.1:8000) — login with the demo user above.

---

## Step 8 — API base URL

All API routes are prefixed with `/api` (see `routes/api.php`).

Default local base URL:

```text
http://127.0.0.1:8000/api
```

---

## Step 9 — Postman

1. Install [Postman](https://www.postman.com/downloads/).
2. **Import collection:** `postman/Booking_App.postman_collection.json`
3. **Import environment (optional):** `postman/Booking_App.local.postman_environment.json` — select **Booking App — Local** in the environment dropdown.
4. Run **Auth → Login** first (uses the seeded demo user). On success, the collection **Tests** script saves the Sanctum `token` into the collection variable `token`.
5. Call **Get current user**, **Hotels**, **Rooms**, or **Search** — they use **Bearer** auth with `{{token}}`.

If `token` is empty, Login failed or variables were cleared — run Login again.

**Collection variables (editable in Postman):**

| Variable   | Purpose |
|------------|---------|
| `base_url` | e.g. `http://127.0.0.1:8000` |
| `token`    | Filled automatically after Login |

---

## API overview (authenticated routes use `Authorization: Bearer {token}`)

| Method | Path | Auth | Description |
|--------|------|------|-------------|
| `POST` | `/api/login` | No | Body: `email`, `password`, optional `device_name` — returns `token` |
| `GET`  | `/api/user` | Yes | Current user |
| `POST` | `/api/logout` | Yes | Revoke current token |
| `GET`  | `/api/hotels` | Yes | Query: `city`, `rating`, `per_page` |
| `POST` | `/api/hotels` | Yes | Create hotel (JSON) |
| `POST` | `/api/rooms` | Yes | Create room (JSON) |
| `GET`  | `/api/search` | Yes | Query: `city`, `checkin_date`, `checkout_date`, `guests` |

---

## Troubleshooting

- **`php` not found:** Add PHP to your system `PATH`, or call PHP by full path (e.g. XAMPP: `C:\xampp\php\php.exe artisan ...`).
- **403 / CSRF on web:** Use the web login form; API uses JSON + Sanctum, not session cookies for token routes.
- **Config cached with old `APP_NAME`:** `php artisan config:clear`

---

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

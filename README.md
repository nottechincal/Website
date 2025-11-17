# Rapid Tech Solutions Theme

This repository contains the bespoke Rapid Tech Solutions WordPress theme plus the assets needed to run a full local WordPress stack for development, preview, and QA.

## Prerequisites

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) or Docker Engine 24+
- [Docker Compose V2](https://docs.docker.com/compose/) (bundled with Docker Desktop)
- Optional: [mkcert](https://github.com/FiloSottile/mkcert) or your SSL tool of choice if you want HTTPS locally
- Optional: PHP 8.2+ and Composer if you prefer to interact with the theme code outside the container

## Getting started

1. **Copy environment variables**

   ```bash
   cp .env.example .env
   ```

   Adjust passwords or ports as needed. The defaults are meant for local development only.

2. **Boot the stack**

   ```bash
   docker compose up -d
   ```

   - WordPress is available at [http://localhost:8080](http://localhost:8080)
   - phpMyAdmin is available at [http://localhost:8081](http://localhost:8081)

3. **Complete the WordPress installer**

   Visit `http://localhost:8080` the first time, create your admin user, and log in.

4. **Activate the Rapid Tech Solutions theme**

   - In the dashboard go to **Appearance → Themes**
   - The theme folder `new-themeWORKING` is mounted into the container automatically
   - Click **Activate** to apply it to the site

5. **(Optional) Install theme PHP dependencies**

   If you need to update Composer dependencies (already installed in `vendor/`), run:

   ```bash
   docker compose exec wordpress bash -lc 'cd wp-content/themes/new-themeWORKING && composer install'
   ```

## Project layout

```
.
├── README.md                    # You are here
├── docker-compose.yml           # Local WordPress, MySQL, and phpMyAdmin stack
├── new-themeWORKING/
│   └── new-themeWORKING/        # The WordPress theme (PHP templates, CSS, JS, vendor libs)
└── .env.example                 # Safe defaults for Docker Compose
```

## Useful commands

| Task | Command |
| --- | --- |
| Start stack | `docker compose up -d` |
| Stop stack | `docker compose down` |
| Tail logs | `docker compose logs -f wordpress` |
| Run PHP lint | `docker compose exec wordpress bash -lc "php -l wp-content/themes/new-themeWORKING/index.php"` |
| Run Composer scripts | `docker compose exec wordpress bash -lc "cd wp-content/themes/new-themeWORKING && composer <script>"` |

## Troubleshooting

- **Port already in use** – change `HOST_HTTP_PORT`/`HOST_PHPMYADMIN_PORT` in `.env` and restart the stack.
- **Database reset** – stop the stack and run `docker compose down -v` to wipe the named volumes.
- **Slow first load** – the `wp_data` volume initializes WordPress core on first boot; subsequent starts are instant.
- **File permissions** – files edited on the host are shared directly into the container, so there is no sync delay.

Happy building!

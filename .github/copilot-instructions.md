# Copilot / AI Agent Instructions — Game Zone Final

Purpose: give an AI coding agent the minimal, actionable context to be productive in this PHP monolith.

- **Quick start (run & DB)**: Project runs on a local WAMP/Apache+PHP stack. Import `database/schema.sql` into MySQL, then open `http://localhost/game-zone-final/`. Update DB credentials in `includes/db.php` if needed (defaults: `root` + empty password).

- **High-level architecture**: simple PHP monolith with UI pages in the repo root (e.g. `index.php`, `main.php`, `game.php`, `gow.php`, `rdr2.php`) and shared partials in `includes/`:
  - `includes/db.php` — PDO database connection; `$pdo` is the shared PDO instance.
  - `includes/header.php` / `includes/footer.php` — page chrome and nav.
  - `css/` — per-page styles (e.g. `main.css`, `game.css`).
  - `images/` — static assets used by pages.

- **Coding patterns & conventions**:
  - Procedural PHP files (no framework). Pages typically `include` the header/footer and then output page-specific HTML/PHP.
  - DB operations use the global `$pdo` from `includes/db.php` (PDO configured with exceptions and `PDO::FETCH_ASSOC`). Use prepared statements when inserting/querying user data.
  - Strings/content are in Persian across templates — preserve encoding/RTL where appropriate.
  - Static assets are referenced by relative paths (e.g. `css/`, `images/`).

- **Where to modify / add features** (examples):
  - Add a new page: copy an existing page like `gow.php`, update its markup and include header/footer with `include 'includes/header.php';` and `include 'includes/footer.php';`.
  - Add a navigation item: update `includes/header.php` (and optionally `includes/footer.php`).
  - Add DB table/schema changes: edit `database/schema.sql` and provide clear migration steps in the PR description.

- **Developer workflows (no build step)**:
  - Start: place project under WAMP `www` and use browser to view pages.
  - DB: import `database/schema.sql` via phpMyAdmin or `mysql` CLI.
  - Debugging: enable `display_errors` in `php.ini` or add at the top of a page during dev:

```php
ini_set('display_errors', 1);
error_reporting(E_ALL);
```

- **Search locations for behavior**:
  - Page logic: root PHP files (e.g. `index.php`, `main.php`, `game.php`).
  - Shared UI: `includes/header.php`, `includes/footer.php`.
  - DB config: `includes/db.php`.
  - Schema reference: `database/schema.sql`.

- **Integration & external deps**: none external by default — only local MySQL + PHP. If introducing external services, keep keys out of repo and document env changes in a new `README.md` section or PR.

- **Security & deployment notes**:
  - `includes/db.php` stores DB creds; ensure production credentials are not checked in.
  - Use prepared statements for user input; sanitized outputs for HTML.

- **PR / editing recommendations for agents**:
  - Make minimal, focused changes. When changing DB schema, include migration steps and update `database/schema.sql`.
  - For UI changes, update the page-specific CSS in `css/` rather than modifying a single global file.
  - Include example diff snippets in PR description and reference files changed (e.g. `includes/db.php`, `includes/header.php`).

If anything here is unclear or you'd like a different level of detail (examples for creating a new game page or a DB migration template), tell me which section to expand.

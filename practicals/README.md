# PHP + MySQL + XML + Express Practical 2–6

These practicals are added alongside the existing Shopping Cart project. The PHP files use the parent project's `config.php`, so they use the same `shopping_cart` database and credentials.

## Before you start
1. Put this folder inside `C:\xampp\htdocs\php_shopping_cart\practicals` (if the project is already in htdocs, simply copy/merge the `practicals` folder there).
2. Open `C:\xampp\htdocs\php_shopping_cart\config.php` and make sure `$dbpass` matches your MySQL/MariaDB password. Keep your existing database settings.
3. In phpMyAdmin, select database `shopping_cart`, open the SQL tab, paste the contents of `students.sql`, and click Go. This creates the `students` table.
4. Make sure PHP extensions `simplexml`, `dom`, and `curl` are enabled. GD is only needed by the Shopping Cart image upload.

## Practical 2 — XML to MySQL
1. Open `http://localhost/php_shopping_cart/practicals/xml_to_mysql.php`.
2. It reads `students.xml` and inserts each student. Re-running it updates matching roll numbers instead of creating duplicate primary keys.
3. In phpMyAdmin, open `shopping_cart` → `students` → Browse to verify the rows.

## Practical 3 — MySQL to XML
1. Open `http://localhost/php_shopping_cart/practicals/mysql_to_xml.php`.
2. It writes `students_export.xml` in this folder.
3. Click the link to view the exported XML.

## Practical 4 — List files in a directory
1. Open `http://localhost/php_shopping_cart/practicals/list_files.php`.
2. It lists files in `practicals/sample_files`.
3. Add another `.txt` file in that folder and refresh the page.

## Practical 5 — Call Express REST API in PHP
1. Install Node.js LTS if it is not already installed.
2. Open Command Prompt and run:
   ```bat
   cd C:\xampp\htdocs\php_shopping_cart\practicals\express-api
   npm install
   npm start
   ```
3. Keep that Command Prompt open. Check `http://localhost:3000/api/message` in your browser; it should show JSON.
4. In another browser tab open `http://localhost/php_shopping_cart/practicals/php_call_express.php`.
5. PHP uses cURL to call the Express endpoint. If it says cURL is disabled, enable `extension=curl` in the active `php.ini` and restart Apache.

## Practical 6 — Call PHP REST API in Express
1. Keep Apache running and ensure the `students` table exists.
2. Keep the Node server running using `npm start` as above.
3. Open `http://localhost/php_shopping_cart/practicals/api/students.php` to test the PHP JSON API directly.
4. Open `http://localhost:3000/call-php-api`. Express calls the PHP API and returns its JSON response.

## Common checks
- If PHP says database access denied, correct `$dbpass` in the parent `config.php`.
- If `students` table is missing, run `students.sql` in the `shopping_cart` database.
- If port 3000 is busy, change `PORT` in `server.js` and update the URL in `php_call_express.php` to match.
- `fetch()` is built into modern Node.js (Node 18+ recommended).
- These are beginner learning examples, not production-ready public APIs. Do not expose them publicly without authentication, validation, and security controls.

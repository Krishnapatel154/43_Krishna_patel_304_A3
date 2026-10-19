# PHP Shopping Cart (starter project)

## Requirements
- XAMPP with Apache and MySQL/MariaDB
- PHP with PDO MySQL enabled
- PHP GD extension enabled for image resizing
- Browser

## Install
1. Copy the `php_shopping_cart` folder to `C:\xampp\htdocs\`.
2. Start Apache and MySQL from XAMPP Control Panel.
3. Open `http://localhost/phpmyadmin/`.
4. Select the SQL tab, open `database.sql` in a text editor, copy all SQL into the SQL tab and run it.
5. Visit `http://localhost/php_shopping_cart/`.
6. Create the first demo admin by visiting `http://localhost/php_shopping_cart/setup_admin.php` once.
7. Admin login: `http://localhost/php_shopping_cart/admin_login.php`
   - Username: `admin`
   - Password: `Admin@123`
8. IMPORTANT: delete `setup_admin.php` immediately after creating the admin.

## Image resizing
In XAMPP, open the active `php.ini`, find `;extension=gd`, remove the leading semicolon, save, and restart Apache. The exact line may be `extension=gd`.

## Included
- Category listing and admin category create/read/update/delete
- Product listing and admin product create/read/update/delete
- Product image upload and resizing on product creation (GD required)
- User registration with simple session-number CAPTCHA
- User login/logout
- AJAX category product loading with pagination
- Basic shopping cart quantity updates/removal

## Notes
- This is a learning/demo project. The CAPTCHA is a simple numeric session challenge, not a production CAPTCHA service.
- Cart is session-based and does not process payments or save orders.
- Product edit currently edits name/category/price; image replacement is not implemented in the edit form.
- Before production, add CSRF protection, stronger upload handling, rate limiting, and hardened authorization.

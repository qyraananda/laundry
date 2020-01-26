# Laundry
Aplikasi Laundry menggunakan CodeIgniter

# CodeIgniter
Adalah framework PHP dengan model MVC ntuk membangun website dinamis. CodeIgniter memudahkan developer web untuk membuat aplikasi web dengan cepat mudah dibandingkan dengan membuatnya dari awal.
Untuk mendownload CodeIgniter di https://codeigniter.com/en/download.

# htaccess
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]


## FAPv5

- CSS declarations are stored in /resources/css/app.css and /resources/css/fap/*.css files.
- Javascript functions/classes/.. are stored in /resources/js/app.js and /resources/css/fap/*.js files

1. cp .env.example .env
2. composer install
3. npm install
4. php:artisan key:generate
5. edit apache2 sites-enabled config
6. php artisan storage:link


# Setup FAP
1. Install Ubuntu 22.04
2. Install Firefox, git, composer, apache2, php8.1, nodejs, npm, teamviewer
3. Allow media to be played in Firefox
4. change upload_max_filesize = 20m post_max_size = 20m in php.ini
5. sudo apt-get install ttf-mscorefonts-installer

# Notes
- this project is using https://github.com/Lazer-Database/Lazer-Database as a database.
- this project is using https://github.com/neoteknic/Phue for the philips hue connection.

# TODO
- Bootup check (are all env vars set correctly)
## FAPv5

- CSS declarations are stored in /resources/css/app.css and /resources/css/fap/*.css files.
- Javascript functions/classes/.. are stored in /resources/js/app.js and /resources/css/fap/*.js files


# Setup FAP
1. Install Ubuntu 22.04
2. Install Firefox, git, composer, apache2, php8.1, nodejs, npm, teamviewer
3. Allow media to be played in Firefox
4. change upload_max_filesize = 20m post_max_size = 20m in php.ini
5. sudo apt-get install ttf-mscorefonts-installer
6. sudo apt install php8.1-dom php8.1-curl curl && sudo service apache2 restart
7. curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
8. sudo apt install nodejs
9. cp .env.example .env
10. php artisan key:generate
11. php artisan storage:link
12. sudo service deconz-gui stop && sudo service deconz start
13. set zigbee channel to 25 and leave/rejoin network

# Notes
- this project is using https://github.com/Lazer-Database/Lazer-Database as a database.
- this project is using https://github.com/neoteknic/Phue for the philips hue connection.

# TODO
- Bootup check (are all env vars set correctly)
- Screen off images of different airlines
- Light groups are not yet being handled by the deconz and phue integration of the FAP
- make sure all ids are ints
- implement throttle for get lights and groups
- manual showing the bluetooth speaker connection
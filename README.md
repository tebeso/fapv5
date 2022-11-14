## FAPv5

- CSS declarations are stored in /resources/css/app.css and /resources/css/fap/*.css files.
- Javascript functions/classes/.. are stored in /resources/js/app.js and /resources/css/fap/*.js files


# Setup FAP
1. Install Linux (https://phoscon.de/de/raspbee/sdcard) with user tebin
2. Install git
3. clone https://github.com/tebeso/fapv5 to /var/www/html/fapv5
4. sudo su
5. chmod +x /var/www/html/fapv5/setup.sh
6. run /var/www/html/fapv5/setup.sh

# Notes
- this project is using https://github.com/Lazer-Database/Lazer-Database as a database.
- this project is using https://github.com/neoteknic/Phue for the philips hue connection.
- this project is using https://www.npmjs.com/package/websocket for websocket connection.

# TODO
- Bootup check (are all env vars set correctly)
- manual showing the bluetooth speaker connection
- add reinstall databases button
- check every few minutes if hub still paired. If not, remove data from .env file and show message (be aware, could also just be no wifi)
- test bluetooth speaker and device coupling
- temperature rewrite -> alles in invisible ids packen und die target temp nur einmal lesen und dann per ui verändern
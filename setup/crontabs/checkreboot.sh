#!/bin/bash
if [ -f /var/www/html/fapv5/server.restart ]; then
  rm -f /var/www/html/fapv5/server.restart
  /sbin/shutdown -r now
fi

if [ -f /var/www/html/fapv5/server.stop ]; then
  rm -f /var/www/html/fapv5/server.stop
  /sbin/shutdown now
fi

if [ -f /var/www/html/fapv5/fap.stop ]; then
  rm -f /var/www/html/fapv5/fap.stop
  pkill -f chromium
fi

if [ -f /var/www/html/fapv5/fap.restart ]; then
  rm -f /var/www/html/fapv5/fap.restart
  pkill -f chromium
  sleep 3
  su tebin -- chromium-browser http://127.0.0.1:81 --start-fullscreen --kiosk --incognito --noerrdialogs --no-first-run
fi


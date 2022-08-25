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

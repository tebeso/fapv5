apt install -y apache2 git curl &&
apt install -y htop &&
wget -qO /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg &&
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list &&
apt update &&
apt install -y php8.1-common php8.1-cli libapache2-mod-php8.1 libapache2-mod-php8.1 &&
apt install -y php8.1-curl curl php8.1-dom php8.1-xml &&
a2enmod php8.1 &&
a2enmod rewrite &&
apache2 restart &&
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" &&
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer &&
rm -rf composer-setup.php &&
cd /var/www/html &&
curl -fsSL https://deb.nodesource.com/setup_18.x | bash - &&
apt update &&
apt install -y nodejs &&
chown tebin:tebin fapv5 -R &&
cd fapv5 &&
composer install &&
composer update &&
npm install &&
npm run dev &&
cp .env.example .env &&
php artisan key:generate &&
php artisan fap:setup &&
chown tebin:tebin * -R &&
systemctl disable deconz-gui &&
systemctl stop deconz-gui &&
systemctl enable deconz &&
cp setup/crontabs/checkreboot.sh /usr/local/sbin/checkreboot.sh && chmod +x /usr/local/sbin/checkreboot.sh &&
cp setup/crontabs/root /var/spool/cron/crontabs/root &&
cp setup/crontabs/tebin /var/spool/cron/crontabs/tebin &&
cp setup/apache2/apache2.conf /etc/apache2/apache2.conf &&
cp setup/apache2/ports.conf /etc/apache2/ports.conf &&
cp setup/apache2/sites-enabled.conf /etc/apache2/sites-enabled/000-default.conf &&
cp setup/lightdm/lightdm.conf /etc/lightdm/lightdm.conf &&
cp setup/xdg/autostart /etc/xdg/lxsession/LXDE-pi/autostart &&
reboot
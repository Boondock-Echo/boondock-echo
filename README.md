## Setup instructions

### Installing Apache on Ubuntu server


https://ubuntu.com/tutorials/install-and-configure-apache#1-overview

#### Install a VM with Ubuntu 20

```sudo apt update```
```sudo apt install apache2```

Configure the domain to point to the web application

####Setup the virtual host for the web application


We start this step by going into the configuration files directory:

```cd /etc/apache2/sites-available/```

Since Apache came with a default VirtualHost file, let’s use that as a base. (gci.conf is used here to match our subdomain name):

```sudo cp 000-default.conf dev.conf```

Now edit the configuration file:

```sudo nano boondock-dev.conf```

We should have our email in ServerAdmin so users can reach you in case Apache experiences any error:

ServerAdmin yourname@example.com
We also want the DocumentRoot directive to point to the directory our site files are hosted on:

DocumentRoot /var/www/dev/

The default file doesn’t come with a ServerName directive so we’ll have to add and define it by adding this line below the last directive:

ServerName www.boondockdev.com

Activate teh file

```sudo a2ensite boondock-dev.conf```

Reload apache

```sudo service apache2 reload```



## Install Laravel and dependencies

```sudo apt install php libapache2-mod-php php-mbstring php-cli php-bcmath php-json php-xml php-zip php-pdo php-common php-tokenizer php-mysql```

Check PHP Verison 

```php -v```

##Install composer

```curl -sS https://getcomposer.org/installer | php```

```sudo mv composer.phar /usr/local/bin/composer```


###Update Node to Version 18.

## Install Laravel 8

Installation process will create a dev folder. The same folder is used in the Virtual Host settings above

```cd /var/www/html```

```sudo composer create-project laravel/laravel dev```


Set the ownership of the folder

```
sudo chown -R www-data:www-data /var/www/html/dev
sudo chmod -R 775 /var/www/html/dev/storage
```

Check the Laravel version

```
cd dev
php artisan
```

## Configure Apache to Server Laravel

```
sudo nano /etc/apache2/sites-available/dev.conf

```

Add the following lines to the configuration file

<VirtualHost *:80>
ServerName example.com
ServerAdmin kchandel@boondockdev.com
DocumentRoot /var/www/html/dev/public
<Directory /var/www/html/dev>
AllowOverride All
</Directory>
ErrorLog ${APACHE_LOG_DIR}/error.log
CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

 
sudo a2enmod rewrite


#### Setup SSL

```sudo apt-get update
sudo apt-get -y upgrade
sudo apt install -y certbot python3-certbot-apache
```


Obtaining a certificate
For the needs of this post, I assume you have already installed the Apache2 server and configured the virtual host. Example of the most basic virtual host configuration below:

```
<VirtualHost *:443>
    ServerAdmin admin@your-domain.com
    ServerName your-domain.com
    DocumentRoot /var/www/your_project
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

You also have to enable the Apache SSL module and restart your server.

```
sudo a2enmod ssl
sudo service apache2 restart
```


Since we have our virtual host prepared and Certbot installed, we can finally generate the certificate.

```
sudo certbot --apache -d www.boondockdev.com
```

#Hair Salon Code Review
PHP week 3 code review: Database Basic

##Author

This project was created by Erik Tolentino

##Description

This page will allow the user to add stylists to the hair salon, and add clients to each individual stylist. The user has the ability to update the names of both the stylists and the clients, as well as delete all of the stylists with one click.

##Known Bugs
This function to delete a single client at a time does not function completely. User is able to delete the single client, but the page displayed after does not display everything expected. To view that the single client has been deleted, user must navigate back home and then to that specific stylists page to see that the specific client has been deleted.

#Setup

To View:
* Git clone this repository

* From terminal, enter "mysql.server start" to start the MySQL servers and enter mysql shell
* Next enter "mysql -uroot -proot" to set username and password for PhpMyAdmin

* From bash terminal, enter "apachectl start" to start PhpMyAdmin
* In browser, type "localhost:8080/phpmyadmin"
* If prompted, both your username and password are "root"

* From PhpMyAdmin, import "hairsalon" and "hairsalon_test" databases included in hair-salon folder

* From mysql shell in terminal, enter "USE hairsalon" to enter database

* From bash terminal, run "composer install" while in project root folder

* From bash terminal, enter "php -S localhost:8000" while in the web folder

* To view, type "localhost:8000" in browser

#Technologies Used:

* Php
* PhpMyAdmin
* Apache
* MySQL
* PHPUnit
* Silex
* Twig
* Atom
* Terminal
* GitHub
* Bootstrap
* HTML

#Legal

* MIT Licensed
* Copyright (c) 2016 Erik Tolentino

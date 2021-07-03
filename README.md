# oc-php-projet5-blog

### Creation of a responsive blog in PHP OOP without framework


The project has been done with versions of :
* MYSQL 8.0.23
* PHP 7.4.9
* APACHE 2.4.46

you need to have composer installed (if not: https://getcomposer.org/download/)



## :gear: INITIALISATION DU PROJET

### Step one: installing the repository

* Clone this repo on your:computer:

* from the root :file_folder: `OC-PHP-PROJECT5-BLOG`. use  `composer install` , to load all dependancies. 

### Step two: importing the database

* from the root :file_folder: `OC-PHP-PROJECT5-BLOG` , import `blogdatabase.sql` to your PhpMyAdmin.

 ### Step three: configuration

#### configuring database : 
from the root :file_folder: `OC-PHP-PROJECT5-BLOG` , modify `config.example.php` with your phpMyAdmin login credentials:<br/>

* DBUSER is your username ( for ex: `root` ).
* DBNAME is `blogdatabase`.
* DBPASS is your password.
* DBHOST is your host ( generally localhost ).

#### configuring swiftmailer

The application use the library Swiftmailer to send email, so you need an access to a SMTP server.<br/>
If you don't know inofrmations about your SMTP server (https://www.commentcamarche.net/applis-sites/mail/981-trouver-les-adresses-des-serveurs-de-mail-pop-imap-smtp/).<br/>
Now you have to modify `config.example.php` with your SMTP server login credentials:

* SMTP is your SMTP server.
* PORT is your SMPT server port.
* PROTOCOL is your protocol.
* EMAIL is your email address.
* PASSWORD is your email password.

#### for example if the type of your email address is john.doe@gmail.com : 

* your SMTP server is `smtp.gmail.com`.
* your port is `587`.
* your protocol is `tls`.
* your email is `john.doe@gmail.com`
* your password is ... your password :)

:heavy_exclamation_mark: :heavy_exclamation_mark:  After configuration don't forget to remove .example extention from the file `config.example.php`
 At the end, the name of the file have to be `config.php`.

 ## :gear: LANCEMENT DU PROJET

 - To run the projet, from the root :file_folder: `OC-PHP-PROJECT5-BLOG` , open a terminal and enter this command : `php -S localhost:8000 -t public`.
 - Follow the link and ....enjoy !!



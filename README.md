Uygun Cart
==========
Uygun Cart is an open source shopping cart application written in PHP using [CodeIgniter](https://github.com/EllisLab/CodeIgniter) framework.

Installation
------------
### Import Database
Create a new database and import [uyguncart.sql](https://github.com/uyguncyp/uyguncart/raw/master/uyguncart.sql).

### Database Connection
Set database connection settings in [application/config/database.php](https://github.com/uyguncyp/uyguncart/raw/master/application/config/database.php) by changing following variables:

``$db['default']['hostname']``, ``$db['default']['username']``, ``$db['default']['password']``, and ``$db['default']['database']``

### PayPal

Set $client_id and $secret in [application/libraries/PayPal.php](https://raw.github.com/uyguncyp/uyguncart/master/application/libraries/PayPal.php) to make PayPal work 

Usage
-----
### Admin Login
Go to /admin under web root

E-mail: admin@example.com

Password: passw0rd

### User Login
Create a new user at /user/register

and go to /user/login to login

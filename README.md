Blueshell
=========

Build status
------------

**Master branch:** ![master-badge](https://circleci.com/gh/netwing/blueshell/tree/master.png?circle-token=388880fe02f1c2ede00e3743f7be13691cd5f908)

**Develop branch:** ![develop-badge](https://circleci.com/gh/netwing/blueshell/tree/develop.png?circle-token=388880fe02f1c2ede00e3743f7be13691cd5f908)

Requirements
------------

PHP >= 5.4

MySQL >= 5

Node JS

Quickstart
----------

Clone git repository in desired folder with command (directory must be empty):

    git clone git@github.com:netwing/blueshell.git .
    php composer.phar install
    bower install

In case of error for permissions from `bower` you can use:

    HOME=~/tmp bower install

Where `~/tmp` should be a writable directory for current user.

Copy `config.inc.php.example` in `config.inc.php` and change database connection parameters.
Copy `app/protected/config/config.php.example` in `app/protected/config/config.php` and change database connection parameters.

Download from private repo
--------------------------

    curl -sL --user "lordlele:a0957e1e7340e525202e276df9b90c40c0aa2aeb" https://github.com/netwing/blueshell/archive/develop.zip > develop1.zip


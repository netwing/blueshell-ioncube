Release 2.7.4
=======

**Changelog**

- Major fix in Calculation to address a PHP major bug in floatval locale awareness

**How to update**

    ./app/protected/yiic migrate
    php composer.phar install --no-dev
    HOME=~/tmp bower install 


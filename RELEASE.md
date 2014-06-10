Release 2.8.2
=======

**Changelog**

- Redirect to moorings if not map enabled
- Fix error in new map creation

**How to update**

    ./app/protected/yiic migrate
    php composer.phar install --no-dev
    HOME=~/tmp bower install

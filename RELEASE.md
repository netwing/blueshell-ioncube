Release 2.8.4
=======

**Changelog**

- Fix order sorting
- Fix a major crash in order view if not vector selected

**How to update**

    ./app/protected/yiic migrate
    php composer.phar install --no-dev
    HOME=~/tmp bower install

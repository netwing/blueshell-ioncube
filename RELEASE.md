Release 2.8.1
=======

**Changelog**

- Minor fix in attachment thumbnail preview
- Handle missing attachment file
- Fix in correct order creation from quote

**How to update**

    ./app/protected/yiic migrate
    php composer.phar install --no-dev
    HOME=~/tmp bower install

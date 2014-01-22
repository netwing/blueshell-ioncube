Release 2.1.0
=======

First public release of new version.
You must install this application from scratch and keep only your database.

**Changelog**

- Complete rewrite with Bootstrap and Jquery
- Use Bootswatch Cerulean as theme

**How to install**

```
git clone git@github.com:netwing/blueshell-ioncube.git
php composer.phar install --no-dev
bower install
./app/protected/yiic migrate
```

Say **yes** when prompt to apply database migrations.

Release 2.9.7
=============

Changelog
---------

- Removed Redis PHP extensions.so

How to update
-------------

    php composer.phar self-update
    php composer.phar install --no-dev
    HOME=~/tmp bower install
    ./app/protected/yiic migrate

CRON setup
----------

You must setup a cron like this:

    * * * * * <path/to/application>/app/protected/yiic cron > /dev/null

NODE setup
----------

**NODE installation**

You **must** execute this commands as root:

    npm install -g socket.io
    npm install -g config mysql redis forever

Go to `app/protected/node` and execute as web user:

    npm link socket.io config mysql redis

**NODE server configuration**

Go to `app/protected/node/config` and copy default.json to runtime.json.

Put in file your configuration parameters.

**NODE server management**

Start node server (as web user) from web root:

    forever start -a -p app/protected/runtime/ -l forever.log -o app/protected/runtime/forever-output.log -e app/protected/runtime/forever-error.log app/protected/node/server.js

To start as root (needed on our server with the damned immutable bit of ISPConfig):

    forever start -a -p /data/var/www/domain.blueshell.it/web/app/protected/runtime/ -l forever.log /data/var/www/domain.blueshell.it/web/app/protected/node/server.js   

List node server (as web user):

    forever list

Restart a node server with ID = 0 (list node server to show ID) (as web user):

    forever restart 0

**NODE application configuration**

Open `app/protected/config/config.php` and setup configuration parameters for node, server address and port.


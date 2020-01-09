#Feeder

##Install Steps

It is recommended that you install Homestead to run this app. Full instructions on how to do this are
available [here](https://laravel.com/docs/6.x/homestead#per-project-installation).

Quick instructions are:
1. Run `composer require laravel/homestead --dev`
2. If on Mac/Linux run `php vendor/bin/homestead make`. If windows run `vendor\\bin\\homestead make`
3. `vagrant up`
4. Once complete, site should be available at <http://192.168.10.10>

Alternatively, a LAMP stack can also run the app.

Once a local environment has been set up, the following commands finish the app set up:
```
composer update
npm install && npm run dev
php artisan migrate
php artisan db:seed
```

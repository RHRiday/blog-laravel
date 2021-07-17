# About [DokkoBlog](http://dokkoblog.herokuapp.com/)

Just a blog created with [Laravel](https://laravel.com/) Framework.

## Features
- View blogs as a guest.
- Register & Login as an user.
- Logged user can post and view blogs.
- User can edit or delete own posts.
- Post can be filtered by tag or user that posted.
- Duplication will be validated.
- Feedback on validation error.
- Blog pagination.
- Live on [Heroku](https://heroku.com/) server.

## What I learned new
- Store files.
- Migrations in Laravel applications.
- Authenticate users before performing an action.
- Editable and dynamic `<option>`.
- Rendering 404 page.
- Pagination according to data.
- Laravel Mix.
- Run front-end assets in Laravel applications.
- Creating slugs.
- Deploying Laravel apps to heroku
    - Create a `Procfile`
    - Write `web: vendor/bin/heroku-php-apache2 public` in the Procfile
    - Add all the `env` variables ![#f03c15](https://via.placeholder.com/15/f03c15/000000?text=+) `APP_DEBUG`, `APP_KEY`, `APP_NAME`, `DB_$vars` are compulsory.
    - Make sure to set `buildpacks` in this order (use command `heroku buildpacks add $BUILDPACK_NAME`)
        > 1. heroku/node
        > 2. heroku/php 
    - Run `heroku run php artisan migrate -a $APP_NAME` for database migration.
    - Run `heroku run npm i -a $APP_NAME` for installing node packages.

## Technologies used
- Laravel
- Bootstrap
- FontAwesome
- FreeMySqlHosting

## Live demo
Watch a live demo of this project — [DokkoBlog](http://dokkoblog.herokuapp.com/)
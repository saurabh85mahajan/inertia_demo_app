# Inertia Demo App

A demo application created using InertiaJs, which follows the [Udemy Course](https://www.udemy.com/course/learn-inertiajs-using-laravel-and-vue/?referralCode=28AD2B601C9219ABB279)


## Installation

Clone the repo locally:

```sh
git clone https://github.com/saurabh85mahajan/inertia_demo_app.git
cd inertia_demo_app
```

Install PHP dependencies:

```sh
composer install
```

Install NPM dependencies:

```sh
npm ci
```

Build assets:

```sh
npm run dev
```

Setup configuration:

```sh
cp .env.example .env
```

Generate application key:

```sh
php artisan key:generate
```

Create Mysql Database and configure the values in .env file


Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```

Start the dev server

```sh
php artisan serve
```

Open the Link in Browser. Register & you are all set!

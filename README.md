# Ringier Technincal Challenge

## Introduction

This project aims to meet the requirements of the Ringier Technical Challenge (Senior Level). 
It is a simple marketplace POC built with [Laravel 9](https://laravel.com/docs/9.x/installation), [Vue.js](https://vuejs.org/guide/introduction.html) and [Tailwind CSS](https://tailwindcss.com/)

## Requirements
Ensure you have the following to run this project: 

- Minimum [PHP](https://www.php.net/downloads) version of 8.* 
- [Composer](https://getcomposer.org/) 
- Latest versions of [NPM and Node](https://nodejs.org/en/)

## Setup
1. Clone the repository into your local machine and navigate into the project folder

2. Install the Laravel libraries using the command:

```bash
   composer install
```

3. Copy the contents of the `.env.example` into a new `.env` file

4. Generate a new app key:

```bash
   php artisan key:generate
```
5. Configure the database section below:

```
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
6. Install and build the Vue.js dependencies:

```bash
   npm install && npm run build
```

7. Migrate the database and seed test data:

```bash
   php artisan migrate:fresh --seed
```

8. Start the server and open the url provided on your browser using the command:

```bash
   php artisan serve
```

## Resources

Here are some of the useful resources used:

- A Vue.Js and Tailwind [template](https://github.com/tailwindcomponents/e-commerce)

This template helped me create the UI faster allowing me to focus on the functionality required. The use of a template was also quite helpful since this was my first time working with Vue.js

- [Laravel Jetsream](https://jetstream.laravel.com/2.x/introduction.html), specifically the [Inertia](https://jetstream.laravel.com/2.x/introduction.html#inertia-vue) stack

The Inertia stack not only provides an auth scaffold which speeds up building authentication logic, but it comes with many reusable components that can be extended to the rest of your app.

- [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary/v10/introduction)

This package comes with inbuilt helper functions to aid in media management tasks such as image upload, storage folder management and linking/unlinking media to various models.


## Extra Information

- Products/Listings seeded do not have individual images but use the image of the category they belong in. However, listings created by the user with an image will have that image displayed

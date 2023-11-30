## Setup

**NOTE** This project is setup using Laravel 10.x it requires a minimum PHP version of 8.1.

Using Laravel Breeze with vue https://laravel.com/docs/10.x/starter-kits#breeze-and-inertia

Rename `.env.example` to `.env` update valuse as per need.

Run `npm install` in root folder to install node packages

Run `composer install` in root folder to install composer packages

Run `php artisan migrate` to get migrations up

Run `npm run dev` to get Hot reload

Run `php artisan serve` to get laravel application up.

You should be able to access application on `http://localhost:8000`

### Routes

### Guest Routes
#### Home Page (/)

Accessable by guest users, have Login or Register options

#### Register (/register)

Allow user to register, All fields are required

#### Login (/login)

Allow registered users to login.

#### Forgot Password (/forgot-password)

Allow user to reset password using email (For testing purposes mail is set to written in log file)

#### Reset Password (/reset-password/{token})

Allow user to reset password with valid token

### Auth Routes
#### Dashboard (/dashboard)

Dashboard to view list of all customers

#### Add Customer (/customer)

Route to add new customers. All fields are required

#### Edit Customer (/customer/{id})

Route to edit customer

#### Delete Customer (/customer/{id})

Route to delete customer, a confirmation prompt will ask user to verify the deletion.

#### Profile (/profile)

Profile of current loggedin user, Allow user to edit there data, change password and delete their account.


## Tests

To run test run `./vendor/bin/phpunit tests`

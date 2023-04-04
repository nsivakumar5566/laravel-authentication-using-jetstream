# Admin and User Login using Laravel Jetstream in Laravel 8

Hi Viewers, In this example you can see the source code of Admin and User login using Laravel Jetstream

## Getting Started

#### 1. Create a new project

```
composer create-project laravel/laravel your-project-name
```

#### 2. Set your Database name, Username and Passowrd in .ENV file

This folder will be available in your project root folder

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= // set database name
DB_USERNAME= // set username
DB_PASSWORD= // set password
```

#### 3. Install Laravel Jetstream in your project

```
composer require laravel/jetstream
```

```
php artisan jetstream:install livewire
```

```
npm install
```

```
npm run dev
```

#### 4. Customize the User Table by adding the below columns

```
$table->string('user_type')->default(0);
$table->string('phone')->nullable();
$table->string('address')->nullable();
```

#### 4. Now migrate your table

```
php artisan migrate
```

#### 5. Run your project

```
php artisan serve
```

#### 6. To fix tailwind css

> Note: Skip this step if CSS works fine
> In your app.blade and guest.blade and the below lines

```
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}" defer></script>
```

#### 7. Add two input fields in register page (Based on customization in user table)

> [open] - views/auth/register
> Note: Below the email field

```
<div class="mt-4">
    <x-jet-label for="phone" value="{{ __('Phone') }}" />
    <x-jet-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')"
        required />
</div>

<div class="mt-4">
    <x-jet-label for="address" value="{{ __('Address') }}" />
    <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
        required />
</div>
```

#### 8. Also add the two field while creating the User

> [open] - App/Actions/CreateNewUser

```
return User::create([
    'name' => $input['name'],
    'email' => $input['email'],
    'phone' => $input['phone'],
    'address' => $input['address'],
    'password' => Hash::make($input['password']),
]);
```

#### 9. Create UserSeeder

```
php artisan make:seeder UserSeeder
```

Add this two user details in your UserSeeder

```
public function run()
{
    User::create([
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'user_type' => 1,
        'phone' => '9876543210',
        'address' => 'Street#22, City',
        'password' => Hash::make('12345678'),
    ]);

    User::create([
        'name' => 'User',
        'email' => 'user@gmail.com',
        'phone' => '9876543210',
        'address' => 'Street#22, City',
        'password' => Hash::make('12345678'),
    ]);
}
```

Now seed this two details to your table by running below command

```
php artisan db:seed --class=UserSeeder
```

#### 10. Lets Setup separate dashboard for Admin and User while login

> [open] Providers/RouteServiceProvider

```
public const HOME = 'redirect';
```

Create a Route for redirect

```
Route::get('/redirect', [HomeController::class, 'redirect']);
```

Create a HomeController and Add the redirect function

```
php artisan make:controller HomeController
```

```
public function redirect()
{
    $user_type = Auth::user()->user_type;

    if ($user_type == 1) {
        return view('admin.home');
    }
    return view('dashboard');
}
```

Create a Admin dashboard page

> [create] views/admin/home.blade.php

Add the below lines

```
<x-app-layout>

</x-app-layout>
```

#### 11. Converting CSS framework Tailwind to Bootstrap

> SKip this step if you are ok with tailwind

We have successfully installed jetstream in our laravel project, but the jetstream is still using tailwindcss. For that, if we want to use bootstrap in laravel jetstream, we can use jetstrap (jetstream bootstrap) package. Installing jetstrap can use the composer command as below.

```
composer require nascent-africa/jetstrap --dev
```

Then run the command jetstrap:swap as below, to publish and replace tailwindcss with bootstrap.

```
php artisan jetstrap:swap livewire
```

After installing jetstrap and changing jetstream resources, proceed with running the command as below.

```
npm install && npm run dev
```

## END

> Note: To run this project source code You should have composer v-2.3.2 and PHP v-7.4.

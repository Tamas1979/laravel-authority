# Laravel Authority

**A simple and reusable Laravel package for role hierarchy and authority-based authorization.**

This package allows you to define an **authority level** for your users and easily manage permissions between users of different levels.  
It works seamlessly with **API-only projects**, **Blade**, **Inertia**, or **Livewire**, and is fully **framework-agnostic**, so it can also be used alongside other permission packages like Spatie’s Roles & Permissions.

---

## Features

- **Authority hierarchy**: easily compare users’ authority levels (`manage` logic built-in)  
- **Reusability**: designed as a Laravel package, works across projects  
- **Flexible**: integrate with any existing authorization system  
- **API & Blade ready**: works in controllers, policies, and views  
- **Lightweight**: minimal setup, no heavy dependencies  

---

## Installation

Require the package via Composer:

```bash
composer require tamas1979/laravel-authority
```

---

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --provider="Tamas1979\Authority\AuthorityServiceProvider" --tag=config
```

The default config:

```php
return [
    'column' => 'authority_level', // the integer column in your users table
];
```

---

## Setup

1. **Add the authority column to your users table:**

```bash
php artisan make:migration add_authority_level_to_users_table --table=users
```

```php
$table->integer('authority_level')->default(0);
```

2. **Implement the AuthorityUser contract and use the HasAuthority trait in your User model:**

```php
use Tamas1979\Authority\Contracts\AuthorityUser;
use Tamas1979\Authority\Traits\HasAuthority;

class User extends Authenticatable implements AuthorityUser
{
    use HasAuthority;

    protected $fillable = [
        'name',
        'email',
        'password',
        'authority_level',
    ];
}
```

---

## Usage

### Tinker example

```php
$user1 = \App\Models\User::create([
    'name' => 'Admin1',
    'email' => 'admin1@test.com',
    'password' => bcrypt('password'),
    'authority_level' => 500,
]);

$user2 = \App\Models\User::create([
    'name' => 'Admin2',
    'email' => 'admin2@test.com',
    'password' => bcrypt('password'),
    'authority_level' => 400,
]);

$user1->authorityLevel(); // 500
$user2->authorityLevel(); // 400
```

### Policy usage

```php
$policy = new \Tamas1979\Authority\Policies\AuthorityPolicy();

$policy->manage($user1, $user2); // true
$policy->manage($user2, $user1); // false
```

### Blade / Controller

```php
@can('manage', $targetUser)
    <button>Remove Admin Role</button>
@endcan
```

```php
$this->authorize('manage', $targetUser);
```

---

## Contribution

- Open for ideas, bug fixes, and feature requests  
- Follows Laravel 11+ standards  
- API-ready and Blade-compatible  

---

## License

MIT
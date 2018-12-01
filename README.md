# UMS - User Management System

> A basic Symfony 4 application with Stories
• As an admin I can add users — a user has a name.
• As an admin I can delete users.
• As an admin I can assign users to a group they aren’t already part of.
• As an admin I can remove users from a group.
• As an admin I can create groups.
• As an admin I can delete groups when they no longer have members.

## Quick Start

``` bash
# Install dependencies
composer install

# Edit the env file and add DB params

# Create db
 php bin/console doctrine:database:create

# Create User schema
php bin/console doctrine:migrations:diff

# Run migrations
php bin/console doctrine:migrations:migrate

# Build for production
npm run build
```

## App Info

### Author

Brad Traversy
[Traversy Media](http://www.traversymedia.com)

### Version

1.0.0

### License

This project is licensed under the MIT License

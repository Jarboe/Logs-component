# Logs component for Jarboe

### Prepare
1. Run command to create table for logs.
2. Add
2. Run ```$ php artisan jarboe:component check``` to make sure if all is ok
3. Run ```$ php artisan jarboe:component install``` to install components

### Add links to admin panel menu
config ```jarboe.admin.menu```
```php
<?php
return array(
//...
    'menu' => array(
        //...
        \Jarboe\Component\Logs\Util::getNavigationMenuItem(),
        //...
    ),
//...
);
```
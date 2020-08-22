# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/schubu/laravel-make-view.svg?style=flat-square)](https://packagist.org/packages/schubu/laravel-make-view)
[![Build Status](https://img.shields.io/travis/schubu/laravel-make-view/master.svg?style=flat-square)](https://travis-ci.org/schubu/laravel-make-view)
[![Quality Score](https://img.shields.io/scrutinizer/g/schubu/laravel-make-view.svg?style=flat-square)](https://scrutinizer-ci.com/g/schubu/laravel-make-view)
[![Total Downloads](https://img.shields.io/packagist/dt/schubu/laravel-make-view.svg?style=flat-square)](https://packagist.org/packages/schubu/laravel-make-view)

This package extends the artisan command line tool with an additional make:view command to easily create your view files. 
You can use the dot notation for creating them in subdirectories. You can define different blade templates by creating stub files, e.q different template files for your frontend and backend.  

## Installation
You can install the package via composer:

```bash
composer require schubu/laravel-make-view
```

## Usage

``` php
php artisan make:view [Your-View-Folder.Subdirectory]
```

This will create 4 files named "index.blade.php", "show.blade.php", "create.blade.php" and "edit.blade.php" with in 
your specified folder (in this example views\Your-View-Folder\Subdirectory). 

## Templating
You can use blade templates by creating a template-stub file. First you have to publish the stub files (see section publishing stub files). 
To create a new template, create a *.stub file with in your app/Vendor/SchuBu/make-view/stubs folder. This is automatically created after publishing the stubs. 
After that you can use your template file by calling following command:
``` php
php artisan make:view [Viewfolder] -t YOUR-TEMPLATE
```
You've to omit the .stub extension!

## Publishing your stub files
You can publish your stub files (to edit and create your blade templates) by following command:
``` php
php artisan vendor:publish --provider="SchuBu\MakeView\MakeViewServiceProvider" --tag=stubs
```
This will create a directory with in your app directory. You'll find your stubs in app\Vendor\SchuBu\make-view\stubs

### Overriding existing templates
Normally preexisting templates won't be overwritten. You can force this behaviour by adding the "-f" option:
``` php
php artisan make:view [Your-View-Folder.Subdirectory] -f
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email peter@schu-bu.de instead of using the issue tracker.

## Credits

- [SchuBu](https://github.com/schubu)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).

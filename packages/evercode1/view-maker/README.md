# ViewMaker

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]


ViewMaker creates an artisan command that lets you quickly scaffold views for create, show, edit, and index, based on your input.

If you had a model named Widget, and you had a REST controller, you would want correspoing views
for the controller methods.
You simply input a model name, master page name and mode (plain, basic, or dt), for example, widget, and the 

## Install

Via Composer

```
composer require evercode1/view-maker
```

In your app/config/app.php file, add the following to the providers array:

```
Evercode1\ViewMaker\ViewMakerServiceProvider::class,
```

## Usage

Once installed, you should see make:trait as one of the artisan commands when you run:

```
php artisan list
```

To use this command, supply it with two arguments, the first being the name of the trait, and the 
second being the name of the folder you want it to reside in.  If the folder does not exist, it will be created for you.

For example:

```
php artisan make:trait SampleTrait TraitsFolder
```

This would create a directory named TraitsFolder in your app directory with a php file
named SampleTrait.php, which would contain the following stub:
   
```
<?php
namespace App\TraitsFolder

trait SampleTrait
{

}
```

Please note, the package currently only supports trait folders that are in the app folder, for example:

```
app/MyTraits
```

It cannot be used to create the following location:

```
app/Http/Controllers/MyTraits
```



## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email ikon321@yahoo.com instead of using the issue tracker.

## Credits

- [Bill Keck](https://github.com/evercode1)


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/evercode1/trait-maker.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/evercode1/trait-maker/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/evercode1/trait-maker.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/evercode1/trait-maker.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/evercode1/trait-maker.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/evercode1/trait-maker
[link-downloads]: https://packagist.org/packages/evercode1/trait-maker/stats
[link-author]: https://github.com/evercode1


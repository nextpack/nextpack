# Nextpack (light)

[![Latest Stable Version](https://poser.pugx.org/nextpack/nextpack/v/stable)](https://packagist.org/packages/nextpack/nextpack) 
[![License](https://poser.pugx.org/nextpack/nextpack/license)](https://packagist.org/packages/nextpack/nextpack)
[![Mahmoud Zalt](https://img.shields.io/badge/Author-Mahmoud%20Zalt-orange.svg)](http://www.zalt.me)











**NextPack** is a PHP & Laravel Packages Starter, (Designed to help  building high quality PHP Packages faster).

>Clone NextPack and build your next open source package on top of it.

**NextPack** strives to facilitates and boosts the development process of PHP Packages. And it highly recommend producing framework agnostic packages.

Produce more open source composer packages with the least amount of time.

![](https://s32.postimg.org/d2fler4qd/next_pack_logo_squared_v2.png)



<a name="Highlights"></a>
## Highlights

__Nextpack includes:__

- **Rich package skeleton**, (containing common files required by almost every PHP package)
- Ready **Unit Test**
- Ready **config files reader**
- Ready **Servie Provider** (for Laravel)
- Ready **Facade Class** (for Laravel)
- Version Control: **Git** (`.gitattributes`, `.gitignore`)
- Continuous Integration: **Travis** and **Scrutinizer** (`.scrutinizer.yml`, `.travis.yml`)
- Testing: **PHPUnit** (`phpunit.xml`)
- Package Manager: **Composer** (`composer.json`)  
  





<a name="Installation"></a>
## Installation


##### Software Requirement
- Git
- Composer


##### Installation Steps

1. `git clone https://github.com/nextpack/nextpack.git`
2. `composer update`
3. make sure everything is OK by running the tests `phpunit`




<a name="Customization"></a>
## Customization

After you install a fresh copy of Nextpack, the only thing you need to do is customizing it to meet your needs, before start codig your package.


The steps include renaming the code samples shipped with the Nextpack:

1. Change the namespace of the application from `Nextpack\Nextpack` to your `Vendor-name\Package-name`. *(you can do this using the [Replace All] feature of your IDE).*
2. Update the following values in `composer.json`:  `name`, `description`, `keywords`, `authors`, `autoload` and don't forget to update the `namespaces`. (you might need to run `composer dump-autoload` after the changes).
3. Run `composer install`
4. Rename `SampleFacadeAccessor.php` and update the returned string inside the `getFacadeAccessor()` function.
5. Rename `NextpackServiceProvider` and update the content of the following functions: `facadeBindings()`, `configPublisher()` and `implementationBindings()`.
6. Update the config file `nextpack.php`, (or remove it if not necessary).
7. Delete this `README.md` file. And rename the `README.md.READY` to `README.md`.
8. Update `LICENSE` by replacing `::Vendor-Name` and `::Package-Name` with your vendor and package names.
9. Edit the new `README.md` 
13. Delete the sample `tests` function. Keep the `TestCase.php`.
14. Update the "testsuite" name in the `phpunit.xml`.



## Test

To run the tests, run the following command from the project folder.

``` bash
$ ./vendor/bin/phpunit
```




## Credits

- [Mahmoud Zalt](https://github.com/Mahmoudz)



## License

The MIT License (MIT). See the [License File](https://github.com/nextpack/nextpack/blob/master/LICENSE) for more information.

# Nextpack

[![Join the chat at https://gitter.im/nextpack/nextpack](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/nextpack/nextpack?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

[![Mahmoud Zalt](https://img.shields.io/badge/Author-Mahmoud%20Zalt-orange.svg)](http://www.mahmoudzalt.com)

Nextpack is a PHP Package Framework (Starter Project). 
Nextpack is the fastest solution for building high quality PHP Packages. 





### Vision

Nextpack was created to help PHP developers producing more Open Source Composer Packages.

**Where this comes from!** I found myself doing the same things _(Setup, Structure, Configuration, Basic Functionality)_ over and over, everytime I start developing an Open Source PHP package. And there where the idea of combining all those common things as a Framework came to my mind, and the `Nextpack` project was born.

The Nextpack Framework strives to facilitates and boosts the development process of PHP Packages. And it highly recommend producing framework agnostic packages (that can be used in any codebase).





### Questions?
If you have any question, send me an email on mahmoud@zalt.me









## Highlights

__Nextpack includes:__

- **Rich package skeleton**, (containing common files required by almost every PHP package)
- **Clean folder structure**
- **Code samples**, (demonstrating _HOW_ and _WHERE_ the code should be implemented)
- **Test samples**, (with PHPUnit)
- **Basic configurations**, (for the most popular required tools)
	- Version Control: **Git** (`.gitattributes`, `.gitignore`)
	- Continuous Integration: **Travis** and **Scrutinizer** (`.scrutinizer.yml`, `.travis.yml`)
	- Testing: **PHPUnit** (`phpunit.xml`)
	- Package Manager: **Composer** (`composer.json`)
- Common functionalities, (provided by the **Nextpack Library** `nextpack/library`).
	- **Read config files**, and serve it in the package classes
	- **Initialize drivers automatically** _"in case the package supports multiple drivers/providers"_

	
	
	
	
	
	
	
	
	
## Requirement
- Git
- Composer





## Install

1. `git clone https://github.com/nextpack/nextpack.git`
2. `composer update`





##### Internal Composer Dependencies:

The Nextpack Framework `nextpack/nextpack` requires a Library `nextpack/library` which in turn requires `illuminate/support`, `illuminate/config` and `symfony/finder`.








## Usage

After you install a fresh copy of the Nextpack starter, you need to customize it for your need. 
But before the customization steps, I will explain the sample code shipped with the package.





###Sample Code:

Nextpack is shipped with a samples code, to help you get an overall idea on where to place your code.

The two Sample Features are:

**Feature 1:** Sings a song by it's `$name`

**Feature 2:** Say `Hello` to `$name` with any supported language (`English` or `French`). 

> In the terminology of Nextpack, everything that can be supported such as (Providers, API's, Third parties...) are called `Drivers`. 
> 
> In this particular case the languages are the drivers. (because you can support many languages).


When you open the `src` directory, you will find `Say.php` and `Sing.php` they are the package API's (Entry points). Those two API's will be called by the user to get the package do what it's expected to do.


##### Feature 1: (Sing a Song)
Feature 1 demonstrates the simplest scenario, it shows how to write the business logic inside the API class. (no drivers involved).

```php
class Sing extends Handler
{
    public function song($songName)
    {
        return "Can you hear me singing $songName :P";
    }
}
```
The usage of this API class will be as follow:

```php
print $song = (new Sing())->song('Bang Bang');
```

The user create an instance of `Sing` API then call the function `song()` of the class passing a string and getting a string back.


##### Feature 2: (Say Hello)
Feature 2 demonstrates the drivers scenario, it shows how to write the business logic inside a driver. _(this gives the users the ability to select their drivers)_.

```php
class Say extends Handler
{
    public function hello($name)
    {
        return $this->driver()->hello($name);
    }
}
```

An instance of a driver is initialized using `$this->driver()`, then a driver function `->hello($name)` is called on the instance.

The driver initialized is the default driver selected in the `config` file (`'default' => 'english',`) 

```php
return [
    'default' => 'english',
    'namespace' => 'Nextpack\\Nextpack\\Drivers\\',
    'drivers' => [
        'english' => [
            'format' => '%s, %s!',
        ],
        'french' => [
            'format' => '%s, %s :)',
        ],
    ],
];
```

All the drivers classes exist in the `src/Drivers`, alongside the `Driver.php` which every driver extends from.










### Customization:

To make this pakage yours, you need to customize it and remove the code samples:

1. Chage the namespace of the application from `Nextpack\Nextpack` to your `Vendor-name\Package-name`
2. Update the following values in `composer.json`: `name`, `description`, `keywords`, `authors`, `autoload`. (you can of course edit anything else you want).
8. Delete `Say.php` and `Sing.php`, then add your `Custom.php` API class.
3. Delete `English.php`, `French.php` and `SayInterface.php`, then add your `Custom.php` Driver classes (if you need it).
4. Delete `NameValidator.php` and `MissedNameException.php`.
5. Rename `SayFacadeAccessor.php` and update the returned string inside the `getFacadeAccessor()` function.
6. Rename `NextpackServiceProvider` and update the content of the following functions: `facadeBindings()`, `configPublisher()` and `implementationBindings()`.
7. Update the config file `nextpack.php`, (or remove the file if you don't need it)
9. Delete this `README.md` file. And rename the `README.md.READY` to `README.md`.
10. Update `CONTRIBUTING.md` and `LICENSE` by replacing `::Vendor-Name` and `::Package-Name` with your vendor and package names.
11. Open the new `README.md` and replace the following: 
12. Delete everytihng in the `tests` directory except the `TestCase.php`
13. Update the "testsuite" name in the `phpunit.xml`.











## Documentation




### Create public API class

The API classes are normal classes, usually exist on the root of the `src` directory, and they all extend from `Nextpack\Nextpack\Handler` abstract class.

Example:

```php
   class Phone extends Handler
   {
      public function call($number)
      {
      		// business logic..
      		return 'Alo Alo ' . $number;
      }
   }
```
The usage of this class `Phone` will be:

```php
	$phone = new Phone();
	$message = phone->call('96171137427');
	print message;
```






### Read the configuration file




#### From API Classes:

To read the values of your default config file form an API class, you need to inject `Nextpack\Library\Config` class in your constructor. 
And then call the function `get('fileName.key');`

```php
    public function __construct(Config $config)
    {
        // read all the configuration file
        $this->all = $config->get('nextpack'); // 'nextpack' is the name if the default config file you are using
        
        // read something specific from the configuration file
        $this->format = $config->get('nextpack.drivers.english.format');
     }

```




#### From Driver Classes:

You can access the driver configurations as you access the class properties `$this->property`.

However a safer way to access these class properties is by using the `get()` function `$this->get('property')` (to prevent accessing undefined property, in case it's removed from the config file).

To access values from outside the driver specific configurations scope, you can call the `$this->getAll()` and get all the config file as array.

```php
// access configuration value as attribute
$accessToken = $this->accessToken;
	
//  access configuration value using a safe function [best way]
$accessToken = $this->get('accessToken');
	
// access configuration value exist outside the scope of the driver in the config file 
$allConfigurations = $this->getAll();   // (returns all the config file)
```









### Create a Driver class

The driver classes are normal classes, usually exist in the `src/Drivers` directory, and they all extend from `Nextpack\Nextpack\Drivers\Driver` abstract class.

Example:

```php
   class Vodafone extends Driver
   {
      public function call($number)
      {
      		// business logic..
      		return 'Alo, This is the Vodafone Mobile Operator';
      }
   }
```





### Initialize a Driver

To initialize an instance of the default driver selected in the config file all you have to do is call `$this->driver()` function from any of your API classes.

Config file example:

```json
    /*
    |--------------------------------------------------------------------------
    | Default Driver name
    |--------------------------------------------------------------------------
    |
    | The Supported Providers are:
    | - vodafone
    | - verizon
    |
    */
    'default' => 'vodafone',

```

>Note: the name of the driver is the same as the name of the class, in lowercase.

Usage example from the API class:

```php
    $driver = $this->driver();
    $result = $driver->call('96171137427');
```
>Note: The package user must not initialize object of the Drivers. He should only access the API classes.






### Dependency Injection
You can inject any class you want in any API or Driver's class.

In this example I am injecting a `Validator` class.

```php
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }
```





### Add Tests

The test classes are normal classes, they can only exist in the `tests` directory, and they all extend from `Nextpack\Nextpack\Tests\TestCase` class.

Example:

```php
class SingTest extends TestCase
{
    public function testSingingSong()
    {
        $input = 'Bang Bang';
        $expectedOutput = "Can you hear me singing $input :P";

        $output = (new Sing())->song($input);

        $this->assertEquals($output, $expectedOutput);
    }
}
```















## Test

To run the tests, run the following command from the project folder.

``` bash
$ ./vendor/bin/phpunit
```






## Contributing

Please check out our contribution [Guidelines](https://github.com/nextpack/nextpack/blob/master/CONTRIBUTING.md) for details.








## Support

[Issues](https://github.com/nextpack/nextpack/issues) managed by Github.








## Credits

- [Mahmoud Zalt](https://github.com/Pack)
- [All Contributors](../../contributors)








## License

The MIT License (MIT). Please see [License File](https://github.com/nextpack/nextpack/blob/master/LICENSE) for more information.








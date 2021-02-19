Slim Skeleton
===
[![Build Status](https://travis-ci.org/oanhnn/slim-skeleton.svg?branch=master)](https://travis-ci.org/oanhnn/slim-skeleton)
[![Latest Stable Version](https://poser.pugx.org/oanhnn/slim-skeleton/v/stable)](https://packagist.org/packages/oanhnn/slim-skeleton)
[![Total Downloads](https://poser.pugx.org/oanhnn/slim-skeleton/downloads)](https://packagist.org/packages/oanhnn/slim-skeleton)
[![License](https://poser.pugx.org/oanhnn/slim-skeleton/license)](https://packagist.org/packages/oanhnn/slim-skeleton)

[![Join the chat at https://gitter.im/oanhnn/slim-skeleton](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/oanhnn/slim-skeleton?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

A skeleton for [Slim Framework v3][slim-fw] following MVC pattern.   

Main features
---
- [x] Support logging follow [PSR-3][psr3] with [Monolog][monolog]
- [x] Support template engines: PHP view, Twig (default PHP view)
- [x] Support database accessing with [Doctrine DBAL][doc-dbal], [CakePHP Database][cake-db] (support MySql, Postgresql, SQLite, ...)
- [x] Support middlewares: Basic & Digest Authentication
- [x] Support providers, easy to integrate with `slim/http-cache`, `slim/csrf`, `slim/flash`
- [x] Support making database test and integration test with [PHPUnit][phpunit]
- [x] Support coding style check and fix with [PHPCS][phpcs]
- [x] Support auto deploy with [Deployer][deployer]
- [x] Support using [Laravel Mix][laravelmix] to build and manage assets (js, jsx, css, sass, ...)

#### Directories structure
```
path/to/project
|-- app
|   |-- assets
|   |-- config
|   |-- lang
|   `-- templates
|-- public
|-- src
|-- tests
|-- tmp
|   |-- cache
|   `-- logs
`-- vendor
```

Requirements
---

* PHP 5.6+
* [Composer][compoer]
* [npm][npm] (If using Laravel Mix to build assets)

Usage
---

#### Create project
Using `composer` to create new project:

```shell
$ composer create-project oanhnn/slim-skeleton path/to/project --prefer-dist
```

#### Check coding style and fix
```shell
$ composer phpcs
$ composer phpcbf
```

#### Run phpunit test
```shell
$ composer phpunit
```

Or check coding style and run phpunit

```shell
$ composer test
```

#### Build assets with Laravel Mix
You can use Laravel to build SASS, LESS, ES6, ...

```shell
$ npm install
$ npm run dev
```

The more documents can be found in [Laravel Mix][laravelmix] project page

#### Deploy project
You can use Deployer to deploy project.   
Copy and edit server's information from `deploy.php.dist` file to `deploy.php` file.   
After that, you can run:

```shell
$ composer require deployer/deployer:^3.3.0 --dev
$ ./vendor/bin/dep <stage>
```

See an example in [here][deploy-ex].

Changelog
---
See all change logs in [CHANGELOG.md](CHANGELOG.md)

Contributing
---
All code contributions must go through a pull request and approved by
a core developer before being merged. This is to ensure proper review of all the code.

Fork the project, create a feature branch, and send a pull request.

To ensure a consistent code base, you should make sure the code follows the [PSR-2][psr2].

If you would like to help take a look at the [list of issues](issues).

License
---
This project is released under the MIT License.   
Copyright © 2013-2017 Oanh Nguyen.   
Please see [License File](LICENSE.md) for more information.


[psr2]:      https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[psr3]:      https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md
[composer]:  https://getcomposer.org
[npm]:       https://docs.npmjs.com/getting-started/installing-node
[monolog]:   https://github.com/Seldaek/monolog
[doc-dbal]:  https://github.com/doctrine/dbal
[cake-db]:   https://github.com/cakephp/database
[phpunit]:   https://phpunit.de/
[phpcs]:     https://github.com/squizlabs/PHP_CodeSniffer
[deployer]:  https://deployer.org
[deploy-ex]: https://github.com/oanhnn/deployer-example
[slim-fw]:   http://slimframework.com/
[laravelmix]:https://github.com/JeffreyWay/laravel-mix/tree/master/docs#readme

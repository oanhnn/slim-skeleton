Slim Skeleton
===
[![Build Status](https://travis-ci.org/oanhnn/slim-skeleton.svg?branch=3.x)](https://travis-ci.org/oanhnn/slim-skeleton)
[![Latest Stable Version](https://poser.pugx.org/oanhnn/slim-skeleton/v/stable)](https://packagist.org/packages/oanhnn/slim-skeleton)
[![Total Downloads](https://poser.pugx.org/oanhnn/slim-skeleton/downloads)](https://packagist.org/packages/oanhnn/slim-skeleton)
[![License](https://poser.pugx.org/oanhnn/slim-skeleton/license)](https://packagist.org/packages/oanhnn/slim-skeleton)

[![Join the chat at https://gitter.im/oanhnn/slim-skeleton](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/oanhnn/slim-skeleton?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

A skeleton for [Slim Framework v3][slim-fw] following MVC pattern.   

Main features
---
- [x] Support logging follow [PSR-3][psr3] with [Monolog][monolog]
- [x] Support template engines: PHP view, Twig (default PHP view)
- [x] Support database accessing with [Doctrine DBAL][doc-dbal], [CakePHP Database][cakephp-db] (support MySql, Postgresql, SQLite, ...)
- [x] Support middlewares: Basic & Digest Authentication
- [x] Support providers, easy to integrate with `slim/http-cache`, `slim/csrf`, `slim/flash`
- [x] Support making database test and integration test with [PHPUnit][phpunit]
- [x] Support coding style check with [PHPCS][phpcs]
- [x] Support auto deploy with [Deployer][deployer]
- [x] Support using [Gulp][gulp] task to compile SASS, ES6, CoffeeScript, ...

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

* PHP 5.5+
* [Composer][compoer]
* [npm][npm] (If using gulp to build assets)

Usage
---

#### Create project
Using `composer` to create new project:

```shell
$ composer create-project oanhnn/slim-skeleton path/to/project --prefer-dist
```

#### Run PHP build-in server
Run a build-in server on 0.0.0.0:8888
```shell
$ php -S 0.0.0.0:8888 -t public public/index.php
```

Open web browser with address http://localhost:8888

#### Check coding style and test
```shell
$ ./vendor/bin/phpcs
$ ./vendor/bin/phpunit
```

#### Build assets with gulp, npm
You can use Gulp to compile SASS, ES6, CoffeeScript, ...

```shell
$ npm install
$ npm run-script build
```

#### Run a task with gulp
```shell
$ node_modules/.bin/gulp <task>
```

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
Copyright © 2013-2016 Oanh Nguyen.   
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
[gulp]:      http://gulpjs.com/

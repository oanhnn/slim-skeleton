Slim Skeleton
===
[![Build Status](https://travis-ci.org/oanhnn/slim-skeleton.svg?branch=3.x)](https://travis-ci.org/oanhnn/slim-skeleton)
[![Latest Stable Version](https://poser.pugx.org/oanhnn/slim-skeleton/v/stable)](https://packagist.org/packages/oanhnn/slim-skeleton)
[![Total Downloads](https://poser.pugx.org/oanhnn/slim-skeleton/downloads)](https://packagist.org/packages/oanhnn/slim-skeleton)
[![License](https://poser.pugx.org/oanhnn/slim-skeleton/license)](https://packagist.org/packages/oanhnn/slim-skeleton)

[![Join the chat at https://gitter.im/oanhnn/slim-skeleton](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/oanhnn/slim-skeleton?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

A skeleton for [Slim Framework v3](http://slimframework.com/) following MVC pattern.   

Main features
---
- [x] Support logging follow [PSR-3][psr3] with Monolog
- [x] Support template engines: PHP view, Twig, Smarty, Plate, ... (default PHP view)
- [x] Support database accessing with Doctrine DBAL, CakePHP Database (support MySql, Postgresql, SQLite, ...)
- [x] Support many middlewares: Basic & Digest Authentication
- [x] Support making database test and integration test with PHPUnit
- [x] Support using gulp task to compile SASS, ES6, CoffeeScript, ...

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
* [npm][]
* [composer][]

Usage
---

#### Create project
Using `composer` to create new project:

```shell
$ composer create-project oanhnn/slim-skeleton path/to/project --prefer-dist
```

Composer will create Slim project and all its dependencies under the `path/to/project` directory.

> If you don't have Composer yet, download it following the instructions on http://getcomposer.org/ or just run the following command:
> ```shell
> $ curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
> ```

#### Run PHP build-in server
Run a build-in server on 0.0.0.0:8888
```shell
$ php -S 0.0.0.0:8888 -t public public/index.php
```

Open web browser with address http://localhost:8888

#### Run PHP Unit test
```shell
$ composer test
```

#### Build assets (css, js, ...) with gulp, npm
```shell
$ npm install
$ npm run-script build
```

#### Run task with gulp
```shell
$ node_modules/.bin/gulp <task>
```

#### Deploy project
To deploy a project using this skeleton, you can use [Deployer](http://deployer.org).   
See an example in [here](https://github.com/oanhnn/deployer-example).

Changelog
---
See all change logs in [CHANGELOG.md](CHANGELOG.md)

Contributing
---
All code contributions must go through a pull request and approved by
a core developer before being merged. This is to ensure proper review of all the code.

Fork the project, create a feature branch, and send a pull request.

To ensure a consistent code base, you should make sure the code follows the [PSR-2][psr2].

If you would like to help take a look at the [list of issues][issues].

License
---
This project is released under the MIT License.   
Copyright © 2013-2016 Oanh Nguyen.   
Please see [License File](LICENSE.md) for more information.


[issues]:    https://github.com/oanhnn/slim-skeleton/issues
[psr2]:      https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[psr3]:      https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md
[composer]:  https://getcomposer.org
[npm]:       https://docs.npmjs.com/getting-started/installing-node

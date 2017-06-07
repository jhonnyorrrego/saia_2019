Gaufrette
=========

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
Gaufrette is a PHP5 library that provides a filesystem abstraction layer.

This project does not have any stable release yet but we do not want to break BC now.

[![Build Status](https://secure.travis-ci.org/KnpLabs/Gaufrette.png)](http://travis-ci.org/KnpLabs/Gaufrette)
[![Join the chat at https://gitter.im/KnpLabs/Gaufrette](https://badges.gitter.im/KnpLabs/Gaufrette.svg)](https://gitter.im/KnpLabs/Gaufrette)
[![Stories in Ready](https://badge.waffle.io/knplabs/gaufrette.png?label=ready&title=Ready)](https://waffle.io/knplabs/gaufrette)

Symfony integration is available here: [KnpLabs/KnpGaufretteBundle](https://github.com/KnpLabs/KnpGaufretteBundle).

Documentation is available [here](doc/index.md).
<<<<<<< HEAD
=======
Gaufrette provides a filesystem abstraction layer.

[![Build Status](https://img.shields.io/travis/KnpLabs/Gaufrette/master.svg?style=flat-square)](http://travis-ci.org/KnpLabs/Gaufrette)
[![Quality Score](https://img.shields.io/scrutinizer/g/KnpLabs/Gaufrette.svg?style=flat-square)](https://scrutinizer-ci.com/g/KnpLabs/Gaufrette)
[![Packagist Version](https://img.shields.io/packagist/v/KnpLabs/Gaufrette.svg?style=flat-square)](https://packagist.org/packages/KnpLabs/Gaufrette)
[![Total Downloads](https://img.shields.io/packagist/dt/KnpLabs/Gaufrette.svg?style=flat-square)](https://packagist.org/packages/KnpLabs/Gaufrette)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Join the chat at Gitter](https://img.shields.io/gitter/room/nwjs/nw.js.svg?style=flat-square)](https://gitter.im/KnpLabs/Gaufrette)
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

Why use Gaufrette?
------------------

Imagine you have to manage a lot of medias in a PHP project. Lets see how to
take this situation in your advantage using Gaufrette.

The filesystem abstraction layer permits you to develop your application without
the need to know were all those medias will be stored and how.

Another advantage of this is the possibility to update the files location
without any impact on the code apart from the definition of your filesystem.
In example, if your project grows up very fast and if your server reaches its
limits, you can easily move your medias in an Amazon S3 server or any other
solution.

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
Try it!
-------


```bash
php composer.phar require knplabs/gaufrette:~0.2 # Stable version
php composer.phar require knplabs/gaufrette:0.4.*@dev # Development version
```

Following an example with the local filesystem adapter. To setup other adapters, look up [their respective documentation](https://github.com/KnpLabs/Gaufrette/tree/master/doc/#adapters).

```php
<?php

use Gaufrette\Filesystem;
use Gaufrette\Adapter\Local as LocalAdapter;

// First, you need a filesystem adapter
$adapter = new LocalAdapter('/var/media');
$filesystem = new Filesystem($adapter);

// Then, you can access your filesystem directly
var_dump($filesystem->read('myFile')); // bool(false)
$filesystem->write('myFile', 'Hello world!');

// Or use File objects
$file = $filesystem->get('myFile');
// Will print something like: "myFile (modified 17/01/2016 18:40:36): Hello world!"
echo sprintf('%s (modified %s): %s', $file->getKey(), date('d/m/Y, H:i:s', $file->getMtime()), $file->getContent());
```

Running the Tests
-----------------

The tests use phpspec2 and PHPUnit.

### Setup the vendor libraries

As some filesystem adapters use vendor libraries, you should install the vendors:

    $ cd gaufrette
    $ php composer.phar install
    $ sh bin/configure_test_env.sh

It will avoid skip a lot of tests.

### Launch the Test Suite

In the Gaufrette root directory:

To check if classes specification pass:

    $ php bin/phpspec run

To check basic functionality of the adapters (adapters should be configured you will see many skipped tests):

    $ bin/phpunit

Is it green?
<<<<<<< HEAD
=======
### Documentation

Read the official [Gaufrette documentation](http://knplabs.github.io/Gaufrette/).

### Symfony integration

Symfony integration is available through [KnpLabs/KnpGaufretteBundle](https://github.com/KnpLabs/KnpGaufretteBundle).

### Launch the Test Suite

Requires:
  * docker
  * docker-compose

Build images:

    $ docker-compose build

Launch the tests:

    $ bin/tests-all

Is it green?

### Note

This project does not have any stable release yet but we do not want to break BC now.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

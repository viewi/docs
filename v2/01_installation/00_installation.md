# Installation

## Requirements

```
PHP >= 8.0
```

```
Node.js >= 12
```

## Install a Viewi Package

```
composer require viewi/viewi
```

## Create a new application with Viewi CLI tool

```
vendor/bin/viewi new [-f folder] [-a]
```

Where `-f` folder is an optional parameter and can be omitted.

Where -a means you are going to use an adapter and you do not need to modify the `index.php` file. Usually you use `-a` when installing Viewi with another framework. It is an optional parameter and can be omitted.

It will generate for you the default code for using Viewi as a standalone application in one of these files: `/index.php` or `/public/index.php`.

If you specified folder parameter, your components will be located in that folder, otherwise it will use one of these: `viewi-app/` or `src/ViewiApp/`.

**Important**
To use it with the Apache or NGINX you need to make sure that all requests are coming to the index.php file by using rewrite rules.

**Important**
Viewi does not support running from a subdirectory as sub url path. Please adapt your application accordingly.


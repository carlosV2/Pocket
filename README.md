# Pocket
Little storing services

[![License](https://poser.pugx.org/carlosv2/pocket/license)](https://packagist.org/packages/carlosv2/pocket)
[![Build Status](https://travis-ci.org/carlosV2/Pocket.svg?branch=master)](https://travis-ci.org/carlosV2/Pocket)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/cc79343c-56ed-4dd7-932a-1ed4940721a4/mini.png)](https://insight.sensiolabs.com/projects/cc79343c-56ed-4dd7-932a-1ed4940721a4)

This project aims to provide quick and easy in-file persisting capabilities. 

## Usage

The projec is composed by 3 main classes:

- `ValuePocket`: This class stores just a single value of any type. It requires the path of the file where
    the data will be persisted. Optionally, you can pass a default value that will be returned if nothing
    has been stored yet. For example:
    ```php
    use carlosV2\Pocket\ValuePocket;
    
    $pocket = new ValuePocket('/path/to/the/file', 42);
    $pocket->load(); // Returns: 42
    
    $pocket->save(4);
    $pocket->load(); // Returns: 4
    ```
    
- `CollectionPocket`: This class stores a collection of values of any type. It requries the path of the
    file where the data will be persisted. For example:
    ```php
    use carlosV2\Pocket\CollectionPocket;
    
    $pocket = new CollectionPocket('/path/to/the/file');
    $pocket->add('a');
    $pocket->add(1);
    $pocket->add(true);
    
    $pocket->getValues(); // Returns: ['a', 1, true]
    ```

- `IndexedPocket`: This class stores an indexed collection of values of any type. It requires the path of
    the file where the data will be persisted. For example:
    ```php
    use carlosV2\Pocket\IndexedPocket;
    
    $pocket = new IndexedPocket('/path/to/the/file');
    $pocket->add('key1', a');
    $pocket->add('key2', 1);
    $pocket->add('key3', true);
    
    $pocket->getValues(); // Returns: ['a', 1, true]
    $pocket->getKeys(); // Returns: ['key1', 'key2', 'key3']
    ```
    
Additionally, a manager class is provided so that a single folder path is needed. The files management is
carried out by this class. Additionally, it can perform maintenance task. For example:
```php
use carlosV2\Pocket\PocketManager;

$manager = new PocketManager('/path/to/the/folder/');

$manager->getValuePocket(); // Returns an instance of ValuePocket
$manager->getCollectionPocket(); // Returns an instance of CollectionPocket
$manager->getIndexedPocket(); // Returns an instance of IndexedPocket

$manager->clear(); // Removes any file inside /path/to/the/folder/ folder
```

## Install

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this project:

```bash
$ composer require --dev carlosv2/pocket
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

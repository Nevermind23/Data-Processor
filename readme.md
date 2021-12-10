# Data Processor

---

This tool is made to simply rewrite csv data from one format to another.

## TODO
* Add validator class

## Requirement
Csv files must have headers

PHP 7.4+

## Installation

```
composer install
php -S localhost:8000
```


## Usage

### Configure
Specify old header value in `Original Name` and new value in `New Name` fields.
If you want to remove particular fields from csv, just ignore it.
Add all the fields in first configuration and click continue.

![configuration](https://i.imgur.com/xfULPge.png)


### Upload
Simply select csv file you want to rewrite.
If you need to change rewrite configuration, just click `Reconfigure` button, and you will go to configuration screen again

![configuration](https://i.imgur.com/ryq9QeQ.png)

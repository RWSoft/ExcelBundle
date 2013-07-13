RWSoftExcelBundle
=================

This bundle integrates [PHPExcel](https://github.com/PHPOffice/PHPExcel) with Symfony2.

Registered Formats
------------------

ExcelBundle registers the following formats to [use in routes](http://symfony.com/doc/current/quick_tour/the_controller.html#using-formats).

* csv
* xls
* xlsx
* pdf

Sending a Response
------------------

```php
use RWSoft\ExcelBundle\ExcelResponse;

$doc = new \PHPExcel();
$objWriter = new \PHPExcel_Writer_Excel5($doc);
$response = new ExcelResponse($objWriter);
$response->send();
```

# Mock
Mock.js for php

翻译Mock.js 到PHP

除了Mock.js 中的 Function 和 RegExp 实现不了外其他方法都已经实现

## 示例
具体请参考 examples/test.php

```php
use qlwz\mock\Mock;

$jsonStr = '{"string|1-10": "★"}';
var_dump(Mock::mock(json_decode($jsonStr)));

$ary = [
    "string|1-10" => "★"
];
var_dump(Mock::mock($ary));

var_dump(Mock::mock('@url'));

```

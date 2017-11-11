<?php

$dtd = [];

$dtd['String']["'name|min-max': string"][] = '{
  "string|1-10": "★"
}';
$dtd['String']["'name|count': string"][]   = '{
  "string|3": "★★★"
}';

$dtd['Number']["'name|+1': number"][]      = '{
  "number|+1": 202
}';
$dtd['Number']["'name|min-max': number"][] = '{
  "number|1-100": 100
}';

$dtd['Number']["'name|min-max.dmin-dmax': number"][] = '{
  "number|1-100.1-10": 1
}';
$dtd['Number']["'name|min-max.dmin-dmax': number"][] = '{
  "number|123.1-10": 1
}';
$dtd['Number']["'name|min-max.dmin-dmax': number"][] = '{
  "number|123.3": 1
}';
$dtd['Number']["'name|min-max.dmin-dmax': number"][] = '{
  "number|123.10": 1.123
}';

$dtd['Boolean']["'name|1': boolean"][]       = '{
  "boolean|1": true
}';
$dtd['Boolean']["'name|min-max': boolean"][] = '{
  "boolean|1-2": true
}';

$dtd['Object']["'name|count': object"] []   = '{
  "object|2": {
    "310000": "上海市",
    "320000": "江苏省",
    "330000": "浙江省",
    "340000": "安徽省"
  }
}';
$dtd['Object']["'name|min-max': object"] [] = '{
  "object|2-4": {
    "110000": "北京市",
    "120000": "天津市",
    "130000": "河北省",
    "140000": "山西省"
  }
}';

$dtd['Array']["'name|1': array"] []       = '{
  "array|1": [
    "AMD",
    "CMD",
    "UMD"
  ]
}';
$dtd['Array']["'name|+1': array"] []      = '{
  "array|+1": [
    "AMD",
    "CMD",
    "UMD"
  ]
}';
$dtd['Array']["'name|+1': array"] []      = '{
  "array|1-10": [
    {
      "name|+1": [
        "Hello",
        "Mock.js",
        "!"
      ]
    }
  ]
}';
$dtd['Array']["'name|min-max': array"] [] = '{
  "array|1-10": [
    "Mock.js"
  ]
}';
$dtd['Array']["'name|min-max': array"] [] = '{
  "array|1-10": [
    "Hello",
    "Mock.js",
    "!"
  ]
}';
$dtd['Array']["'name|count': array"] []   = '{
  "array|3": [
    "Mock.js"
  ]
}';
$dtd['Array']["'name|count': array"] []   = '{
  "array|3": [
    "Hello",
    "Mock.js",
    "!"
  ]
}';

$dtd['Path']["'Absolute Path"] [] = '{
  "foo": "Hello",
  "nested": {
    "a": {
      "b": {
        "c": "Mock.js"
      }
    }
  },
  "absolutePath": "@/foo @/nested/a/b/c"
}';

$dtd['Path']["'Relative Path"] [] = '{
  "foo": "Hello",
  "nested": {
    "a": {
      "b": {
        "c": "Mock.js"
      }
    }
  },
  "relativePath": {
    "a": {
      "b": {
        "c": "@../../../foo @../../../nested/a/b/c"
      }
    }
  }
}';

return $dtd;
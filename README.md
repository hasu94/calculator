# calculator

Библиотека, которая позволяет вычислять значения выражений, переданных в текстовом формате.

Для использования нужно обратиться к объекту класса https://github.com/hasu94/calculator/blob/master/src/Parser/SimpleMathStringParser.php
```
$token = $parser->parse("2+3*40-1")
$result = $token->evaluate(); // получим 121
```

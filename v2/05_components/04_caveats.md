# Caveats

## Array in PHP and JavaScript

Arrays can be treated differently when it comes to data converting.

```php
private array $list = [];
```

By default it will treat an array as a list

```js
let list = [];
```

To make treat it as an object (counterpart of associative array in PHP) you need to set it explicitly using meta comment:

```php
private array $list = /* @jsobject */ [];
```

Will make the object;

```js
let list = {};
```

If array is not empty, you don't need to set the type explicitly, transpiler will make the right choice based on the data.

If there are keys - makes it an object. Just a list - array.
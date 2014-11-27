Unique URL Alias
================

Convert a text to a url-friendly text, plus check for the uniqueness of it.

##Usage
```php
    $alias = UrlHelper::alias('My Post Name', function($alias) {
        /*
        * A function which queries the database and gets
        * the users' count which match the alias.
        * If the count is positive, means there are already rows
        * with the current alias, so the function returns false,
        * otherwise return true
        */
        return !(bool)DB::Model_User::getByAlias($alias)->count();
    });
```

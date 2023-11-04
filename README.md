# PHP REST API

This is a simple REST API using PHP and MySQL.

**If you want to run this project you should have these things in consideration.**

* First, I leave you a SQL file that you can copy and run to use the same database that I used.
* Second, I used absolute paths to require php files. This may cause some errors, so replace those paths with your corresponding paths. Example:

My path: _(If you're not using Windows don't forget to change the '\\' with '/')_

```php
<?php

require('C:\xampp\htdocs\php_api\api\controllers\user.controller.php');

```

Your path:

```php
<?php

require('{your_path}\php_api\api\controllers\user.controller.php');

```

* Finally, the endpoint is:
`http://localhost/php_api/api/index.php`

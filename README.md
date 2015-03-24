## Basic Package - For Laravel 4.2

This package generates the base of one Aplication Manager System (AMS)

## Installation

Loading a package from a VCS repository:

```
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/CristianJaramillo/basic"
        }
    ],
    "require-dev": {
    	"cristianjaramillo/basic": "dev-master"
    }
}
```

After updating composer, add the ServiceProvider to the providers array in app/config/app.php

```
	'CristianJaramillo\Basic\ServiceProvider',
```

Finally run:

```
	php artisan basic:db --database=laravel --username=root --password
```

Ready has created a new database

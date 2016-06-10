# Overview

To create a new website, you need 3 things:
 1. Pages (Markdown files)
 2. Templates (Twig files)
 3. [PHPoole CLI](https://github.com/Narno/PHPoole) or a build script (PHP script)

Organize your content:
```
.
├─ content               <- Contains Mardown files
|  ├─ Blog               <- A section named "Blog"
|  |  ├─ Post 1.md       <- A page in the "Blog" section
|  |  └─ Post 2.md       <- A page in the "Blog" section
|  ├─ Project            <- A section named "Project"
|  |  └─ Project 1.md    <- A page in the "Project" section
|  └─ About.md           <- A page in the root
├─ layouts               <- Contains Twig templates
|  ├─ _default           <- Contains default templates
|  |  ├─ list.html       <- Used by a _list_ node type (ie: "section")
|  |  └─ page.html       <- Used by the _page_ node type
|  └─ index.html         <- Used by the _homepage_ node type
└─ static                <- Contains static files
   └─ robots.txt         <- A static file
```

Run ```php phpoole.phar build -s``` command or create a PHP script:
```php
<?php
date_default_timezone_set('Europe/Paris'); // default time zone
require_once 'vendor/autoload.php'; // Composer
//require_once 'phar://phpoole-library.phar'; // Phar file
use PHPoole\PHPoole;

PHPoole::create(
    // Options array
    [
        'site' => [
            'title'   => "My website",             // The Website title
            'baseurl' => 'http://localhost:8000/', // The Website base URL
        ],
    ]
)->build(); // Launch the builder

exec('php -S localhost:8000 -t _site'); // Run a local server
```

By default, the static website is created in the _./_site_ directory:
```
./_site
├─ blog
|  ├─ post-1
|  |  └─ index.html
|  ├─ post-2
|  |  └─ index.html
|  └─ index.html
├─ project
|  ├─ project-1
|  |  └─ index.html
|  └─ index.html
├─ about
|  └─ index.hml
├─ index.html
└─ robots.txt
```
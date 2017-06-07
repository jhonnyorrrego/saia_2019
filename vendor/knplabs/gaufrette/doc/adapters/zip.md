<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
ZIP
===

If you want to use this `Adapter`, first you should be sure `zip` extension is installed.

Example
-------
<<<<<<< HEAD
=======
---
currentMenu: zip
---

# ZIP

If you want to use this `Adapter`, first you should be sure `zip` extension is installed.

## Example
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

```php
<?php

use Gaufrette\Adapter\Zip as ZipAdapter;
use Gaufrette\Filesystem;

$adapter = new ZipAdapter('/path/to/my/zip/file');
$filesystem = new Filesystem($adapter);
```

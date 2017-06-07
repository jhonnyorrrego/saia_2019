<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
APC
===

`apc` extension should be enabled in order to use this adapter.

Example
-------
<<<<<<< HEAD
=======
---
currentMenu: apc
---

# APC

`apc` extension should be enabled in order to use this adapter.

## Example
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889

`Apc` adpater takes only two arguments :
  * the first, mandatory, is a prefix to avoid conflicts between filesystems
  * the second, not mandatory, is the ttl for each file stored

```php
<?php

use Gaufrette\Adapter\Apc as ApcAdapter;
use Gaufrette\Filesystem;

$adapter = new ApcAdapter('/prefix', 600);
$filesystem = new Filesystem($adapter);
```

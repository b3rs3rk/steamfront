# Steamfront - PHP Wrapper for Accessing the Steam Storefront API

This is a simple wrapper for accessing the very lightweight API that Steam offers for its Big Picture Mode.
It provides detailed application information, without being constrained to a particular Steam user's library like their 
Web API.

This makes it especially useful for referencing large amount of information in which you have the Steam App ID
readily available.

You can either use the Includes.php file and do a manual clone, or you can do a composer based install and use autoloading
namespaces.

Once you've got it running (autoload used below), simply invoke the client and perform a sample query:

```
<?php

use b3rs3rk\steamfront\Main;

$client = new b3rs3rk\steamfront\Main();

$data = $client->getFeaturedApps();

print_r($data);

exit;
```

API framework was footprinted from [here](https://wiki.teamfortress.com/wiki/User:RJackson/StorefrontAPI).

Http::get function was a slight rip off of
[@Moinax's](https://github.com/Moinax/TvDb/blob/master/src/Moinax/TvDb/Http/CurlClient.php#L14) function.

Enjoy - b3rs3rk

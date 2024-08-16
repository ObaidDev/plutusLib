
## Installation
```composer
composer require plutus-connector/plutus-connector
```

## Conf
#### Steps

- create a file name it config-flespi.php , then place it in YourAppDir/config/config-flespi.php

- you can use this config example form config-flespi.exmple.php file

```php
<?php
$GLOBALS["channel-data-path"] = base_path()."/data/channles.json" ;
$GLOBALS["calculators"] = base_path()."/data/calculators.json" ;
$GLOBALS['device-data-path'] = base_path()."/public/storage/units/unitdevices.json" ;
$GLOBALS['cach-report-test'] = base_path()."/data/report_cach.json" ;
```

##### Explain the previous code : 

- channel-data-path : here you must specify where you want to store channles
- device-data-path : here where we store all the devices type .
- calculators : means the calculators that you gona use in this application (we use it to init a new application)

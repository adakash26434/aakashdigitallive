<?php
define('DB_DRIVER',      'sqlite');
define('DB_SQLITE_PATH', __DIR__ . '/../.cache/dev.sqlite');

define('APP_SECRET_KEY', 'caf70a519d25944ddfc0529014410834726b3ce1f179fd488fb403a3173c3cc6');

define('SITE_URL', '');

putenv('APP_ENV=development');

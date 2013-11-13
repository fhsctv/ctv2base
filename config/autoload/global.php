<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

$db = array(
      'charset'  => 'LATIN-1',
      'driver' => 'Pdo',
      'dsn'    => 'pgsql:host=localhost;port=5432;dbname=ctv2',
);

$service_manager = array(
    'factories' => array(
        'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
    ),
);

return array(
    'db'              => $db,
    'service_manager' => $service_manager,
);

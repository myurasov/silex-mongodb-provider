# MongoDB Provider for Silex Applications

## Installation with Composer

Add the following line to your _composer.json_ __require__ section:

```
"myurasov/silex-mongodb-provider": "*"
```

Or do

`composer require myurasov/silex-mongodb-provider`


## Service Registration

```
$app->register(new MongoClientProvider(), [config options]);
```

Then `$app['mongodb.mongo_client']` service becomes available.

## Confuguration Options

```
$app['mongodb.mongo_client_options'] = [
    'server' => <connection string>,
    'options' => <connection options>,
    'driver_options' => <driver options>
];

$app['mongodb.db'] = <db name>;
```

See [http://php.net/manual/en/mongoclient.construct.php](http://php.net/manual/en/mongoclient.construct.php) for more info on parameters above.

## License

[WTFPL](http://www.wtfpl.net/)

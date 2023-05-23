# netbox-php-sdk
php library for accessing Netbox API.

This library was written to allow for multiple authentication headers as needed.

# usage
instantiate new QueryBuilder object with correct parameters:

```
$params = [
    'baseurl'   =>  'https://netbox.mycompany.com',
    'tokens'    =>  [
        [
            'header'    =>  'Authorization',
            'prefix'    =>  'Bearer',
            'value'     =>  'TOKEN1 HERE',
        ],
        [
            'header'    =>  'apiauthorization',
            'prefix'    =>  'Token',
            'value'     =>  'TOKEN2 HERE',
        ],
    ],    
];
$nb = new Ohtarr\Netbox\QueryBuilder($params);

```

Create new model object
```
$locations = new Ohtarr\Netbox\DCIM\Locations($nb);
```

Create query
```
$locs = $locations->where('name','mylocname')->where('cf_alert','1')->get();
```

Use builtin helper methods to grab related objects
```
foreach($locs as $loc)
{
    print_r($loc->site());
}
```

Use ALL method to automatically receive all pages of data
```
$locs = $locations->where('cf_alert','1')->all();
```

Or just crank the pages up
```
$locs = $locations->limit(10000)->offset(0)->get();
$locs = $locations->where('limit',10000)->where('offset',0)->get();
```

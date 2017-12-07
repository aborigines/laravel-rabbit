## Laravel Rabbit
Search Tweet using city and make marker on the map

## Require
* PHP **7.1**
* Laravel **5.5**
* Mysql  
* API ( Need A API KEY )
	* Twitter API
	* Google Maps Geocoding API 

## Config
On .env
```
CACHE_DRIVER=database

TWITTER_CONSUMER_KEY=
TWITTER_CONSUMER_SECRET=
TWITTER_ACCESS_TOKEN=
TWITTER_ACCESS_TOKEN_SECRET=
TWITTER_RADIUS_SEARCH=50km
TWITTER_CACHE_MINUTES=60

GOOGLE_MAP_API_KEY_GEOCODE=
```

## Reminder
* Max Tweet Search 10 outputs and show on map only have geo
* Don't forget to **composer update**

## License
software licensed under the [MIT license](http://opensource.org/licenses/MIT).

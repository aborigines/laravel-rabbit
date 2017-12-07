<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Twitter;

class HomeController extends Controller
{
	public function index(Request $request)
	{	
		// pre set value
		$city = '';
		$latitude = 0;
		$longitude = 0;

		$resultCount = 0;
		$lastId = null;
		$numResults = 10;

		$datas = [];

		// check input
		if ($request->has('city')) {
		    $city = $request->city;

		  //check cache
			if(Cache::has($city)) {
				$getCache = Cache::get($city);
				$latitude = $getCache['latitude'];
				$longitude = $getCache['longitude'];
				$datas = $getCache['datas'];
			} else {
				// find latitude and longitude using city name
				$findlatLong = $this->getLatLong($city);

				$latitude = $findlatLong['latitude'];
				$longitude = $findlatLong['longitude'];

				// set geocode for search
				$geoCode = sprintf('%f,%f,%s',$latitude,$longitude,env('TWITTER_RADIUS_SEARCH','50km'));

				while ($resultCount <= $numResults) {
					$query  = Twitter::getSearch(
						['q' => '', 'geocode' => $geoCode, 'count' => 100 , 'max_id' => $lastId]
					);

					foreach ($query->statuses as $result) {
						// get result with geo is not null
						if($result->geo != NULL) {
							$datas[] = $result;
							$resultCount++;
						}
						$lastId = $result->id;
					}
				}

				// save search tweet to cache
				Cache::put($city,[
					'latitude' => $latitude,
					'longitude' =>$longitude,
					'datas' => $datas
				], env('TWITTER_CACHE_MINUTES', 60));
			}
		}

		// save search history using cookie
		$this->historyCookie($city);

		return view("home", compact('latitude', 'longitude', 'datas', 'city'));
	}

	public function history()
	{
		$historyCity = app('request')->cookie('city_search');
		return view('history', compact('historyCity'));
	}
	
	protected function getLatLong($city)
	{
		$latitude = 0;
		$longitude = 0;

		$query = file_get_contents(sprintf(
			"https://maps.googleapis.com/maps/api/geocode/json?address=%s&key=%s",
			$city,
			env('GOOGLE_MAP_API_KEY_GEOCODE', '')
		));
		
		$output = json_decode($query);

		if(!empty($output->results)) {
			$latitude = $output->results[0]->geometry->location->lat;
			$longitude = $output->results[0]->geometry->location->lng;
		}
		return ['latitude' => $latitude, 'longitude' => $longitude];
	}

	protected function historyCookie($city)
	{
		$cookieName = 'city_search';

		// check cookie array
		if ($cookieData = Cookie::get($cookieName)) {
			if(!is_array($cookieData)) {
				$data = [];
				$data[] = $cookieData;
			} else {
				$data = $cookieData;
			}
			array_push($data, $city);
		} else {
			$data   = $city;
		}

		// covert to collection
		$collection = collect($data);

		// remove unique
		$unique = $collection->unique();

		Cookie::queue($cookieName,$unique->values()->all(), 9999);
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Twitter;

class HomeController extends Controller
{
	public function index(Request $request)
	{	
		$city = '';
		$latitude = 0;
		$longitude = 0;

		$resultCount = 0;
		$lastId = null;
		$numResults = 10;

		$maxTimeCache = 60; // minutes

		$datas = [];

		if ($request->has('city')) {
		    $city = $request->city;

			if(Cache::has($city)) {
				$getCache = Cache::get($city);
				$latitude = $getCache['latitude'];
				$longitude = $getCache['longitude'];
				$datas = $getCache['datas'];
			} else {
				$findlatLong = $this->getLatLong($city);

				$latitude = $findlatLong['latitude'];
				$longitude = $findlatLong['longitude'];

				$geoCode = sprintf('%f,%f,50km',$latitude,$longitude);

				while ($resultCount <= $numResults) {
					$query  = Twitter::getSearch(
						['q' => '', 'geocode' => $geoCode, 'count' => 100 , 'max_id' => $lastId]
					);

					foreach ($query->statuses as $result) {
						if($result->geo != NULL) {
							$datas[] = $result;
							$resultCount++;
						}
						$lastId = $result->id;
					}
				}

				Cache::put($city,[
					'latitude' => $latitude,
					'longitude' =>$longitude,
					'datas' => $datas
				], $maxTimeCache);
			}
		}
		return view("home", compact('latitude', 'longitude', 'datas', 'city'));
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
}

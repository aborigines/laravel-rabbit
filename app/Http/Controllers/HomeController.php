<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twitter;

class HomeController extends Controller
{
	public function index()
	{
		$results  = Twitter::getSearch(['q' => '#bangkok', 'count' => 100]);

		$datas = [];
		foreach ($results->statuses as $result) {
			if($result->geo != NULL)
			{
				$datas[] = $result;
			}
		}		
		return view("home", compact('datas'));
	}
}

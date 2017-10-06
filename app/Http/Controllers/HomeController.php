<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collision;
use DB;
class HomeController extends Controller
{
    

    public function index(){
    	$query = new Collision();
    	$data = $query->cte("_collisions_by_date",function ($query) {
            		    $query->select("date")
		                ->from('collisions')
        	            ->selectRaw('count(*) as total')
        	            ->selectRaw('count(case when accident_severity = 1 then 1 end) as Low')
	                    ->selectRaw('count(case when accident_severity = 2 then 1 end) as Medium')
	                    ->selectRaw('count(case when accident_severity = 3 then 1 end) AS High')
            	        ->groupBy('date');
            			})
			    	->from("_collisions_by_date")
			    	->limit(10)
			    	->get();

	    /*
	    We'd like to be able to implement this via scopes too:
	     */
	    /*
	   
		$query2 = new Collision();
    	$another = $query2->cteSeverity()
			    	->from("_collisions_by_severity")
			    	->limit(10)
			    	->get();
		*/
    	dd($data);
    }
}

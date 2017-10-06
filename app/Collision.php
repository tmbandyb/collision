<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Collision extends Model
{
   
	public function scopeCteSeverity($query){

    
            $cte = DB::select("date")
                    ->selectRaw('count(case when accident_severity = 1 then 1 end) as Low')
                    ->selectRaw('count(case when accident_severity = 2 then 1 end) as Medium')
                    ->selectRaw('count(case when accident_severity = 3 then 1 end) AS High')
                    ->from('collisions')
                    ->groupBy("date");
                   
            $query->cte("_collisions_by_severity",$cte);
            return $query;
     }


	

}

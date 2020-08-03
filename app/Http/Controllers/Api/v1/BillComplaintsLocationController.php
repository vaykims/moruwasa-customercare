<?php

namespace App\Http\Controllers\Api\v1;

use App\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Resources\TechResource;

class BillComplaintsLocationController extends Controller
{
    public function getAllMonths()
    {
        $zone_array = array();
        $complaints_zones = Complaint::distinct('zone')->orderBy('zone', 'ASC')->pluck('zone');
        $complaints_zones = json_decode($complaints_zones);

        if (! empty($complaints_zones)) {
            foreach ($complaints_zones as $zones) {
                $zone_name = $zones;
                $zone_array [] = $zone_name;
            }
        }
                            
        return $zone_array;
    }    

    public function getMonthlyComplaintCount($zone){
        $monthly_complaint_count = Complaint::whereYear('created_at', date('Y'))
                                            ->where('zone', $zone)                                
                                            ->get()->count('complaint_type');
        return($monthly_complaint_count);
    }

    public function index(): TechResource
    {
        $monthly_complaint_count_array = array();
         $zone_array = $this->getAllMonths();
         $zone_name_array = array();

         if(! empty($zone_array)){
             foreach($zone_array as $zone_name){
                 $monthly_complaints_count = $this->getMonthlyComplaintCount($zone_name);
                 array_push($monthly_complaint_count_array, $monthly_complaints_count);
                 array_push($zone_name_array, $zone_name);
             }
              
         }
         $max_no = max($monthly_complaint_count_array);
         $max = round(( $max_no + 10/2 ) / 10 ) * 10;

         $monthly_complaint_data_array = array(
            'zone' => $zone_name_array,
            'complaint_count_data' => $monthly_complaint_count_array,
            'max' => $max
         );
    return new TechResource($monthly_complaint_data_array);

    }
}

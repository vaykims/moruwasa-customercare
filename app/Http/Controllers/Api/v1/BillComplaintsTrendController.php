<?php

namespace App\Http\Controllers\Api\v1;

use DateTime;
use App\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Resources\TechResource;

class BillComplaintsTrendController extends Controller
{
    public function getAllMonths()
    {
        $month_array = array();
        $complaints_dates = Complaint::select('created_at')->orderBy('created_at', 'ASC')->get();
        $complaints_dates = json_decode($complaints_dates);

        if (! empty($complaints_dates)) {
            foreach ($complaints_dates as $unformatted_date) {
                $date = new DateTime($unformatted_date->created_at);
                $month_no = $date->format('m');
                $month_name = $date->format('M');
                $month_array [$month_no] = $month_name;
            }
        }
                            
        return $month_array;
    }    

    public function getMonthlyComplaintCount($month){
        $monthly_complaint_count = Complaint::whereMonth('created_at', $month)->where('complaint_type', 'high bill')->get()->count('complaint_type');
        return($monthly_complaint_count);
    }

    public function index(): TechResource
    {
        $monthly_complaint_count_array = array();
         $month_array = $this->getAllMonths();
         $month_name_array = array();

         if(! empty($month_array)){
             foreach($month_array as $month_no => $month_name){
                 $monthly_complaints_count = $this->getMonthlyComplaintCount($month_no);
                 array_push($monthly_complaint_count_array, $monthly_complaints_count);
                 array_push($month_name_array, $month_name);
             }
              
         }
         $max_no = max($monthly_complaint_count_array);
         $max = round(( $max_no + 10/2 ) / 10 ) * 10;

         $monthly_complaint_data_array = array(
            'months' => $month_name_array,
            'complaint_count_data' => $monthly_complaint_count_array,
            'max' => $max
         );
    return new TechResource($monthly_complaint_data_array);

    }
}

<?php

namespace App\Http\Controllers\Charts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Complaint;

class ComplaintStatusController extends Controller
{
    public function getAllMonths()
    {
        $month_array = array();
        $complaints_status = Complaint::distinct('status')->orderBy('status', 'ASC')->pluck('status');
        $complaints_status = json_decode($complaints_status);

        if (! empty($complaints_status)) {
            foreach ($complaints_status as $statuses) {
                $status_name = $statuses;
                $month_array [] = $status_name;
            }
        }
                            
        return $month_array;
    }    

    public function getMonthlyComplaintCount($status_name){
        $monthly_complaint_count = Complaint::whereMonth('updated_at', date('m'))->where('status', $status_name)->get()->count('status');
        return($monthly_complaint_count);
    }

    public function getMonthlyComplaintStatus(){
        $monthly_complaint_count_array = array();
         $status_array = $this->getAllMonths();
         $status_name_array = array();

         if(! empty($status_array)){
             foreach($status_array as $status_name){
                 $monthly_complaints_count = $this->getMonthlyComplaintCount($status_name);
                 array_push($monthly_complaint_count_array, $monthly_complaints_count);
                 array_push($status_name_array, $status_name);
             }
              
         }
         $max_no = max($monthly_complaint_count_array);
         $max = round(( $max_no + 10/2 ) / 10 ) * 10;

         $monthly_complaint_data_array = array(
            'status' => $status_name_array,
            'complaint_count_data' => $monthly_complaint_count_array,
            'max' => $max
         );
    return $monthly_complaint_data_array;

    }

}

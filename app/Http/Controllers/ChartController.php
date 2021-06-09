<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Item;

class ChartController extends Controller
{
    public function getAllMonths(){

        $month_array = array();
        $customers_date = Customer::orderBy('created_at', 'ASC')->pluck('created_at');
        $customers_date = json_decode($customers_date);
        if(!empty($customers_date)){
            foreach($customers_date as $unformatted_date){
                $date = new \DateTime($unformatted_date);
                $month_name = $date->format('M');
                $month_no = $date->format('m');
                $month_array[$month_no]= $month_name;
            }
        }
        return $month_array;
       
    }

    public function getMonthlyCustomers($month){
        $monthly_customers = Customer::whereMonth('created_at', $month)->get()->count();

        return $monthly_customers;

    }

    public function getMonthlyCustomersData(){
        $monthly_cusomers_count_array = array();
        $month_name_array = array();
        $month_array = $this->getAllMonths();

        if(! empty($month_array)){
            foreach($month_array as $month_no => $month_name){
                $monthly_customers_count = $this->getMonthlyCustomers($month_no);
                array_push($monthly_cusomers_count_array, $monthly_customers_count);
                array_push($month_name_array, $month_name);
            }
        }
        $max_no = max($monthly_cusomers_count_array);
        $max = round(($max_no + 10/2) / 10 )* 10;
        $monthly_customer_data = array(
            'months' => $month_name_array,
            'customer_count' => $monthly_cusomers_count_array,
            'max' => $max
        );
        return $monthly_customer_data;
    }


    public function getItemData(){
        $items = Item::all();
        $items_name = array();
        $items_total_quantity = array();
        foreach($items as $item){
            array_push($items_name, $item->name);
            array_push($items_total_quantity, $item->total_quantity);
        }
        $max = max($items_total_quantity);
        $items_data = array(
            'names' => $items_name,
            'total_quantity' => $items_total_quantity,
            'max' => $max
        );
       
        return $items_data;
    }
}

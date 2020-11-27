<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


class Fertilizer{
  
    // object properties
    public $farm_size;
    public $age;
    public $nutrients;
    public $calculated_value;
  
   

    public function fert_calculations(){
        //nitrogen
        if($this->nutrients == '1' && $this->age == '1'){
            $this->calculated_value = 35 * (float)$this->farm_size;
            echo json_encode(array("nutrient"=>"nitrogen","amount"=>$this->calculated_value, "recommended_fert"=>  63 * (float)$this->farm_size."Kg of Ammonium Nitrate", "cost"=> 50 * 63 * (float)$this->farm_size)); 

        }else if ($this->nutrients == '1' && $this->age == '2'){
            $this->calculated_value = 70 * (float)$this->farm_size;
            echo json_encode(array("nutrient"=>"nitrogen","amount"=>$this->calculated_value, "recommended_fert"=> 150 * (float)$this->farm_size."Kg of Ammonium Nitrate", "cost"=> 50 * 150 * (float)$this->farm_size)); 

        }else if ($this->nutrients == '1' && $this->age == '3'){
            $this->calculated_value = 140 * (float)$this->farm_size;
            echo json_encode(array("nutrient"=>"nitrogen","amount"=>$this->calculated_value, "recommended_fert"=> 250 * (float)$this->farm_size."Kg of Ammonium Nitrate", "cost"=> 50 * 65 * (float)$this->farm_size)); 

        }else if ($this->nutrients == '1' && $this->age == '4'){
            $this->calculated_value = 250 * (float)$this->farm_size;
            echo json_encode(array("nutrient"=>"nitrogen","amount"=>$this->calculated_value, "recommended_fert"=> 400 * (float)$this->farm_size."Kg of Ammonium Nitrate", "cost"=> 50 * 400 * (float)$this->farm_size)); 

        }
        //phosphorous
        else if ($this->nutrients == '2' && $this->age == '1'){
            $this->calculated_value = 40 * (float)$this->farm_size;
            echo json_encode(array("nutrient"=>"phosphorous","amount"=>"0", "recommended_fert"=>"0Kg", "cost"=> 0)); 

        }else if ($this->nutrients == '2' && $this->age == '2'){
            $this->calculated_value = 0 * (float)$this->farm_size;
            echo json_encode(array("nutrient"=>"phosphorous","amount"=>"0", "recommended_fert"=>"0Kg", "cost"=> 0)); 

        }else if ($this->nutrients == '2' && $this->age == '3'){
            $this->calculated_value = 25 * (float)$this->farm_size;
            echo json_encode(array("nutrient"=>"phosphorous","amount"=>$this->calculated_value, "recommended_fert"=> 40 * (float)$this->farm_size."Kg of MAP", "cost"=> 80 * 40 * (float)$this->farm_size)); 

        }else if ($this->nutrients == '2' && $this->age == '4'){
            $this->calculated_value = 40 * (float)$this->farm_size;
            echo json_encode(array("nutrient"=>"phosphorous","amount"=>$this->calculated_value, "recommended_fert"=> 65 * (float)$this->farm_size."Kg of MAP", "cost"=> 80 * 65 * (float)$this->farm_size )); 

        }

        //potassium
        else if ($this->nutrients == '3' && $this->age == '1'){
            $this->calculated_value = 35 * (float)$this->farm_size;
            echo json_encode(array("nutrient"=>"potassium","amount"=>$this->calculated_value, "recommended_fert"=> 76 * (float)$this->farm_size."Kg of Multi-K", "cost"=> 100 * 76 * (float)$this->farm_size)); 

        }else if ($this->nutrients == '3' && $this->age == '2'){
            $this->calculated_value = 70 * (float)$this->farm_size;
            echo json_encode(array("nutrient"=>"potassium","amount"=>$this->calculated_value, "recommended_fert"=> 152 * (float)$this->farm_size."Kg of Multi-K", "cost"=> 100 * 152 * (float)$this->farm_size)); 

        }else if ($this->nutrients == '3' && $this->age == '3'){
            $this->calculated_value = 175 * (float)$this->farm_size;
            echo json_encode(array("nutrient"=>"potassium","amount"=>$this->calculated_value, "recommended_fert"=> 390 * (float)$this->farm_size."Kg of Multi-K", "cost"=> 100 * 390 * (float)$this->farm_size)); 

        }else if ($this->nutrients == '3' && $this->age == '4'){
            $this->calculated_value = 325 * (float)$this->farm_size;
            echo json_encode(array("nutrient"=>"potassium","amount"=>$this->calculated_value, "recommended_fert"=> 710 * (float)$this->farm_size."Kg of Multi-K", "cost"=> 100 * 710 * (float)$this->farm_size)); 

        }
    }

   
 }


$fert = new Fertilizer();
  
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->farm_size) &&
    !empty($data->age) &&
    !empty($data->nutrients) 
){
  
     // set fert property values
    $fert->farm_size = $data->farm_size;
    $fert->age = $data->age;
    $fert->nutrients = $data->nutrients;
   
    $fert->fert_calculations();
    
}
else{
     // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to calculate Fertilizer. Data is incomplete."));
}
?>
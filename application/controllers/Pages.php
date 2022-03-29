<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	
	 function __construct(){
    parent::__construct();
    $this->load->helper(array('form', 'url','html'));
    $this->load->library("pagination");
    $this->load->library("session");
    $this->load->library('form_validation');
    $this->load->library('user_agent');
    $this->load->model('Conf_model');
    
  }

function book_service()
    {

        $this->load->view('book_service');

    }

    // this function receive ajax request and return closest providers
    function closest_locations(){

      var_dump('jgjgssa'); exit();
        $location =json_decode( preg_replace('/\\\"/',"\"",$_POST['data']));
        $lan=$location->longitude;
        $lat=$location->latitude;
        $ServiceId=$location->ServiceId;

        var_dump($location); exit();
        $base = base_url();
        $providers= $this->Conf_model->get_closest_locations($lan,$lat,$ServiceId);
        $indexed_providers = array_map('array_values', $providers);
        // this loop will change retrieved results to add links in the info window for the provider
        $x = 0;
        foreach($indexed_providers as $arrays => &$array){
            foreach($array as $key => &$value){
                if($key === 1){
                    $pieces = explode(",", $value);
                    $value = "$pieces[1]<a href='$base$pieces[0]'>More..</a>";
                }

                $x++;
            }
        }
        echo json_encode($indexed_providers,JSON_UNESCAPED_UNICODE);

    }



    public function showMap() {
         
        $this->db->select('*');
        $this->db->from('user_locations');
        $query = $this->db->get();
        $records = $query->result_array();
 
        $locationMarkers = [];
        $locInfo = [];
 
        foreach($records as $value) {
          $locationMarkers[] = [
            //$value->location_name, $value->latitude, $value->longitude
            $value['location_name'], $value['latitude'], $value['longitude']

          ];          
          $locInfo[] = [
           "<div class=info_content><h4>".$value['location_name']."</h4><p>".$value['info']."</p></div>"
          ];
        }
        $location['locationMarkers'] = json_encode($locationMarkers);
        $location['locInfo'] = json_encode($locInfo);
     
        $this->load->view('book_service', $location);
    }


public function initChart() {
        $this->db->select('COUNT(id) as count, sell as s, DAYNAME(created_at) as day,name');
        $this->db->where('DAY(created_at) GROUP BY DAYNAME(created_at), s');
        $this->db->from('product');
        $query = $this->db->get();
        $record = $query->result_array();



        // $db = \Config\Database::connect();
        // $builder = $db->table('product');
        // $query = $builder->select("COUNT(id) as count, sell as s, DAYNAME(created_at) as day");
        // $query = $builder->where("DAY(created_at) GROUP BY DAYNAME(created_at), s")->get();
        // $record = $query->getResult();


        $products = [];
        foreach($record as $row) {
            $products[] = array(
                'day'   => $row['day'],
                'name'   => $row['name'],
                'sell' => floatval($row['s'])
            );
        }
        
        $data['products'] = ($products); 

        $this->load->view('piechart', $data);   
        // return view('piechart', $data);                
    }

     public function startChart() {
        
        // $db = \Config\Database::connect();
        // $builder = $db->table('product');
        // $query = $builder->select("COUNT(id) as count, sell as s, DAYNAME(created_at) as day");
        // $query = $builder->where("DAY(created_at) GROUP BY DAYNAME(created_at), s");
        // $query = $builder->orderBy("s ASC, day ASC")->get();

        $this->db->select('COUNT(id) as count, sell as s, DAYNAME(created_at) as day,name');
        $this->db->where('DAY(created_at) GROUP BY DAYNAME(created_at), s');
        $this->db->from('product');
        $this->db->order_by('s ASC, day ASC');
        $query = $this->db->get();
        


        
        $data['products'] = $query->result_array();
        // return view('index', $data); 
        $this->load->view('morrischart', $data);  
    }

        public function barlineChart() {
        
        // $db = \Config\Database::connect();
        // $builder = $db->table('product');
        // $query = $builder->select("COUNT(id) as count, sell as s, DAYNAME(created_at) as day");
        // $query = $builder->where("DAY(created_at) GROUP BY DAYNAME(created_at), s")->get();
        // $record = $query->getResult();

        $this->db->select('COUNT(id) as count, sell as s, DAYNAME(created_at) as day,name');
        $this->db->where('DAY(created_at) GROUP BY DAYNAME(created_at), s');
        $this->db->from('product');
        $query = $this->db->get();
        $record = $query->result_array();

        $products = [];
        foreach($record as $row) {
            $products[] = array(
                'day'   => $row['day'],
                'sell' => floatval($row['s'])
            );
        }
        
        $data['products'] = ($products);    
         $this->load->view('barline', $data);                
    }

     public function columnChart() {
        
        $this->db->select('COUNT(id) as count, sell as s, DAYNAME(created_at) as day,name');
        $this->db->where('DAY(created_at) GROUP BY DAYNAME(created_at), s');
        $this->db->from('product');
        $query = $this->db->get();
        $record = $query->result_array();

        $products = [];
        foreach($record as $row) {
            $products[] = array(
                'day'   => $row['day'],
                'sell' => floatval($row['s'])
            );
        }
        
        $data['products'] = ($products);    
         $this->load->view('columnchart', $data);                
    }

         public function areaChart() {
        
        // $this->db->select('COUNT(id) as count, sell as s, DAYNAME(created_at) as day,name');
        // $this->db->where('DAY(created_at) GROUP BY DAYNAME(created_at), s');
        // $this->db->from('product');
        // $query = $this->db->get();
        // $record = $query->result_array();

        // $products = [];
        // foreach($record as $row) {
        //     $products[] = array(
        //         'day'   => $row['day'],
        //         'sell' => floatval($row['s'])
        //     );
        // }
        
        // $data['products'] = ($products);    
         $this->load->view('area');                
    }

        function mailform() { 
          $this->load->view('mailform');      
        }





        function sendMail() { 
 
        $this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $to = $this->input->post('to');
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }

       function generatepdf()
    {
        $this->load->library('pdf');
        $html = $this->load->view('GeneratePdfView', [], true);
        $this->pdf->createPDF($html, 'mypdf', false);
    }


    public function getlocation()
{
    $address = "Chennai India";
    $array  = $this->getAddress($address);
    $latitude  = round($array['lat'], 6);
    $longitude = round($array['long'], 6);           
}
 
function getAddress($address){
  
$lat =  0;
$long = 0;
 
 $address = str_replace(',,', ',', $address);
 $address = str_replace(', ,', ',', $address);
 
 $address = str_replace(" ", "+", $address);
  try {
        $json = file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$address.'&amp;key=AIzaSyByhtEITGefX2rzt8tkWkXQqyhXYYsEqmw');
        $json1 = json_decode($json);
        
        if($json1->{'status'} == 'ZERO_RESULTS') {
        return [
            'latitude' => 0,
            'longitude' => 0
            ];
        }
 
 if(isset($json1->results)){
    
    $lat = ($json1->{'results'}[0]->{'geometry'}->{'location'}->{'latitude'});
    $long = ($json1->{'results'}[0]->{'geometry'}->{'location'}->{'longitude'});
  }
  } catch(exception $e) { }
    return [
    'latitude' => $latitude,
    'longitude' => $longitude
    ];
}


}

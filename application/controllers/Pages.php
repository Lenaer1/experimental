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
    $this->load->model('Users_model');
    
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
    }

     public function startChart() {
        
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
         
        $this->db->select('year, expenses');
        $this->db->from('area');
        $query = $this->db->get();
        $record = $query->result_array();

        $products = [];
        foreach($record as $row) {
            $products[] = array(
                'year'   => $row['year'],
                'expenses' => $row['expenses']
            );
        }
        
        $data['products'] = ($products); 

         $this->load->view('area', $data);                
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
    // $address = "Chennai India";
    //$array  = $this->getAddress($address);
    // $latitude  = round($array['lat'], 6);
    // $longitude = round($array['long'], 6);
       $getloc = json_decode(file_get_contents("http://ipinfo.io/"));

       $address = $getloc->loc;
       //$array  = $this->getAddress($address);
    

      $city = $getloc->city; //to get city
      $region = $getloc->region;
      $coordinates = explode(",", $getloc->loc); // -> '32,-72' becomes'32','-72'
      $latitude = $coordinates[0]; // latitude
      $longitude =$coordinates[1]; // longitude

    
 
        $locationMarkers = [];
        $locInfo = [];
 
        foreach($getloc as $value) {
          $locationMarkers[] = [
            
            $city, $latitude, $longitude

          ];          
          $locInfo[] = [
           "<div class=info_content><h4>".$region."</h4><p>".$city."</p></div>"
          ];
        }
        $location['locationMarkers'] = json_encode($locationMarkers);
        $location['locInfo'] = json_encode($locInfo);

          $this->load->view('currentlocation', $location);  
}
 
function getAddress($address)
{
    try {
        $lat = 0;
        $lng = 0;

        $data_location = "https://maps.google.com/maps/api/geocode/json?key=".$GOOGLE_API_KEY_HERE."&address=".str_replace(" ", "+", $address)."&sensor=false";
        $data = file_get_contents($data_location);
        usleep(200000);
        // turn this on to see if we are being blocked
        // echo $data;
        $data = json_decode($data);
        if ($data->status=="OK") {
            $lat = $data->results[0]->geometry->location->lat;
            $lng = $data->results[0]->geometry->location->lng;

            if($lat && $lng) {
                return array(
                    'status' => true,
                    'lat' => $lat, 
                    'long' => $lng, 
                    'google_place_id' => $data->results[0]->place_id
                );
            }
        }
        if($data->status == 'OVER_QUERY_LIMIT') {
            return array(
                'status' => false, 
                'message' => 'Google Amp API OVER_QUERY_LIMIT, Please update your google map api key or try tomorrow'
            );
        }

    } catch (Exception $e) {

    }

    return array('lat' => null, 'long' => null, 'status' => false);
}



   public function register() {
  $data['users'] = $this->Users_model->getAllUsers();
         $this->load->view('register', $data);                
    }

      public function saveregister(){
    $this->form_validation->set_rules('email', 'Email', 'valid_email|required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[7]|max_length[30]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');
 
        if ($this->form_validation->run() == FALSE) { 
          $this->load->view('register', $this->data);
    }
    else{
      //get user inputs
      $email = $this->input->post('email');
      $password = $this->input->post('password');
 
      //generate simple random code
      $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $code = substr(str_shuffle($set), 0, 12);
 
      //insert user to users table and get id
      $user['email'] = $email;
      $user['password'] = $password;
      $user['code'] = $code;
      $user['active'] = false;
      $id = $this->Users_model->insert($user);
 
      //set up email
      $config = array(
          'protocol' => 'smtp',
          'smtp_host' => 'smtp.gmail.com',
          'smtp_crypto' => 'tls',
          'smtp_port' => 587,//25,587,465 or 2525
          'smtp_user' => 'amagovelenear@gmail.com', // change it to yours
          'smtp_pass' => 'LAAMMWONDI1.', // change it to yours
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => TRUE
      );
 
      $message =  "
            <html>
            <head>
              <title>Verification Code</title>
            </head>
            <body>
              <h2>Thank you for Registering.</h2>
              <p>Your Account:</p>
              <p>Email: ".$email."</p>
              <p>Password: ".$password."</p>
              <p>Please click the link below to activate your account.</p>
              <h4><a href='".base_url()."Pages/activate/".$id."/".$code."'>Activate My Account</a></h4>

            </body>
            </html>
            ";
 
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($config['smtp_user']);
        $this->email->to($email);
        $this->email->subject('Signup Verification Email');
        $this->email->message($message);
 
        //sending email
        if($this->email->send()){
          $this->session->set_flashdata('message','Activation code sent to email');
        }
        else{
          $this->session->set_flashdata('message', $this->email->print_debugger());
 
        }
 
          redirect('register');
    }
 
  }


 
  public function activate($id, $code){
    $id =  $this->uri->segment(3);
    $code = $this->uri->segment(4);
 //var_dump($id,$code); exit();
    //fetch user details
    $user = $this->Users_model->getUser($id);
 
    //if code matches
    if($user['code'] == $code){
      //update user active status
      $data['active'] = true;
      $query = $this->Users_model->activate($data, $id);
 
      if($query){
        $this->session->set_flashdata('message', 'User activated successfully');
      }
      else{
        $this->session->set_flashdata('message', 'Something went wrong in activating account');
      }
    }
    else{
      $this->session->set_flashdata('message', 'Cannot activate account. Code didnt match');
    }
 
    redirect('register');
 
  }


   public function deleteFiles($path) // define deleteFiles() function that call on the url
     {
        $this->load->helper('file');  // loading the files helper
         echo "<title> Tutorial And Example </title>"; 
   $datas = $path;   // it is the path of the files  
    $del = delete_files($datas);
    echo "File has been deleted".$del;
 }

   public function emailattachment()
 {
  $this->load->view('emailattachment');
 }



 public function sendemailattachment()
 {
  $subject = 'Application for Programmer Registration By - ' . $this->input->post("name");
  $programming_languages = implode(", ", $this->input->post("programming_languages"));
  $file_data = $this->upload_file();
  if(is_array($file_data))
  {
   $message = '
   <h3 align="center">Programmer Details</h3>
    <table border="1" width="100%" cellpadding="5">
     <tr>
      <td width="30%">Name</td>
      <td width="70%">'.$this->input->post("name").'</td>
     </tr>
     <tr>
      <td width="30%">Address</td>
      <td width="70%">'.$this->input->post("address").'</td>
     </tr>
     <tr>
      <td width="30%">Email Address</td>
      <td width="70%">'.$this->input->post("email").'</td>
     </tr>
     <tr>
      <td width="30%">Progamming Language Knowledge</td>
      <td width="70%">'.$programming_languages.'</td>
     </tr>
     <tr>
      <td width="30%">Experience Year</td>
      <td width="70%">'.$this->input->post("experience").'</td>
     </tr>
     <tr>
      <td width="30%">Phone Number</td>
      <td width="70%">'.$this->input->post("mobile").'</td>
     </tr>
     <tr>
      <td width="30%">Additional Information</td>
      <td width="70%">'.$this->input->post("additional_information").'</td>
     </tr>
    </table>
   ';

        $this->load->config('email');
        $this->load->library('email');

        $from = $this->config->item('smtp_user');
        $to = $this->input->post('to');

   //$file_path = 'uploads/' . $file_name;
     // $this->load->library('email', $config);
      $this->email->set_newline("\r\n");
      $this->email->from($from);
      $this->email->to($this->input->post("email"));
      $this->email->subject($subject);

         $this->email->message($message);
         $this->email->attach($file_data['full_path']);
         if($this->email->send())
         {
          if($this->deleteFiles($file_data['file_path']))
          {
           $this->session->set_flashdata('message', 'Application Sent');
           redirect('emailattachment');
          }
         }
         else
         {
          if($this->deleteFiles($file_data['file_path']))
          {
           $this->session->set_flashdata('message', 'There is an error in email send');
           redirect('emailattachment');
          }
         }
     }
     else
     {
      $this->session->set_flashdata('message', 'There is an error in attach file');
         redirect('emailattachment');
     }
 }



 function upload_file()
 {
  $config['upload_path'] = 'uploads/attachments';
  $config['allowed_types'] = 'doc|docx|pdf';
  $this->load->library('upload', $config);
  if($this->upload->do_upload('resume'))
  {
   return $this->upload->data();   
  }
  else
  {
   return $this->upload->display_errors();
  }
 }


}

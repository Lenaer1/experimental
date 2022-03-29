<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Conf_model extends CI_Model{


        function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

 // get closest providers
    // around 30 kilo meters from your location
    // by using latitude , longtuide and service id //
    function get_closest_locations($lng,$lat,$ServiceId){
        $results= $this->db->query("SELECT fullname,CONCAT(ci_providers.user_id,',',ServiceDesc) AS dscr,CONCAT(lat,',', lng) as pos,'http://maps.google.com/mapfiles/ms/icons/green.png' AS icon,
    ( 6371 * acos( cos( radians({$lat}) ) * cos( radians( `lat` ) ) * cos( radians( `lng` ) - radians({$lng}) ) + sin( radians({$lat}) ) * sin( radians( `lat` ) ) ) ) AS distance
    FROM ci_providers
    INNER JOIN ci_services  ON ci_services.user_id = ci_providers.user_id
    AND ci_services.ServiceId = $ServiceId
    HAVING distance <= 30
    ORDER BY distance ASC
      ")->result_array();
        return $results;
    }




    
}
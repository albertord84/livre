<?php
    
    class Watchdog extends CI_Model {
                
        function __construct() {
            parent::__construct();            
        }

        public function add_watchdog($datas){
                       
            $watch_row=NULL;
            try{

                $this->db->insert('watchdog',$datas);
                $watch_row = $this->db->insert_id();


            } catch (Exception $exception) {
                echo 'Error accediendo a la base de datos';
            } finally {
                return $watch_row;
            }

        }       
    }
?>

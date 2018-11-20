<?php
    
    class Hack extends CI_Model {
                
        function __construct() {
            parent::__construct();            
        }

        public function add_hacker($datas){
                       
            $hack_row=NULL;
            try{

                $this->db->insert('hackers',$datas);
                $hack_row = $this->db->insert_id();


            } catch (Exception $exception) {
                echo 'Error accediendo a la base de datos';
            } finally {
                return $hack_row;
            }

        }
        
        public function add_ip_hacker($datas){
                       
            $ip_row=NULL;
            try{

                $this->db->insert('ip_hackers',$datas);
                $ip_row = $this->db->insert_id();


            } catch (Exception $exception) {
                echo 'Error accediendo a la base de datos';
            } finally {
                return $ip_row;
            }

        }       
        
        public function is_data_hacker($field, $value){
                       
            $hack_row=NULL;
            try{

                $this->db->select('*');
                $this->db->from('hackers'); 
                $this->db->where($field, $value);                
                $this->db->where('release', '0');                
                $hack_row = $this->db->get()->row_array();

            } catch (Exception $exception) {
                echo 'Error accediendo a la base de datos';
            } finally {
                return $hack_row;
            }

        }    
        
        public function is_ip_hacker($ip){
                       
            $hack_row=NULL;
            try{

                $this->db->select('*');
                $this->db->from('ip_hackers'); 
                $this->db->where('ip', $ip);
                $this->db->where('release', '0');                
                $hack_row = $this->db->get()->row_array();

            } catch (Exception $exception) {
                echo 'Error accediendo a la base de datos';
            } finally {
                return $hack_row;
            }

        }       
    }
?>

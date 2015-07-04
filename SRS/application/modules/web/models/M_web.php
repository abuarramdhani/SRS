<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_web
 *
 * @author ariefmanggala
 */
class M_web extends CI_Model {
    
    function cek($username,$password){
        $this->db->where("username",$username);
        $this->db->where("password",$password);
        return  $this->db->get("users");
        
    }
    
}

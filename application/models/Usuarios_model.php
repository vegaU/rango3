<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_MOdel {

    public function getUsuarios(){
        $this->db->select("u.*,r.nombre as rol");
        $this->db->from("usuarios u");
        $this->db->join("roles r","u.rol_id = r.id");            
        $this->db->where("u.estado","1");
        $resultados = $this->db->get();   
        return $resultados->result();
    }

    public function getUsuario($id){
        $this->db->select("u.*,r.nombre as rol");
        $this->db->from("usuarios u");
        $this->db->join("roles r","u.rol_id = r.id");            
        $this->db->where("u.id",$id);
        $this->db->where("u.estado","1");
        
        $resultado = $this->db->get();
        return $resultado->row();
    }

    public function getRoles(){
        $resultados = $this->db->get("roles");
        return $resultados->result();
    }
    public function save($data){
        return $this->db->insert("usuarios",$data);
    }
//funcion que recibe como parametro el user y contraseña
	public function login($username, $password){
        //consultas a la base de datos
        $this->db->where("username",$username);//se llama a la clase db, al metodo where
        $this->db->where("password",$password);
//captura de los valores con get de la tabla usuarios
        $resultados = $this->db->get("usuarios");
//se crea una condicion de los registros
//si es mayor a 0 entonces, devolver las filas que existen
        if ($resultados->num_rows()>0) {
            return $resultados->row();
        }
        else{
            return false;
        }
    }
    public function update($id,$data){
        $this->db->where("id",$id);
        return $this->db->update("usuarios",$data);

}
}
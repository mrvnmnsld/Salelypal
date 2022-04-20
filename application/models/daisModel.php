<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class daisModel extends CI_Model {
    
    //--------------------------------------------------------------------------------------------------------------------------------------
    //GET RECORDS BY GENERIC ACCESS VERSION1
	function getRecords($tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial) {
		$q = $this->db->select('*')
			 ->distinct()
			 ->from($tables[0]); 
			 
			 //JOIN---------------------------------------
			 if(!empty($join)) {
				 for($i = 0; $i < count($join);$i++) {
					$q->join($tables[$i + 1], $join[$i],  $joinType[$i]);
				 }
			 }
			 
			 //WHERE--------------------------------------
			 if(!empty($where)) {
				 for($i = 0; $i < count($where);  $i++) {
					$q->where($fieldName[$i],  $where[$i]); 
				 }
			 }

			 //WHERE SPECIAL--------------------------------------
			 if(!empty($whereSpecial)) {
				 for($i = 0; $i < count($whereSpecial);  $i++) {
					$q->where($whereSpecial[$i]);
				 }
			 }
			 
			 
			 //LIKE--------------------------------------
			 if(!empty($like)) {
				 for($i = 0; $i < count($like);  $i++) {
					$q->like($fieldNameLike[$i],  $like[$i]);
				 }
			 }
			 
			 
			 //ORDER BY----------------------------------
			 if(!empty($sortBy)) {
				 for($i = 0; $i < count($sortBy);  $i++) {
					$q->order_by($sortBy[$i],  $sortOrder[$i]);
				 }
			 }
			 //LIMIT----------------------------------
			 if(!empty($limit)) {
				$q->limit($limit[0],  $limit[1]);
			 }
			 
		$data = $q->get()->result();
        return $data;
	}
    //GET RECORDS BY GENERIC ACCESS VERSION 1
    //--------------------------------------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------------------------------------
    //GET RECORDS BY GENERIC ACCESS VERSION2
	function getRecordsData($data, $tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial, $groupBy) {

		//DATA--------------------------------------
		$dataSelect = null;
		if(!empty($data)) {
			for($i = 0; $i < count($data);  $i++) {
				if($i == 0) {
					$dataSelect = $dataSelect . $data[$i];
				} else {	
					$dataSelect = $dataSelect . ", " . $data[$i];
				}
			}
		}
		
		$q = $this->db->select($dataSelect)
			 ->distinct()
			 ->from($tables[0]); 
			 
			 //JOIN---------------------------------------
			 if(!empty($join)) {
				 for($i = 0; $i < count($join);$i++) {
					$q->join($tables[$i + 1], $join[$i],  $joinType[$i]);
				 }
			 }
			 
			 //WHERE--------------------------------------
			 if(!empty($where)) {
				 for($i = 0; $i < count($where);  $i++) {
					$q->where($fieldName[$i],  $where[$i]); 
				 }
			 }

			 //WHERE SPECIAL--------------------------------------
			 if(!empty($whereSpecial)) {
				 for($i = 0; $i < count($whereSpecial);  $i++) {
					$q->where($whereSpecial[$i]);
				 }
			 }
			 
			 
			 //LIKE--------------------------------------
			 if(!empty($like)) {
				 for($i = 0; $i < count($like);  $i++) {
					$q->like($fieldNameLike[$i],  $like[$i]);
				 }
			 }
			 
			 
			 //ORDER BY----------------------------------
			 if(!empty($sortBy)) {
				 for($i = 0; $i < count($sortBy);  $i++) {
					$q->order_by($sortBy[$i],  $sortOrder[$i]);
				 }
			 }
			 //LIMIT----------------------------------
			 if(!empty($limit)) {
				$q->limit($limit[0],  $limit[1]);
			 }
			 //GROUP BY----------------------------------
			 if(!empty($groupBy)) {
				 for($i = 0; $i < count($groupBy);  $i++) {
					$q->group_by($groupBy[$i]);
				 }
			 }
			 
		$data = $q->get()->result();
        return $data;
	}
    //GET RECORDS BY GENERIC ACCESS VERSION 2
    //--------------------------------------------------------------------------------------------------------------------------------------
    
    //------------------------------------------------------------------------
    //UPDATE RECORDS
	function updateRecords($tableName, $fieldName, $where, $data){
		//WHERE--------------------------------------
		if(!empty($where)) {
			for($i = 0; $i < count($where);  $i++) {
		    	$this->db->where($fieldName[$i], $where[$i]);
			}
		}
		$this->db->update($tableName, $data);

		return 1;
    }
    //UPDATE RECORDS
    //------------------------------------------------------------------------



    //------------------------------------------------------------------------
    //INSERT RECORDS
	function insertRecords($tableName, $data){
		$id = $this->db->insert($tableName, $data);
		
		return $this->db->insert_id();
	}
    //INSERT RECORDS
    //------------------------------------------------------------------------

    //------------------------------------------------------------------------
    //DELETE RECORDS
	function deleteRecords($tableName, $fieldName, $where){
		if(!empty($where)) {
			for($i = 0; $i < count($where);  $i++) {
		    	$this->db->where($fieldName[$i], $where[$i]);
			}
		}
		$this->db->delete($tableName);
		
		return 1;
	}	
    //DELETE RECORDS
    //------------------------------------------------------------------------

  ////-----------------------------------------------TRIUNEDB----------------------------------------------------------



}

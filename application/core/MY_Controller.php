<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('daisModel');
        $this->load->library('encryption');
        $this->load->helper('file');

        // header('Content-Type: application/json');
        // echo json_encode($phparray); 
    }

    function _getRecords($tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial) {
        $rows = $this->daisModel->getRecords($tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial);
        return $rows;
    }

    function _getRecordsData($data, $tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial, $groupBy) {
        $rows = $this->daisModel->getRecordsData($data, $tables, $fieldName, $where, $join, $joinType, $sortBy, $sortOrder, $limit, $fieldNameLike, $like, $whereSpecial, $groupBy);
        return $rows;
    }

    function _updateRecords($tableName, $fieldName, $where, $data) {
        $rows = $this->daisModel->updateRecords($tableName, $fieldName, $where, $data);
        return $rows;
    }


    function _insertRecords($tableName, $data) {
        $rows = $this->daisModel->insertRecords($tableName, $data);
        return $rows;
    }

    function _deleteRecords($tableName, $fieldName, $where) {
        $rows = $this->daisModel->deleteRecords($tableName, $fieldName, $where);
        return $rows;
    }

    function _getCurrentDate() {
        $currentDate = date('Y-m-d');
        return $currentDate;
    }

    function _getTimeStamp() {
        $timeStamp = date('Y-m-d h:i:s');
        return $timeStamp;
    }

    function _getTimeStamp24Hours() {
        $timeStamp = date('Y-m-d H:i:s');
        return $timeStamp;
    }

    function _findObjectById($searchThis,$object){
        foreach ($object as $element) {
            if ( $searchThis == $element->token ) {
                return $element;
            }
        }

        return false;
    }

    function _getPercentageChange($original,$current){
        return round($percentChange = ($current - $original)/$original * 100,4);
    }

    


}

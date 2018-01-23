<?php

class Page_Admin_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->db = new Database();
    }

    function pageList() {
        return $this->db->select("SELECT A.`page_id`, A.`page_name`, A.`page_create_date`, B.`fname`, B.`lname`, A.`page_url` FROM `page` A LEFT JOIN `user` B ON B.`id` = A.`page_author_id`;");
    }

    function pageSingle($data) {
        return $this->db->select("SELECT A.`page_id`, A.`page_name`, A.`page_content`, A.`page_seo_title`, A.`page_url`, A.`page_seo_description`, A.`page_image_id`, B.`path` FROM `page` A LEFT JOIN `upload` B ON A.`page_image_id` = B.`id` WHERE A.`page_id` = :page_id;", array(
                    ":page_id" => $data
        ));
    }

    function getImages($type) {
        return $this->db->select("SELECT * FROM `upload` WHERE `type` = :type; ", array(
                    ":type" => $type
        ));
    }

}

<?php

class Page_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->db = new Database();
    }

    public function pageInfo($id) {
        return $this->db->select("select A.`page_name`,A.`page_content`,A.`page_create_date`,A.`page_seo_title`,A.`page_seo_description`,B.`fname`,B.`lname`,C.`path`
FROM `page` A
LEFT JOIN `user` B ON A.`page_author_id` = B.`id`
LEFT JOIN `upload` C on A.`page_image_id` = C.`id`
WHERE
A.`page_id` = {$id};");
    }

}

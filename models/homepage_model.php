<?php

class Homepage_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->db = new Database();
    }

    public function getBlog($number) {
        return $this->db->select("SELECT A.`blog_name`, A.`blog_short_text`, A.`blog_url`, A.`blog_create_date`, B.`fname`, B.`lname`, C.`path`, D.`path` `avatar` FROM `blog` A LEFT JOIN `user` B ON A.`blog_author_id` = B.`id` LEFT JOIN `upload` C ON A.`blog_image_id` = C.`id` LEFT JOIN `upload` D ON B.`image_id` = D.`id` ORDER BY A.`blog_create_date` DESC LIMIT {$number};");
    }

}

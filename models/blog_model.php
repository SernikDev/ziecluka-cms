<?php

class Blog_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->db = new Database();
    }
    
    public function blogInfo($id){
        return $this->db->select("select A.`blog_name`,A.`blog_content`,A.`blog_create_date`,A.`blog_seo_title`,A.`blog_seo_description`,B.`fname`,B.`lname`,C.`path`
from blog A
left join user B on A.`blog_author_id` = B.`id`
left join upload C on A.`blog_image_id` = C.`id`
where
A.`blog_id` = {$id};");
    }

}
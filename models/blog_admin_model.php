<?php

class Blog_Admin_Model extends Model {

    private $_blogUpdateUrl = null;

    function __construct() {
        parent::__construct();
        $this->db = new Database();
    }

    function blogList() {
        return $this->db->select("SELECT A.`blog_id`, A.`blog_name`, A.`blog_create_date`, B.`fname`, B.`lname`, A.`blog_url` FROM `blog` A LEFT JOIN `user` B ON B.`id` = A.`blog_author_id`;");
    }

    function blogSingle($data) {
        return $this->db->select("SELECT A.`blog_id`, A.`blog_name`, A.`blog_short_text`, A.`blog_content`, A.`blog_seo_title`, A.`blog_url`, A.`blog_seo_description`, A.`blog_image_id`, B.`path` FROM `blog` A LEFT JOIN `upload` B ON A.`blog_image_id` = B.`id` WHERE A.`blog_id` = :blog_id;", array(
                    ":blog_id" => $data
        ));
    }

    function blogUpdate($blog_id, $blog_short_text, $blog_image, $blog_name, $blog_content, $blog_seo_title, $blog_url, $blog_seo_description) {

        if ($this->checkAliasChange($blog_id, $blog_url) == true) {
            $this->_blogUpdateUrl = $blog_url;
        } else {
            $this->_blogUpdateUrl = $this->setUniqueBlogUrl($blog_url);
        }

        $this->db->update("UPDATE `blog` SET `blog_name` = :blog_name, `blog_short_text` = :blog_short_text, `blog_content` = :blog_content, `blog_seo_title` = :blog_seo_title, `blog_url` = :blog_url, `blog_seo_description` = :blog_seo_description, `blog_image_id` = :blog_image WHERE `blog_id` = :blog_id;", array(
            ':blog_name' => $blog_name,
            ':blog_short_text' => $blog_short_text,
            ':blog_content' => $blog_content,
            ':blog_seo_title' => $blog_seo_title,
            ':blog_url' => $this->_blogUpdateUrl,
            ':blog_seo_description' => $blog_seo_description,
            ':blog_image' => $blog_image,
            ':blog_id' => $blog_id
        ));

        $this->updateGlobalAlias($blog_id, $this->_blogUpdateUrl);
    }

    function checkAliasChange($id, $alias) {
        $sql = $this->db->select("SELECT * FROM `alias` WHERE `controller` = :controller;", array(
            ":controller" => "blog/view/{$id}"
        ));

        if ($sql[0]["alias"] == $alias) {
            return true;
        } else {
            return false;
        }
    }

    function blogAdd($blog_short_text, $blog_image, $blog_name, $blog_content, $blog_author_id, $blog_seo_title, $blog_url, $blog_seo_description) {

        $url = $this->setUniqueBlogUrl($blog_url);

        $this->db->insert("INSERT INTO `blog` (`blog_name`, `blog_content`, `blog_short_text`, `blog_author_id`, `blog_create_date`, `blog_seo_title`, `blog_url`, `blog_seo_description`, `blog_image_id`) VALUES (:blog_name, :blog_content, :blog_short_text, :blog_author_id, NOW(), :blog_seo_title, :blog_url, :blog_seo_description, :blog_image);", array(
            ':blog_name' => $blog_name,
            ':blog_content' => $blog_content,
            ':blog_short_text' => $blog_short_text,
            ':blog_author_id' => $blog_author_id,
            ':blog_seo_title' => $blog_seo_title,
            ':blog_url' => $url,
            ':blog_seo_description' => $blog_seo_description,
            ':blog_image' => $blog_image
        ));

        $getId = $this->db->select("SELECT `blog_id` FROM `blog` WHERE `blog_url` = :blog_url;", array(
            ":blog_url" => $url
        ));
        $id = $getId[0]["blog_id"];
        $this->addGlobalAlias($id, $url);
    }

    function addGlobalAlias($id, $url) {
        $this->db->insert("INSERT INTO `alias` (`controller`, `alias`) VALUES (:controller, :alias);", array(
            ":controller" => "blog/view/{$id}",
            ":alias" => $url
        ));
    }

    function updateGlobalAlias($id, $url) {
        $this->db->update("UPDATE `alias` SET `alias` = :alias WHERE `controller` = :controller;", array(
            ":controller" => "blog/view/{$id}",
            ":alias" => $url
        ));
    }

    function checkBlogUrl($data) {

        $sql = "SELECT `id` FROM `alias` WHERE `alias` = :alias';";
        $bind = array(":alias" => $data);

        if ($this->db->numRows($sql, $bind)->rowCount() == 0) {
            return true;
        }
    }

    function checkBlogId($data) {

        $sql = "SELECT `blog_id` FROM `blog` WHERE `blog_id` = :id;";
        $bind = array(":id" => $data);

        if ($this->db->numRows($sql, $bind)->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

    function setUniqueBlogUrl($data) {

        $newurl = null;
        $i = 1;

        $sql = $this->db->numRows("SELECT `id` FROM `alias` WHERE `alias` = :alias;", array(
            ":alias" => $data
        ));

        if ($sql->rowCount() == 0) {
            $newurl = $data;
        } else {
            do {
                $url = $data . "-" . $i;
                $select = $this->db->numRows("SELECT `id` FROM `alias` WHERE `alias` = :alias;", array(
                    ":alias" => $url
                ));
                $newurl = $url;
                $i++;
            } while ($select->rowCount() == 1);
        }

        return $newurl;
    }

    function getImages($type) {
        return $this->db->select("SELECT * FROM `upload` WHERE `type` = :type; ", array(
                    ":type" => $type
        ));
    }

    function deleteArticle($id) {
        $this->db->delete("DELETE FROM `blog` WHERE `blog_id` = :id;", array(
            ":id" => $id
        ));
        $this->db->delete("DELETE FROM `alias` WHERE `controller` = :controller;", array(
            ":controller" => "blog/view/$id"
        ));
    }

}

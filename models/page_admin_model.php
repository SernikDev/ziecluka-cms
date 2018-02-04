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

    function pageUpdate($page_id, $page_name, $page_content, $page_seo_title, $page_url, $page_seo_description) {

        if ($this->checkAliasChange($page_id, $page_url) == true) {
            $this->_pageUpdateUrl = $page_url;
        } else {
            $this->_pageUpdateUrl = $this->setUniquePageUrl($page_url);
        }

        $this->db->update("UPDATE `page` SET `page_name` = :page_name, `page_content` = :page_content, `page_seo_title` = :page_seo_title, `page_url` = :page_url, `page_seo_description` = :page_seo_description WHERE `page_id` = :page_id;", array(
            ':page_name' => $page_name,
            ':page_content' => $page_content,
            ':page_seo_title' => $page_seo_title,
            ':page_url' => $this->_pageUpdateUrl,
            ':page_seo_description' => $page_seo_description,
            ':page_id' => $page_id
        ));

        $this->updateGlobalAlias($page_id, $this->_pageUpdateUrl);
    }

    function checkAliasChange($id, $alias) {
        $sql = $this->db->select("SELECT * FROM `alias` WHERE `controller` = :controller;", array(
            ":controller" => "page/view/{$id}"
        ));

        if ($sql[0]["alias"] == $alias) {
            return true;
        } else {
            return false;
        }
    }

    function pageAdd($page_name, $page_content, $page_author_id, $page_seo_title, $page_url, $page_seo_description) {

        $url = $this->setUniquePageUrl($page_url);

        $this->db->insert("INSERT INTO `page` (`page_name`, `page_content`, `page_author_id`, `page_create_date`, `page_seo_title`, `page_url`, `page_seo_description`) VALUES (:page_name, :page_content, :page_author_id, NOW(), :page_seo_title, :page_url, :page_seo_description);", array(
            ':page_name' => $page_name,
            ':page_content' => $page_content,
            ':page_author_id' => $page_author_id,
            ':page_seo_title' => $page_seo_title,
            ':page_url' => $url,
            ':page_seo_description' => $page_seo_description,
        ));

        $getId = $this->db->select("SELECT `page_id` FROM `page` WHERE `page_url` = :page_url;", array(
            ":page_url" => $url
        ));
        $id = $getId[0]["page_id"];
        $this->addGlobalAlias($id, $url);
    }

    function addGlobalAlias($id, $url) {
        $this->db->insert("INSERT INTO `alias` (`controller`, `alias`) VALUES (:controller, :alias);", array(
            ":controller" => "page/view/{$id}",
            ":alias" => $url
        ));
    }

    function updateGlobalAlias($id, $url) {
        $this->db->update("UPDATE `alias` SET `alias` = :alias WHERE `controller` = :controller;", array(
            ":controller" => "page/view/{$id}",
            ":alias" => $url
        ));
    }

    function checkPageUrl($data) {

        $sql = "SELECT `id` FROM `alias` WHERE `alias` = :alias';";
        $bind = array(":alias" => $data);

        if ($this->db->numRows($sql, $bind)->rowCount() == 0) {
            return true;
        }
    }

    function checkPageId($data) {

        $sql = "SELECT `page_id` FROM `page` WHERE `page_id` = :id;";
        $bind = array(":id" => $data);

        if ($this->db->numRows($sql, $bind)->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

    function setUniquePageUrl($data) {

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
    
    function deletePage($id) {
        $this->db->delete("DELETE FROM `page` WHERE `page_id` = :id;", array(
            ":id" => $id
        ));
        $this->db->delete("DELETE FROM `alias` WHERE `controller` = :controller;", array(
            ":controller" => "page/view/{$id}"
        ));
    }

}

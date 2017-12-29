<?php

class Account_Model extends Model {

    function __construct() {
        parent::__construct();
        $this->db = new Database();
    }

    function accountProfile($id) {
        return $this->db->select("SELECT A.`login`, A.`fname`, A.`lname`, A.`email`, A.`born_date`, A.`sex`, A.`account_creation`, B.`path` FROM `user` A LEFT JOIN `upload` B ON A.`image_id` = B.`id` WHERE A.`id` = :id;", array(
                    ":id" => $id
        ));
    }

    function age($id) {
        $this->age = $this->accountProfile($id);

        foreach ($this->age as $value) {
            $borndate = $value["born_date"];
        }

        $born = date_create($borndate);
        $curdate = date_create(date("Y-m-d"));
        $age = date_diff($born, $curdate);

        return $age->format("%y");
    }

    function changeLogin($id, $data) {
        $this->db->update("UPDATE `user` SET `login` = :login WHERE `id` = :id;", array(
            ":login" => $data,
            ":id" => $id
        ));
    }

    function changeFirstName($id, $data) {
        $this->db->update("UPDATE `user` SET `fname` = :fname WHERE `id` = :id;", array(
            ":fname" => $data,
            ":id" => $id
        ));
    }

    function changeLastName($id, $data) {
        $this->db->update("UPDATE `user` SET `lname` = :lname WHERE `id` = :id;", array(
            ":lname" => $data,
            ":id" => $id
        ));
    }

    function changeEMail($id, $data) {
        $this->db->update("UPDATE `user` SET `email` = :email WHERE `id` = :id;", array(
            ":email" => $data,
            ":id" => $id
        ));
    }

    function changeGender($id, $data) {
        $this->db->update("UPDATE `user` SET `sex` = :gender WHERE `id` = :id;", array(
            ":gender" => $data,
            ":id" => $id
        ));
    }

    function changeBornDate($id, $data) {
        $this->db->update("UPDATE `user` SET `born_date` = :born_date WHERE `id` = :id;", array(
            ":born_date" => $data,
            ":id" => $id
        ));
    }

    function changePassword($id, $data) {
        $this->newsalt = new HashSalt();
        $array = $this->newsalt->create($data);
        $this->db->update("UPDATE `user` SET `salt` = :salt, `pass` = :pass' WHERE `id` = :id;", array(
            ":salt" => $array["salt"],
            ":pass" => $array["hash"],
            ":id" => $id
        ));
    }

    function verifyPassword($id = null, $data) {

        $password = null;
        $hash = null;

        $query = $this->db->select("SELECT `salt`, `pass` FROM `user` WHERE `id` = :id;", array(
            ":id" => $id
        ));

        if (!empty($query)) {
            $password = $data . $query[0]["salt"];
            $hash = $query[0]["pass"];
        }

        if (password_verify($password, $hash)) {
            return 1;
        } else {
            return 2;
        }
    }

    public function setAvatar($data, $user) {
        if (empty($data)) {
            return false;
        } else {
            foreach ($data as $key => $value) {
                $this->db->insert("INSERT INTO `upload` (`filename`, `size`, `path`, `type`, `upload_date`) VALUES (:filename, :size, :path, :type, NOW());", array(
                    ":filename" => $value["filename"],
                    ":size" => $value["size"],
                    ":path" => $value["path"] . $value["filename"],
                    ":type" => $value["type"]
                ));

                $this->id = $this->db->select("SELECT `id` FROM `upload` WHERE `path` = :path;", array(
                    ":path" => $value["path"] . $value["filename"]
                ));

                $this->db->update("UPDATE `user` SET `image_id` = :image WHERE `id` = :user;", array(
                    ":image" => $this->id[0]["id"],
                    ":user" => $user
                ));
            }
        }
    }

}

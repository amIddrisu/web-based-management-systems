<?php

require '../include/header.php';

class role {

    public $role_id;
    public $name;
    public $plink;
    public $permissions = array();

    public function __construct() {
        global $link;
        $this->plink = $link;
    }

    function getRole($id) {

        $sql = "SELECT * from roles where role_id=" . $id;
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $role = new role();
        if ($count == 1) {
            $role = $this->role($row);
        }
        return $role;
    }

    function addRole() {

        $this->name = $_POST['name'];
        $submitteddate = date("d-m-Y H:i:s");
        $submittedby_id = $_SESSION["loggedin"];

        $query = "INSERT INTO roles (name,submittedby_id,submitteddate) VALUES ('$this->name','$submittedby_id','$submitteddate');";

        mysqli_query($this->plink, $query);
        // close connection

      //  mysqli_close($this->plink);
        $url = "../view/roleList.php";
        redirect($url);
    }

    function deleteRole($id, $all = false) {

        if ($all) {
            $query = "DELETE from roles  where role_id in (" . $id . ")";
        } else {
            $query = "DELETE from roles  where role_id=" . "'$id'";
        }

        mysqli_query($this->plink, $query);
        // close connection
        //mysqli_close($this->plink);
        $url = "../view/roleList.php";
        redirect($url);
    }

    function editRole($id) {

        $this->name = $this->valInput($_POST['name']);

        $modifieddate = date("d-m-Y H:i:s");
        $modifiedby_id = $_SESSION["loggedin"];

        $query = "UPDATE roles SET name='$this->name',modifieddate='$modifieddate',
   			modifiedby_id='$modifiedby_id' WHERE role_id=" . "'$id'";

        mysqli_query($this->plink, $query);
        // close connection
       // mysqli_close();
        $url = "../view/roleList.php";

        redirect($url);
    }

    function role($row) {
        if (!empty($row)) {
            $role = new role();
            foreach ($row as $key => $value) {
                $role->$key = $value;
            }
            return $role;
        }
    }

    function getRoles() {

        //sql to return all role objects
        $sql = "SELECT * from roles";
        $roles = array();
        $result = mysqli_query($this->plink, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $roles[] = $this->role($row);
        }

        return $roles;
    }


// delete array of roles, and all associations
    public static function deleteRoles($roles) {
        //TODO
    }

// delete ALL roles for specified user id
    public static function deleteUserRoles($user_id) {
        //TODO
    }



}

<?php

require '../include/header.php';

class permission {

    public $perm_id;
    public $perm_desc;
    public $plink;
    public $role;

    public function __construct() {
        global $link;
        $this->plink = $link;
    }

    function getPermission($id) {

        $sql = "SELECT * from permissions where perm_id=" . $id;
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $permission = new permission();
        if ($count == 1) {
            $permission = $this->permission($row);
        }
        return $permission;
    }

    function addPermission() {

        $this->perm_desc = $_POST['perm_desc'];
        $submitteddate = date("d-m-Y H:i:s");
        $submittedby_id = $_SESSION["loggedin"];

        $query = "INSERT INTO permissions (perm_desc,submittedby_id,submitteddate) "
                . "VALUES ('$this->perm_desc','$submittedby_id','$submitteddate');";

        mysqli_query($this->plink, $query);
        // close connection

       // mysqli_close($this->plink);
        $url = "../view/permissionList.php";
        redirect($url);
    }

    function deletePermission($id, $all = false) {

        if ($all) {
            $query = "DELETE from permissions  where perm_id in (" . $id . ")";
        } else {
            $query = "DELETE from permissions  where perm_id=" . "'$id'";
        }

        mysqli_query($this->plink, $query);
        // close connection
      //  mysqli_close($this->plink);
        $url = "../view/permissionList.php";
        redirect($url);
    }

    function editPermission($id) {

        $this->perm_desc = $_POST['perm_desc'];

        $modifieddate = date("d-m-Y H:i:s");
        $modifiedby_id = $_SESSION["loggedin"];

        $query = "UPDATE permissions SET name='$this->perm_desc',modifieddate='$modifieddate',
   			modifiedby_id='$modifiedby_id' WHERE perm_id=" . "'$id'";
        mysqli_query($this->plink, $query);
        // close connection
      //  mysqli_close($this->plink);
        $url = "../view/permissionList.php";

        redirect($url);
    }

    function permission($row) {
        if (!empty($row)) {
            $permission = new permission();
            foreach ($row as $key => $value) {
                $permission->$key = $value;
            }
            return $permission;
        }
    }

    function getPermissions() {

        //sql to return all permission objects
        $sql = "SELECT * from permissions";
        $permissions = array();
        $result = mysqli_query($this->plink, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $permissions[] = $this->permission($row);
        }

        return $permissions;
    }

// check if a role is set
    public static function hasRole($role) {
        return isset($this->role);
    }

}

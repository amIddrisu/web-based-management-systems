<?php

require '../include/header.php';

class role_perm {

    public $id;
    public $role_id;
    public $page_id;
    public $perm_id;

    public function __construct() {
        global $link;
        $this->plink = $link;
    }

    public function showUserRoleOptions() {

        $sql = "SELECT * from roles";

        $result = mysqli_query($this->plink, $sql);
        $opt = '<option value="null"> Select User Role</option>';
        while ($row = mysqli_fetch_assoc($result)) {

            $opt .='<option value="' . $row['role_id'] . '">' . $row['name'] . '</option>';
        }
        echo $opt;
    }

    public function updateUserRoleOptions($id) {

        if (!is_null($id) || !empty($id)) {

            $opt = '';

            $perms = "select * from role_perm where id=" . '"' . $id . '"';

           
            $resultPerms = mysqli_query($this->plink, $perms);

            $resultPermsRows = mysqli_fetch_assoc($resultPerms);

            $sql = "SELECT * from roles where role_id=" . $resultPermsRows['role_id'];
            
            $resultRole = mysqli_query($this->plink, $sql);
            $rowRole = mysqli_fetch_assoc($resultRole);

            $opt = '<option value="' . $rowRole['role_id'] . '">' . $rowRole['name'] . '</option>';

            $sql = "SELECT * from roles";

            $result = mysqli_query($this->plink, $sql);
            while ($row = mysqli_fetch_assoc($result)) {

                $opt .='<option value="' . $row['role_id'] . '">' . $row['name'] . '</option>';
            }
            echo $opt;
        }
    }

    public function showPagesOptions() {

        $sql = "SELECT * from pages";

        $result = mysqli_query($this->plink, $sql);
        $opt = '<option value="null"> Select Permitted Pages</option>';
        while ($row = mysqli_fetch_assoc($result)) {
            $opt .='<option value="' . $row['page_id'] . '">' . $row['page_desc'] . '</option>';
        }
        echo $opt;
    }

    public function updatePagesOptions($id) {

        if (!is_null($id) || !empty($id)) {

            $perms = "select * from role_perm where id=" . '"' . $id . '"';

            
            $resultPerms = mysqli_query($this->plink, $perms);

            $resultPermsRows = mysqli_fetch_assoc($resultPerms);

            $sql = "SELECT * from pages where page_id=" . $resultPermsRows['page_id'];
          
            $resultPage = mysqli_query($this->plink, $sql);

            $rowPage = mysqli_fetch_assoc($resultPage);

            $opt = '<option value="' . $rowPage['page_id'] . '">' . $rowPage['page_desc'] . '</option>';

            $sql = "SELECT * from pages";

            $result = mysqli_query($this->plink, $sql);
            while ($row = mysqli_fetch_assoc($result)) {

                $opt .='<option value="' . $row['page_id'] . '">' . $row['page_desc'] . '</option>';
            }
            echo $opt;
        }
    }

    public function showPermissionsCheckboxes() {

        $sql = "SELECT * from permissions";

        $result = mysqli_query($this->plink, $sql);
        $opt = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $k = "value='" . $row['perm_desc'] . "'";
            $opt .= ' <input ' . $k . 'class="control-label input-label" name="permCheckboxes[]" type="checkbox"    id="' . $row['perm_id'] . '"/>' . ' ' . $row['perm_desc'] . '<br>';
        }
        echo $opt;
    }

    public function updatePermissionsCheckboxes($id) {
        if (!is_null($id) || !empty($id)) {
            $perms = "select * from role_perm where id=" . '"' . $id . '"';

            $resultPerms = mysqli_query($this->plink, $perms);
            
            $resultPermsRows = mysqli_fetch_assoc($resultPerms);
            //sql to return all permission objects
            $sql = "SELECT * from permissions";
            $permissions = array();
            $resultp = mysqli_query($this->plink, $sql);

            while ($rowp = mysqli_fetch_assoc($resultp)) {
                $rowsperms[] = $rowp;
            }
            foreach ($rowsperms as $rowpm) {
                $permissions[] = $rowpm['perm_desc'];
            }
            $specificPermkk = explode(",", $resultPermsRows['perm_id']);

            $resultChecked = array_intersect($specificPermkk, $permissions);
            $opt = '';
            foreach ($permissions as $key => $value) {
                if (in_array($value, $resultChecked)) {

                    $k = "value='" . $value . "'";
                    $opt .= ' <input ' . $k . 'class="control-label input-label" checked="checked" name="permCheckboxes[]" type="checkbox"    id="' . $key . '"/>' . ' ' . $value . '<br>';
                } else {
                    $k = "value='" . $value . "'";
                    $opt .= ' <input ' . $k . 'class="control-label input-label" name="permCheckboxes[]" type="checkbox"    id="' . $key . '"/>' . ' ' . $value . '<br>';
                }
            }
            echo $opt;
        }
    }

    function getRolePagePerm($id) {

        $sql = "SELECT * from role_perm where id=" . $id;
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $role_perm = new role_perm();
        if ($count == 1) {
            $role_perm = $this->rolePagePerm($row);
        }
        return $role_perm;
    }

    function addRolePagePerm($id) {
         
         $this->role_id = $_POST['role_id'];
        $this->page_id = $_POST['page_id'];
        $this->perm_id = implode(",", $_POST['permCheckboxes']);
        $role_perm = new role_perm();
        
         if(!($role_perm->id == null) || !empty($role_perm->id)) {
         $role_perm = $this->getRolePagePerm($id);
         $this->editRolePagePerm($role_perm->id);
         }

            $query = "INSERT INTO role_perm (role_id,perm_id,page_id) VALUES ('" . $this->role_id . "','" . $this->perm_id . "','" . $this->page_id . "');";
       
        mysqli_query($this->plink, $query);
        // close connection
        // mysqli_close($this->plink);
    
        $url = "../view/mpList.php";
        redirect($url);
    }

    function deleteRolePagePerm($id, $all = false) {
        if (!is_null($id) || !empty($id)) {
            if ($all) {
                $query = "DELETE from role_perm  where id in (" . $id . ")";
            } else {
                $query = "DELETE from role_perm  where id=" . "'$id'";
            }

            mysqli_query($this->plink, $query);
        }
        // close connection
        //mysqli_close($this->plink);
        $url = "../view/mpList.php";
        redirect($url);
    }

    function editRolePagePerm($id) {

        $this->role_id = $_POST['role_id'];
        $this->page_id = $_POST['page_id'];
        $this->perm_id = implode(",", $_POST['permCheckboxes']);
//TODO
       // $modifieddate = date();
        //$modifiedby_id = $_SESSION["loggedin"];

        $query = "UPDATE role_perm SET role_id='$this->role_id',page_id='$this->page_id',perm_id='$this->perm_id' WHERE id=" . "'$id'";
        
        mysqli_query($this->plink, $query);
        // close connection
        // mysqli_close($this->plink);
        $url = "../view/mpList.php";

        redirect($url);
    }

    function rolePagePerm($row) {
        if (!empty($row)) {
            $role_perm = new role_perm();
            foreach ($row as $key => $value) {
                $role_perm->$key = $value;
            }
            return $role_perm;
        }
    }

    function getRolePagePerms() {

        //sql to return all page objects
        $sql = "SELECT * from role_perm";
        $role_perms = array();
        $result = mysqli_query($this->plink, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $role_perms[] = $this->rolePagePerm($row);
        }

        return $role_perms;
    }
      //returns the name of a role having the given ID
    public function getRole($id) {

        $sql = "select * from roles where roles.role_id='" . $id . "'";
        $role=  array();
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if ($count == 1) {
            $role = $row;
        }
        return $role;
    }
    public function getPage($id) {

        $sql = "select * from pages where pages.page_id='" . $id . "'";
        $page=  array();
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if ($count == 1) {
            $page = $row;
        }
        return $page;
    }


}

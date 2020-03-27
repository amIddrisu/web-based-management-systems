<?php

require '../include/header.php';

class page {

    public $page_id;
    public $page_desc;
    public $plink;

    public function __construct() {
        global $link;
        $this->plink = $link;
    }

    function getPage($id) {

        $sql = "SELECT * from pages where page_id=" . $id;
        $result = mysqli_query($this->plink, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $page = new page();
        if ($count == 1) {
            $page = $this->page($row);
        }
        return $page;
    }

    function addPage($page) {
        
        $submittedby_id = $_SESSION["loggedid"];

        $query = "INSERT INTO pages (page_desc,submittedby_id) "
                . "VALUES ('$page->page_desc','$submittedby_id');";

        mysqli_query($this->plink, $query);
        // close connection

      //  mysqli_close($this->plink);
   
        $url = "../view/pageList.php";
        
        redirect($url);
    }


    function deletePage($id,$all=false){
		
		if($all){
			$query="DELETE from pages  where page_id in (".$id.")";
		}else{
			$query="DELETE from pages  where page_id="."'$id'";	
		}
		
		mysqli_query($this->plink,$query);
		// close connection
		//mysqli_close($this->plink);
                $url = "../view/pageList.php";
                redirect($url);
	}

    function editPage($page) {

        //$this->perm_desc = $_POST['page_desc'];

       // $modifieddate = date("d-m-Y H:i:s");
        $modifiedby_id = $_SESSION["loggedid"];

        $query = "UPDATE pages SET name='$page->perm_desc',
   			modifiedby_id='$modifiedby_id' WHERE page_id=" . "'$page->page_id'";
        mysqli_query($this->plink, $query);
        // close connection
       // mysqli_close($this->plink);
        $url = "../view/pageList.php";

        redirect($url);
    }

    function page($row) {
        if (!empty($row)) {
            $page = new page();
            foreach ($row as $key => $value) {
                $page->$key = $value;
            }
            return $page;
        }
    }

    function getPages() {

        //sql to return all page objects
        $sql = "SELECT * from pages";
        $pages = array();
        $result = mysqli_query($this->plink, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $pages[] = $this->page($row);
        }

        return $pages;
    }
    function getPageName() {
       return $this->page_desc;
    }

}

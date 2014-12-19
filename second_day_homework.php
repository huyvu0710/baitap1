<?php
/**
 * Created by PhpStorm.
 * User: phucle1212
 * Date: 04/12/2014
 * Time: 15:58
 */
class main{
    protected   $servername = "localhost";
    protected   $username = "root";
    protected   $password = "";
    protected   $database_name ="rbk";

        public  function import(){
            if(file_exists("./products.csv")){
            //create connection to database
                $conn = new PDO("mysql:host=$this->servername;dbname=$this->database_name", $this->username, $this->password);
            // create sql query to read data from csv file and import to table product
                 $sql= "LOAD DATA INFILE '\\xampp\\htdocs\\rbk\\products.csv'";
                 $sql.= " INTO TABLE product ";
                 $sql.= "FIELDS TERMINATED BY ',' ";
                 $sql.= "ENCLOSED BY '"; $sql.= '"';  $sql.= "' ";
                 $sql.="LINES TERMINATED BY '\n' ";   $sql.="IGNORE 1 LINES";
                 $sql.=" (id,manufacturer_id, tax_category_id, shipping_category_id, name, slug, short_description, description, @available_on, @created_at, @updated_at, @deleted_at, variant_selection_method)";
                 $sql.=" SET available_on = STR_TO_DATE(@available_on, '%m/%d/%Y %H:%i'),";
                 $sql.=" created_at = STR_TO_DATE(@created_at, '%m/%d/%Y %H:%i'),";
                 $sql.="  updated_at = STR_TO_DATE(@updated_at, '%m/%d/%Y %H:%i'),";
                 $sql.="  deleted_at = STR_TO_DATE(@deleted_at, '%m/%d/%Y %H:%i')";
                try{
                    $conn->query($sql); // excute sql query
                    echo"import success";// return result
                    $conn = null;//close connection
                } catch (PDOException $e){
                    echo    $e->getMessage(); //return error if exist
                }
            }else{
                echo "Please copy csv file to the same directory with this html file";
            }
            }
        public function showsql(){
            $sql= "LOAD DATA INFILE '\\\\xampp\\\htdocs\\\\rbk\\\products.csv' </br>";
            $sql.= " INTO TABLE product  </br>";
            $sql.= "FIELDS TERMINATED BY ',' </br>";
            $sql.= "ENCLOSED BY '"; $sql.= '"';  $sql.= "' </br>";
            $sql.="LINES TERMINATED BY '\n' </br>";   $sql.="IGNORE 1 LINES </br>";
            $sql.=" (id,manufacturer_id, tax_category_id, shipping_category_id, name, slug, short_description, description, @available_on, @created_at, @updated_at, @deleted_at, variant_selection_method) </br>";
            $sql.=" SET </br> available_on = STR_TO_DATE(@available_on, '%m/%d/%Y %H:%i'), </br>";
            $sql.=" created_at = STR_TO_DATE(@created_at, '%m/%d/%Y %H:%i'), </br>";
            $sql.="  updated_at = STR_TO_DATE(@updated_at, '%m/%d/%Y %H:%i'), </br>";
            $sql.="  deleted_at = STR_TO_DATE(@deleted_at, '%m/%d/%Y %H:%i') </br>";
            echo $sql;
        }
}
$main = new main();
if (isset($_POST['action'])) {
        switch ($_POST['action']){
            case "import":
                $main->import();
                break;
            case "showsql":
                $main->showsql();
                break;
        }
}







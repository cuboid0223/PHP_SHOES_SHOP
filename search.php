<?php
require_once "conn_db.php";
session_start();
$sql = "
        SELECT SH_name, SH_price, SH_imgURL, BRN_name, us, CAT_name, CUS_type
        FROM SHOES AS a
        LEFT JOIN SHOES_BRANDS AS b ON a.BRN_id=b.BRN_id   
        LEFT JOIN SHOES_SIZE AS c ON a.SIZ_id=c.SIZ_id   
        LEFT JOIN CATEGORIES AS d ON a.CAT_id=d.CAT_id   
        LEFT JOIN CUSTOMERS AS e ON a.CUS_id=e.CUS_id 
        ";


// 搜尋欄 finished
if(isset($_POST['search__submit'])){
    $male = $_POST['male'];
    $female = $_POST['female'];
    $child = $_POST['child'];

    if(!empty($_POST['q'])){// 如果搜尋欄有輸入字
        $q = $_POST['q'];
        $sql .= 
        " 
        WHERE 
            SH_name LIKE '%$q%' or
            BRN_name LIKE '%$q%' or
            CAT_name LIKE '%$q%' or
            CUS_type LIKE '%$q%'   
        " ;
        $_SESSION['Query'] = $q; //將該字放入 session
    } 




    $statement = $connection -> prepare($sql);
    $statement -> execute();
    $items = $statement -> fetchAll(PDO::FETCH_OBJ);
    $_SESSION['Items'] = $items;
    
    header("Location: searchPage.php");
   
};


// Price
if(isset($_POST['minPrice']) or isset($_POST['maxPrice'])){
    $min = $_POST['minPrice'];
    $max = $_POST['maxPrice'];

}



if(isset($_POST['search__submit__sql'])){// sql語法欄
    $q_sql = $_POST['q-sql'];
    //echo $q_sql;
    try{
        $statement = $connection -> prepare($q_sql) or die("Unable to connect to site");
        $statement -> execute();
        $items = $statement -> fetchAll(PDO::FETCH_OBJ);
        //print_r($items);
       
        $_SESSION['Items'] = $items;
         header("Location: searchPage.php");
    }catch(PDOException $e){
        echo $e;// show the error 
    }
};


?>
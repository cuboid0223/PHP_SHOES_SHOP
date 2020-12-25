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
   
    $q_sql = '1 = 1';// 恆為正
    $brand_sql = '1 = 1';
    $type_sql = '1 = 1';
    $gender_sql = '1 = 1';
    $max_sql = '1 = 1';
    $min_sql = '1 = 1';
    $order_sql = '';
    
    if(!empty($_POST['q'])){// 如果搜尋欄有輸入字
        $q = $_POST['q'];
        setcookie("query", $q, time()+1);
        $q_sql = "  SH_name LIKE '%$q%' or
                    BRN_name LIKE '$q%' or
                    CUS_type LIKE '$q%'
        ";
    }
    if(!empty($_POST['brand'])){
        $brand = $_POST['brand'];
        setcookie("brand", $brand, time()+1);
        $brand_sql = " BRN_name LIKE '%$brand%' ";
    }
    if(!empty($_POST['type'])){
        $type = $_POST['type'];
        setcookie("type", $type, time()+1);
        $type_sql = " CAT_name = '$type' ";
    }
    if(!empty($_POST['gender'])){
        $gender = $_POST['gender']; // 男 女 童 
        setcookie("gender", $gender, time()+1);
        $gender_sql = " CUS_type = '$gender' ";
        
    }
    
    if(!empty($_POST['minPrice'])){
        $min = $_POST['minPrice'];
        setcookie("min", $min, time()+1);

        $min_sql = " SH_price > $min ";
    }
    if(!empty($_POST['maxPrice'])){
        $max = $_POST['maxPrice'];
        setcookie("max", $max, time()+1);
        $max_sql = " SH_price < $max ";
    }
  

    if(!empty($_POST['price__Order'])){
        $order = $_POST['price__Order'];
        setcookie("order", $order, time()+1);
        $order_sql = " ORDER BY SH_price {$order};";
    }
    
    $sql .= "WHERE {$q_sql} 
    AND {$brand_sql} 
    AND {$type_sql} 
    AND {$gender_sql} 
    AND {$min_sql} 
    AND {$max_sql} {$order_sql}
    LIMIT 8
    ";
    echo $sql;


    $statement = $connection -> prepare($sql);
    $statement -> execute();
    $items = $statement -> fetchAll(PDO::FETCH_OBJ);
    $_SESSION['SQL'] = $sql;
    $_SESSION['Items'] = $items;
    
   header("Location: searchPage.php");
   
};





if(isset($_POST['search__submit__sql'])){// sql語法欄 finished
    $q_sql = $_POST['q-sql'];
    //echo $q_sql;
    try{
        $statement = $connection -> prepare($q_sql);
        $statement -> execute();
        $items = $statement -> fetchAll(PDO::FETCH_OBJ);
        //print_r($items);
        //$_SESSION['SQL'] = $q_sql;
        $_SESSION['Items'] = $items;
        header("Location: searchPage.php");
    }catch(PDOException $e){
        echo $e;// show the error 
    }
};


?>
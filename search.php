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
   
    $q_sql = '1 = 1';
    $brand_sql = '1 = 1';
    $type_sql = '1 = 1';
    $gender_sql = '1 = 1';
    $max_sql = '1 = 1';
    $min_sql = '1 = 1';
    
    if(!empty($_POST['q'])){// 如果搜尋欄有輸入字
        $q = $_POST['q'];
        $q_sql = " SH_name LIKE '%$q%'";
    }
    if(!empty($_POST['brand'])){
        $brand = $_POST['brand'];
        $brand_sql = " BRN_name = '$brand' ";
    }
    if(!empty($_POST['type'])){
        $type = $_POST['type'];
        $type_sql = " CAT_name = '$type' ";
    }
    if(!empty($_POST['gender'])){
        $gender = $_POST['gender']; // 男 女 童 
        $gender_sql = " CUS_type = '$gender' ";
        
    }
    if( intval($_POST['minPrice']) < intval( $_POST['maxPrice'])){
        if(!empty($_POST['minPrice'])){
            $min = $_POST['minPrice'];
            $min_sql = " SH_price > $min ";
        }
        if(!empty($_POST['maxPrice'])){
            $max = $_POST['maxPrice'];
            $max_sql = " SH_price < $max ";
        }
    }else{
        $_SESSION['alert'] =  '最大值 一定大於 最小值';
        // echo '最大值 一定大於 最小值';
        // echo ''
    }
    
    
    
    $sql .= "WHERE {$q_sql} AND {$brand_sql} AND {$type_sql} AND {$gender_sql} AND {$min_sql} AND {$max_sql}";
    echo $sql;


    $statement = $connection -> prepare($sql);
    $statement -> execute();
    $items = $statement -> fetchAll(PDO::FETCH_OBJ);
    $_SESSION['Items'] = $items;
    
    // header("Location: searchPage.php");
   
};



if(isset($_POST['search__submit__sql'])){// sql語法欄 finished
    $q_sql = $_POST['q-sql'];
    //echo $q_sql;
    try{
        $statement = $connection -> prepare($q_sql);
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
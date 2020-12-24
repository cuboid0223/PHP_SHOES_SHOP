<?php
include_once 'conn_db.php';
$sql = "select * from CATEGORIES";// 分類
$stmt = $connection -> prepare($sql);
$stmt -> execute();
$types = $stmt -> fetchAll(PDO::FETCH_OBJ);
//print_r($items);


$sql2 = "select * from SHOES_BRANDS";// 品牌
$stmt2 = $connection -> prepare($sql2);
$stmt2 -> execute();
$brands = $stmt2 -> fetchAll(PDO::FETCH_OBJ);

?>
<div class="sidebar">
    <!-- 搜尋欄 -->
    <form class="sidebar__form"  action='search.php' method='POST'>
        <div class="sidebar__searchWrap">
            <input type="text" class="search__input" placeholder="查詢" name="q">
            <button type="submit" class="search__btn" name='search__submit'>
                    <i class="fas fa-search"></i>
            </button>
        </div>
        
        <div class="sidebar__filterWrap">
            <!-- 選擇性別 -->
            <div class='maleOrFemale__wrap'>
                <input type="checkbox" id="male" name="male" value="male">
                <label for="male">男鞋</label><br>
                <input type="checkbox" id="female" name="female" value="female">
                <label for="female">女鞋</label><br>
                <input type="checkbox" id="child" name="child" value="child">
                <label for="child">童鞋</label><br>
            </div>
            
            <!-- 鞋種分類 -->
            <h3>鞋種分類</h3>
            <select id="type" >
                <option>選擇鞋種</option>
                <?php foreach( $types as $type): ?>
                    <option><?= $type -> CAT_name  ?></option>
                <?php endforeach; ?>
            </select>
            <hr>

            <!--品牌  -->
            <h3>品牌分類</h3>
            <select id="brand" >
                <option>選擇品牌</option>
                <?php foreach( $brands as $brand): ?>
                    <option><?= $brand -> BRN_name  ?></option>
                <?php endforeach; ?>
            </select>
            <hr>

            <!-- 價格 -->
            <h3>價格範圍</h3>
            <div class="price__form__wrap">
                <input type="text" placeholder='最低' class="price__form__min" name="minPrice">
                <pre>～</pre> 
                <input type="text" placeholder='最高' class="price__form__max" name="maxPrice">
            </div>
            <hr> 
        </div>
    </form>
    

   

    <!-- SQL搜尋  -->
    <from class="sidebar__form__sql" method="POST" action="search.php">
        <textarea type="text" class="search__textarea" placeholder="查詢 SQL" name='q-sql'></textarea>
        <div class="search__form__sql__wrap">
            <button type="submit" class="search__btn" name='search__submit__sql'>
                GO
            </button>
        </div>  
    </from>
</div>
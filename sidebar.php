<?php
include_once 'conn_db.php';
session_start();
$sql = "select * from CATEGORIES";// 分類
$stmt = $connection -> prepare($sql);
$stmt -> execute();
$types = $stmt -> fetchAll(PDO::FETCH_OBJ);
//print_r($items);


$sql2 = "select * from SHOES_BRANDS";// 品牌
$stmt2 = $connection -> prepare($sql2);
$stmt2 -> execute();
$brands = $stmt2 -> fetchAll(PDO::FETCH_OBJ);

//print_r($_SESSION['Items'] );
?>
<div class="sidebar">
    <!-- 搜尋欄 -->
    <form class="sidebar__form"  action='search.php' method='POST'>
        <div class="sidebar__searchWrap">
            <input 
            type="text" 
            class="search__input" 
            placeholder="<?php 
            if(!empty($_COOKIE["query"])){echo $_COOKIE["query"];}else{echo "查詢"; }; 
            ?>" 
            name="q" >
            <button type="submit" class="search__btn" name='search__submit'>
                    <i class="fas fa-search"></i>
            </button>
        </div>
        
        <div class="sidebar__filterWrap">
            <!-- 選擇性別 -->
            <div class='maleOrFemale__wrap' id="maleOrFemale__wrap">
                <input type="checkbox" id="male" name="gender" value="男鞋" >
                <label for="male">男鞋</label><br>
                <input type="checkbox" id="female" name="gender" value="女鞋" >
                <label for="female">女鞋</label><br>
                <input type="checkbox" id="child" name="gender" value="童鞋" >
                <label for="child">童鞋</label><br>
            </div>
            
            <!-- 鞋種分類 -->
            <h3>鞋種分類</h3>
            <select id="type" name='type'>
                <option><?= $_COOKIE["type"]; ?></option>
                <option></option>
                <?php foreach( $types as $type): ?>
                    <option ><?= $type -> CAT_name  ?></option>
                <?php endforeach; ?>
            </select>
            <hr>

            <!--品牌  -->
            <h3>品牌分類</h3>
            <select id="brand" name='brand'>
                <option><?= $_COOKIE["brand"]; ?></option>
                <option></option>
                <?php foreach( $brands as $brand): ?>
                    <option ><?= $brand -> BRN_name  ?></option>
                <?php endforeach; ?>
            </select>
            <hr>

            <!-- 價格 -->
            <h3>價格範圍</h3>
            <div class="price__form__wrap">
                <input type="text" placeholder='最低' class="price__form__min" name="minPrice" value='<?= $_COOKIE['min'];?>'>
                <pre>～</pre> 
                <input type="text" placeholder='最高' class="price__form__max" name="maxPrice" value='<?= $_COOKIE['max'];?>'>
            </div>


            <input type="checkbox" class="angle__btn " name=' price__Order' value='Desc'>
                <i class="fas fa-angle-double-up <?php if($_COOKIE['order'] == 'Desc') echo 'fas__green';?>"></i>
            </input>

            <input type="checkbox" class="angle__btn " name='price__Order' value='Asc'>
                <i class="fas fa-angle-double-down <?php if($_COOKIE['order'] == 'Asc') echo ' fas__green';?>"></i>
            </input>
            <hr> 
        </div>
    </form>
    

   

    <!-- SQL搜尋  -->
    <form class="sidebar__form__sql" method="POST" action="search.php">
        <textarea type="text" class="search__textarea" placeholder="" name='q-sql'></textarea>
        <div class="search__form__sql__wrap">
            <button type="submit" class="search__btn" name='search__submit__sql'>
                GO
            </button>
        </div>  
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script>
    $('#maleOrFemale__wrap input').click(function(){
    //console.log('click')
        if($(this).prop('checked')){
        $('#maleOrFemale__wrap input:checkbox').prop('checked',false);
        $(this).prop('checked',true);
        }
    });
</script>
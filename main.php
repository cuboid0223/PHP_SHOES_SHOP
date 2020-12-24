
    <?php include_once 'conn_db.php';
        //$sql = "select * from SHOES";
        $sql = "
        SELECT SH_name, SH_price, SH_imgURL, BRN_name, us, CAT_name, CUS_type
        FROM SHOES AS a
        LEFT JOIN SHOES_BRANDS AS b ON a.BRN_id=b.BRN_id   
        LEFT JOIN SHOES_SIZE AS c ON a.SIZ_id=c.SIZ_id   
        LEFT JOIN CATEGORIES AS d ON a.CAT_id=d.CAT_id   
        LEFT JOIN CUSTOMERS AS e ON a.CUS_id=e.CUS_id 
        ";
        $statement = $connection -> prepare($sql);// ???
        $statement -> execute();// ???
        $items = $statement -> fetchAll(PDO::FETCH_OBJ);// ???
        //print_r($items);

    ?>
    <div class="main">
        <div class="main__wrap">
            <?php forEach($items as $item): ?>
                <div class="card" >
                    <img src="<?= $item -> SH_imgURL; ?>" alt="..." />
                    <div class="card__wrap">
                        <h3><?= $item -> SH_name; ?></h3>
                        <div class="card__info">
                            <p>$<?= $item -> SH_price; ?></p>
                            <input type="submit" value="MORE">
                        </div>
                        <pre><?= $item -> BRN_name; ?></pre>
                        <pre>US <?= $item -> us; ?></pre>
                        <pre><?= $item -> CAT_name; ?></pre>
                        <pre><?= $item -> CUS_type; ?></pre>
                    </div> 
                </div>
            <?php endforeach; ?>

        </div>
    </div>

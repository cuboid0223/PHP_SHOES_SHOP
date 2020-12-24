<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./scss/all.css">
</head>
<body>
    <div class='container'>
        <?php 
            require 'sidebar.php';
            require 'search.php';
        ?>
        <div class="main">
            <div class="main__wrap">
                <?php forEach( $_SESSION['Items'] as $item): ?>
                    <div class="card" >
                        <img src="<?= $item -> SH_imgURL; ?>" alt="..." />
                        <div class="card__wrap">
                            <h3><?= $item -> SH_name; ?></h3>
                            <div class="card__info">
                                <p>$<?= $item -> SH_price; ?></p>
                                <input type="submit" value="MORE">
                            </div>
                        </div> 
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
</body>
</html>
 <script src="https://kit.fontawesome.com/226a6eca39.js" crossorigin="anonymous"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>db-final</title>
    <link rel="stylesheet" href="./scss/all.css">
</head>
<body>
    <?php include_once "conn_db.php"; ?>
    <div class="container">
        <?php include './sidebar.php'; ?>
        <?php include './main.php'; ?>
    </div>

    
</body>
</html>
<script src="https://kit.fontawesome.com/226a6eca39.js" crossorigin="anonymous"></script>
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
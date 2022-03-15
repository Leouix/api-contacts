<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>API contacts</title>
</head>
<body>

<?php

$phone_rand1 = '+7' . rand(1000000000, 9999999999);
$phone_rand2 = '+7' . rand(1000000000, 9999999999);
$phone_rand3 = '+7' . rand(1000000000, 9999999999);
$phone_rand4 = '+7' . rand(1000000000, 9999999999);
$phone_rand5 = '+7' . rand(1000000000, 9999999999);

$j = '{
"source_id": 2,
"items": [
{"name": "Анна","phone": "' . $phone_rand1 . '","email": "mail1@gmail.com"},
{"name": "Иван","phone": "' . $phone_rand2 . '","email": "mail2@gmail.com"},
{"name": "Артем","phone": "' . $phone_rand3 . '","email": "mail2@gmail.comd"},
{"name": "Олег","phone": "' . $phone_rand4 . '","email": "mail2@gmail.comd"},
{"name": "Татьяна","phone": "' . $phone_rand5 . '","email": "mail2@gmail.comd"}
]
}';

?>

<div class="main-block">

    <form action="" method="post" class="mb-3">
        <textarea type="hidden" name="array" rows="12" cols="90"><?= $j ?></textarea>
        <input class="btn btn-primary" type="submit">
    </form>

    <?php

    if( isset( $result['success']) ) {
        echo '<p>Успешно добавлено строк: ' . $result['success'] . '</p>';
    } else if ( isset($result['error']) ) {
        echo '<p>' . $result['error'] . '</p>';
    }

    if ( isset($result['get-rows']) ) {

        echo "<pre>";
        print_r( $result['get-rows'] );
        echo "</pre>";

    }

    ?>

</div>

<style>
    textarea {
        resize: both;
    }
    .btn-primary {
        display: block;
    }
    .main-block {
        padding: 35px;
    }
</style>

</body>
</html>


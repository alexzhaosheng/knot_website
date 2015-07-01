<?php

require_once "comm.php";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Knot.js</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Javascript bind framework knot.js help you." />
    <meta name="keywords" content="javascript, mvvm, framework, data binding, angular.js, knotout.js, ember.js" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:site_name" content="knot.js" />
    <meta property="og:title" content="knot.js" />
    <meta property="og:type" content="website" />


    <link rel="stylesheet" href="css/site.css">

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
<?php
    $smarty = \Common::getSmarty();
    $smarty->assign("page", "home");
    $smarty->display("header.tpl");
?>

<section class="content-column content">

</section>


<?php
$smarty = \Common::getSmarty();
$smarty->display("footer.tpl");
?>
</body>
</html>
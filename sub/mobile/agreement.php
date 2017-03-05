<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
    <title></title>
    <link type="text/css" rel="stylesheet" href="../css/publick.css" />
</head>
<body style="background-color:#fff;">
    <div class="agreement_box">
    <?php 
    $o_system=new System(1);
    echo($o_system->getTerms());
    ?>
    </div>
</body>
</html>
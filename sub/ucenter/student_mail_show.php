<?php
require_once 'include/it_head.inc.php';
require_once 'include/it_include.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
</head>
<body style="margin:0px;">
<?php 
require_once RELATIVITY_PATH . 'include/db_table.class.php';
$o_mailrecord=new MailRecord($_GET ['id']);
echo($o_mailrecord->getContent())?>
</body>
</html>

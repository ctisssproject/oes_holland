<?php
require_once 'include/it_head.inc.php';

require_once RELATIVITY_PATH . 'include/db_table.class.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="../../css/common.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/list.css" />
<link rel="stylesheet" type="text/css" href="../ucenter/css/nav.css" />
<script type="text/javascript" src="../../js/jquery.min.js"></script>
<script type="text/javascript" src="../../js/ajax.class.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>
</head>
<body style="background-image: none">
<?php 

$o_term=new Travel_Title();
if ($_GET['typeid']>0)
{
	$o_term->PushWhere ( array ('&&', 'TypeId', '=', $_GET['typeid'] ) );
}
$o_term->PushWhere ( array ('&&', 'State', '=', 1) );
$o_term->PushOrder ( array ('TypeId', 'A' ) );
$o_term->PushOrder ( array ('Date', 'D' ) );
$n_count=$o_term->getAllCount();
for($i=0;$i<$n_count;$i++)
	echo('
	<table border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td class="nav1" style="padding-left:15px;padding-right:5px" onclick="nav1GoTo(\'travel_item.php?titleid='.$o_term->getTitleId($i).'\',this,\'#nav_2_'.$o_term->getTitleId($i).'\','.$o_term->getTitleId($i).')">
                '.$o_term->getName($i).'
            </td>
        </tr>
    </table>
    <div id="nav_2_'.$o_term->getTitleId($i).'" class="nav2_border"></div>
	');
?>
</body>
</html>

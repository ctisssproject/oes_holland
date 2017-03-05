<?php
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
define ( 'RELATIVITY_PATH', '../../../' ); //定义相对路径
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
$S_Function = $_GET ['function'];
switch ($S_Function) {
	case 'CityModify' :
		CityModify ();
		break;
	case 'CityAdd' :
		CityAdd ();
		break;
	case 'HotelAdd' :
		HotelAdd ();
		break;
	case 'HotelModify' :
		HotelModify ();
		break;
	case 'RegionAdd' :
		RegionAdd();
		break;
	case 'RegionPhotoAdd' :
		RegionPhotoAdd();
		break;
	case 'RegionModify' :
		RegionModify();
		break;
	case 'RegionTypeAdd' :
		RegionTypeAdd();
		break;
	case 'TravelTitleAdd' :
		TravelTitleAdd();
		break;
	case 'TravelTitleModify' :
		TravelTitleModify();
		break;
	case 'TravelItemAdd' :
		TravelItemAdd();
		break;
	case 'TravelItemModify' :
		TravelItemModify();
		break;
	case 'TravelDetailAdd' :
		TravelDetailAdd();
		break;
	case 'TravelDetailModify' :
		TravelDetailModify();
		break;
	case 'TravelTypeAdd' :
		TravelTypeAdd();
		break;
	case 'TravelTypeModify' :
		TravelTypeModify();
		break;
	case 'AdvertModify' :
		AdvertModify ();
		break;
	case 'AdvertAdd' :
		AdvertAdd ();
		break;
	default :
		break;
}
exit ();
function CityAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->CityAdd ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.location.reload()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	}
}
function CityModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->CityModify ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.goBack()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	}
}
function HotelAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->HotelAdd ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.location.reload()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	}
}
function HotelModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->HotelModify ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.goBack()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function RegionAdd() {

	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->RegionAdd ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>	
				parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.location.reload()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	}
}
function RegionPhotoAdd() {

	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->RegionPhotoAdd ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>	
				parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.goBack()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	}
}
function RegionModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->RegionModify ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.goBack()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function RegionTypeAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->RegionTypeAdd ( $O_Session->getType () );
		echo ('<script>
     			parent.parent.location.reload();
      		</script>');
	
}
function TravelTitleAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->TravelTitleAdd ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.history.go(-1);parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.location.reload()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function TravelTitleModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->TravelTitleModify ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.history.go(-1);parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.location.reload()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function TravelItemAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->TravelItemAdd ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.location=\'travel_item.php?titleid=' . $_POST ['Vcl_TitleId'] . '\';parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.navRefreshOpenNav()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function TravelItemModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->TravelItemModify ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.location=\'travel_item.php?titleid=' . $_POST ['Vcl_TitleId'] . '\';parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.navRefreshOpenNav()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function TravelDetailAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->TravelDetailAdd ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.location=\'travel_detail.php?itemid=' . $_POST ['Vcl_ItemId'] . '\';parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.navRefreshOpenNav()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function TravelDetailModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->TravelDetailModify ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.goBack();parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.navRefreshOpenNav()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function TravelTypeAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->TravelTypeAdd ( $O_Session->getType () );
	if ($b_result) {
		if ($_POST['Vcl_From']==1)
		{
			echo ('<script>
	     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.location=\''.$_POST['Vcl_Url'].'travel_title_add.php\'});
	      		</script>');
		}else{
			echo ('<script>
	     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.location.reload()});
	      		</script>');
		}
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	}
}
function TravelTypeModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->TravelTypeModify ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.goBack()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	}
}
function AdvertAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->AdvertAdd ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.goBack()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function AdvertModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->AdvertModify ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.goBack()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}































?>
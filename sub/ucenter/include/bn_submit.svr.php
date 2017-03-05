<?php
header ( 'Cache-Control: no-cache' );
header ( 'Pragma: no-cache' );
header ( 'Expires: Thu, 01 Jan 1970 00:00:00 GMT' );
header ( 'Last-Modified:' . gmdate ( 'D, d M Y H:i:s' ) . ' GMT' );
header ( 'content-type:text/html; charset=utf-8' );
define ( 'RELATIVITY_PATH', '../../../' );   //全局
require_once RELATIVITY_PATH . 'include/bn_session.class.php';
$O_Session = new Session ();
$S_Function = $_GET ['function'];
switch ($S_Function) {
	case 'AdminModify' :
		AdminModify ();
		break;
	case 'AdminResetPassword' :
		AdminResetPassword ();
		break;
	case 'AdminAdd' :
		AdminAdd ();
		break;
	case 'StudentSendMail' :
		StudentSendMail ();
		break;
	case 'SystemNewsAdd' :
		SystemNewsAdd ();
		break;
	case 'SystemNewsModify' :
		SystemNewsModify ();
		break;
	case 'SystemAdvertModify' :
		SystemAdvertModify ();
		break;
	case 'SystemAdvertAdd' :
		SystemAdvertAdd ();
		break;
	case 'SystemPartnersModify' :
		SystemPartnersModify ();
		break;
	case 'SystemPartnersAdd' :
		SystemPartnersAdd ();
		break;
	case 'SystemTermsModify' :
		SystemTermsModify ();
		break;
	case 'SystemContactModify' :
		SystemContactModify ();
		break;
	case 'SystemFocusModify' :
		SystemFocusModify ();
		break;
	case 'SystemFocusAdd' :
		SystemFocusAdd ();
		break;
	case 'SystemImageModifyLogo' :
		SystemImageModifyLogo ();
		break;
	case 'SystemImageModifyRegPhoto' :
		SystemImageModifyRegPhoto ();
		break;
	case 'SystemSetupModify' :
		SystemSetupModify ();
		break;
	case 'SystemVantageModify' :
		SystemVantageModify ();
		break;
	case 'SystemVantageAdd' :
		SystemVantageAdd ();
		break;
	case 'CourseTermAdd' :
		CourseTermAdd ();
		break;
	case 'CourseTermModify' :
		CourseTermModify ();
		break;
	case 'CourseChapterAdd' :
		CourseChapterAdd ();
		break;
	case 'CourseChapterInput' :
		CourseChapterInput ();
		break;
	case 'CourseChapterModify' :
		CourseChapterModify ();
		break;
	case 'CourseChapterMove' :
		CourseChapterMove ();
		break;
	case 'CourseChapterCopy' :
		CourseChapterCopy ();
		break;
	case 'CourseSectionAdd' :
		CourseSectionAdd ();
		break;
	case 'CourseSectionModify' :
		CourseSectionModify ();
		break;
	case 'CourseSectionMove' :
		CourseSectionMove ();
		break;
	case 'CourseSectionCopy' :
		CourseSectionCopy ();
		break;
	case 'CourseSubjectAdd' :
		CourseSubjectAdd ();
		break;
	case 'CourseSubjectModify' :
		CourseSubjectModify ();
		break;
	case 'CourseSubjectMove' :
		CourseSubjectMove ();
		break;
	case 'CourseSubjectCopy' :
		CourseSubjectCopy ();
		break;
	case 'CourseSubjectCopy' :
		CourseSubjectCopy ();
		break;
	case 'GoodsInformationUseCheck' :
		GoodsInformationUseCheck ();
		break;
	case 'GoodsInformationUseSend' :
		GoodsInformationUseSend ();
		break;
	case 'GoodsCredentialSend' :
		GoodsCredentialSend ();
		break;
	case 'GoodsPrizeExchangeSend' :
		GoodsPrizeExchangeSend ();
		break;
	case 'GoodsSendStart' :
		GoodsSendStart ();
		break;
	case 'GoodsPrizeAdd' :
		GoodsPrizeAdd ();
		break;
	case 'GoodsPrizeModify' :
		GoodsPrizeModify ();
		break;
	case 'GoodsInformationAdd' :
		GoodsInformationAdd ();
		break;
	case 'GoodsInformationModify' :
		GoodsInformationModify ();
		break;
	default :
		break;
}
exit ();
function AdminAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->AdminAdd ( $O_Session->getType () );
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
function AdminModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->AdminModify ( $O_Session->getType () );
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
function SystemNewsAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemNewsAdd ( $O_Session->getType () );
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
function SystemNewsModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemNewsModify ( $O_Session->getType () );
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
function AdminResetPassword() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->AdminResetPassword ( $O_Session->getType () );
	echo ('<script>     			
     			parent.parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '");
     			parent.parent.Common_CloseDialog();
      		</script>');
}
function StudentSendMail() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->StudentSendMail ( $O_Session->getType (),$O_Session->getName () );
	echo ('<script>     			
     			parent.parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.goBack()});
      		</script>');
}
function SystemAdvertAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemAdvertAdd ( $O_Session->getType () );
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
function SystemAdvertModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemAdvertModify ( $O_Session->getType () );
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
function SystemPartnersAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemPartnersAdd ( $O_Session->getType () );
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
function SystemPartnersModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemPartnersModify ( $O_Session->getType () );
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
function SystemTermsModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemTermsModify ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '");
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function SystemContactModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemContactModify ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '");
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function SystemFocusAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemFocusAdd ( $O_Session->getType () );
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
function SystemFocusModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemFocusModify ( $O_Session->getType () );
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
function SystemVantageAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemVantageAdd ( $O_Session->getType () );
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
function SystemVantageModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemVantageModify ( $O_Session->getType () );
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
function SystemImageModifyLogo() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemImageModifyLogo ( $O_Session->getType () );
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
function SystemImageModifyRegPhoto() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemImageModifyRegPhoto ( $O_Session->getType () );
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
function SystemSetupModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->SystemSetupModify ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '");
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function CourseTermAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->CourseTermAdd ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.goBack();parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.location.reload()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function CourseTermModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->CourseTermModify ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.goBack();parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.location.reload()});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function CourseChapterAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->CourseChapterAdd ( $O_Session->getType () );
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
function CourseChapterInput() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->CourseChapterInput ( $O_Session->getType () );
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
function CourseChapterModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->CourseChapterModify ( $O_Session->getType () );
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
function CourseChapterMove() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->CourseChapterMove ( $O_Session->getType () );
	echo ('<script>     			 			
     			parent.parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.navRefreshOpenNav(' . $_POST ['Vcl_TermId'] . ',0);
     			parent.parent.location.reload();
      		</script>');
}
function CourseChapterCopy() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->CourseChapterCopy ( $O_Session->getType (), $_POST ['Vcl_ChapterId'], $_POST ['Vcl_TermId'] );
	echo ('<script>     	
				parent.parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.navRefreshOpenNav(' . $_POST ['Vcl_TermId'] . ',0);
     			parent.parent.location.reload();
      		</script>');
}
function CourseSectionAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->CourseSectionAdd ( $O_Session->getType () );
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
function CourseSectionModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->CourseSectionModify ( $O_Session->getType () );
	if ($b_result) {
		if ($_POST ['Vcl_Search'] == 'true') {
			echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.parent.parent.window.close()});
      		</script>');
		} else {
			echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.goBack();parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.navRefreshOpenNav()});
      		</script>');
		}
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function CourseSectionMove() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->CourseSectionMove ( $O_Session->getType () );
	if ($_POST ['Vcl_Search'] == 'true') {
		echo ('<script> 
				parent.parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.navRefreshOpenNav(0,' . $_POST ['Vcl_ChapterId'] . ');
				parent.parent.parent.parent.Common_CloseDialog(); 
				parent.parent.Common_CloseDialog(); 
				
      		</script>');
	} else {
		echo ('<script>     			  			
     			parent.parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.navRefreshOpenNav(0,' . $_POST ['Vcl_ChapterId'] . ');
     			parent.parent.location.reload();
      		</script>');
	}
}
function CourseSectionCopy() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->CourseSectionCopy ( $O_Session->getType (), $_POST ['Vcl_SectionId'], $_POST ['Vcl_ChapterId'] );
	if ($_POST ['Vcl_Search'] == 'true') {
		echo ('<script> 
				parent.parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.navRefreshOpenNav(0,' . $_POST ['Vcl_ChapterId'] . ');
				parent.parent.parent.parent.Common_CloseDialog(); 
				parent.parent.Common_CloseDialog(); 
				
      		</script>');
	} else {
		echo ('<script>     			  			
     			parent.parent.parent.document.getElementsByTagName(\'frame\')[0].contentWindow.navRefreshOpenNav(0,' . $_POST ['Vcl_ChapterId'] . ');
     			parent.parent.location.reload();
      		</script>');
	}
	

}
function CourseSubjectAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->CourseSubjectAdd ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.history.go(-1)});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	}
}
function CourseSubjectModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->CourseSubjectModify ( $O_Session->getType () );
	if ($b_result) {
		if ($_POST ['Vcl_Search'] == 'true') {
			echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.parent.parent.window.close()});
      		</script>');
		} else {
			echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.goBack()});
      		</script>');
		}
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	
	}
}
function CourseSubjectMove() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->CourseSubjectMove ( $O_Session->getType () );
	if ($_POST ['Vcl_Search'] == 'true') {
		echo ('<script> 
				parent.parent.parent.parent.Common_CloseDialog(); 
				parent.parent.Common_CloseDialog(); 
				
      		</script>');
	} else {
		echo ('<script>     			  			
     			parent.parent.location.reload();
      		</script>');
	}
}
function CourseSubjectCopy() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$o_operate->CourseSubjectCopy ( $O_Session->getType (), $_POST ['Vcl_SubjectId'], $_POST ['Vcl_SectionId'] );
	if ($_POST ['Vcl_Search'] == 'true') {
		echo ('<script> 
				parent.parent.parent.parent.Common_CloseDialog(); 
				parent.parent.Common_CloseDialog(); 
				
      		</script>');
	} else {
		echo ('<script>     			  			
     			parent.parent.location.reload();
      		</script>');
	}
}
function GoodsCredentialSend() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->GoodsCredentialSend ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.openPrintSingle('.$_POST ['Vcl_Id'].')});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	}
}
function GoodsInformationUseCheck() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->GoodsInformationUseCheck ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.history.go(-1)});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	}
}
function GoodsInformationUseSend() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->GoodsInformationUseSend ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.openPrintSingle('.$_POST ['Vcl_UseId'].')});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	}
}
function GoodsPrizeExchangeSend() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->GoodsPrizeExchangeSend ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.openPrintSingle('.$_POST ['Vcl_ExchangeId'].')});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Error("' . $o_operate->getErrorReasion () . '");
      		</script>');
	}
}
function GoodsSendStart() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->GoodsSendStart ( $O_Session->getType () );
	if ($b_result) {
		echo ('<script>
     			parent.parent.parent.Dialog_Success("' . $o_operate->getErrorReasion () . '",function(){parent.openPrint('.$o_operate->getSendId().');});
      		</script>');
	} else {
		echo ('<script>
     			parent.parent.parent.Dialog_Message("' . $o_operate->getErrorReasion () . '");
      		</script>');
	}
}
function GoodsPrizeAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->GoodsPrizeAdd ( $O_Session->getType () );
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
function GoodsPrizeModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->GoodsPrizeModify ( $O_Session->getType () );
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
function GoodsInformationAdd() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->GoodsInformationAdd ( $O_Session->getType () );
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
function GoodsInformationModify() {
	global $O_Session;
	require_once 'bn_operate.class.php';
	$o_operate = new Operate ();
	$b_result = $o_operate->GoodsInformationModify ( $O_Session->getType () );
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
<?php
require_once 'include/it_head.inc.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once 'include/it_include.inc.php';
if (is_numeric ( $_GET ["sectionid"] )) {
	$o_section = new Bank_Section ( $_GET ["sectionid"] );
	//验证这个节是否为本学期
	$o_chapter = new Bank_Chapter ( $o_section->getChapterId () );
	$o_term = new Bank_Term ( $o_chapter->getTermId () );
	if ($o_term->getState () != 1) {
		exit ( 0 );
	}
	//验证这个节是否做过
	$o_chapter = new User_Study_Chapter ();
	$o_chapter->PushWhere ( array ('&&', 'ChapterId', '=', $o_section->getChapterId () ) );
	$o_chapter->PushWhere ( array ('&&', 'Uid', '=', $O_Session->getUid () ) );
	$o_chapter->PushWhere ( array ('&&', 'Finish', 'LIKE', '%<1>' . $o_section->getSectionId () . '<1>%' ) );
	if ($o_chapter->getAllCount () > 0) {
		exit ( 0 );
	}
} else {
	exit ( 0 );
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>荷兰旅游专家-个人中心</title>
<link rel="stylesheet" type="text/css"
	href="<?php
	echo (RELATIVITY_PATH)?>css/common.css" />
<link rel="stylesheet" type="text/css" href="css/ucenter.css" />
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/jquery.min.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/common.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/dialog.fun.js"></script>
<script type="text/javascript" src="js/common.fun.js"></script>
<script type="text/javascript" src="js/submit.fun.js"></script>
<script type="text/javascript"
	src="<?php
	echo (RELATIVITY_PATH)?>js/login.fun.js"></script>
<script type="text/javascript">
	var N_Time=<?php
	echo ($o_section->getTime ())?>;
	$(window).load(function(){
		examStartTime();
		//parent.scrollTo(0,100000)	$("#subject_0").fadeIn();	
		$("#subject_0").fadeIn()
		//setTimeout('$("#subject_0").fadeIn()',1000);
		//setTimeout('parent.Common_CloseDialog();',1000);
		});
	var N_Second=0;
	var ExamTimeHandle=0;
	</script>
</head>
<body style="background-image: none">
<form method="post" id="submit_form"
	action="include/bn_submit.svr.php?function=ExamSubmit"
	enctype="multipart/form-data" target="ajax_submit_frame"
	style="width: 100%" onsubmit="this.submit();parent.Common_OpenLoading();">
    <div class="exam_title">
        <div class="text">
            测试中...</div>
        <div id="time">
        </div>
    </div>
<div id="subject">
<div id="number" class="text" align="center">
            问题 1</div>
<?php
//读取所有考题
$o_subject = new Bank_Subject ();
$o_subject->PushWhere ( array ('&&', 'SectionId', '=', $o_section->getSectionId () ) );
$n_subject_count = $o_subject->getAllCount ();
//读取做过了的题
$o_study_section = new User_Study_Section ();
$o_study_section->PushWhere ( array ('&&', 'SectionId', '=', $o_section->getSectionId () ) );
$o_study_section->PushWhere ( array ('&&', 'Uid', '=', $O_Session->getUid () ) );
if ($o_study_section->getAllCount () == 0) {
	//如果没有，需要新建
	$o_temp = new User_Study_Section ();
	$o_temp->setSectionId ( $o_section->getSectionId () );
	$o_temp->setUid ( $O_Session->getUid () );
	$o_temp->Save ();
	$n_studyid = $o_temp->getStudyId ( 0 );
	$a_finish = array ();
} else {
	//拆分已做过的数组
	$a_finish = explode ( "<1>", $o_study_section->getFinish ( 0 ) );
	$a_finish = array_slice ( $a_finish, 1, count ( $a_finish ) - 1 );
	$n_studyid = $o_study_section->getStudyId ( 0 );
}
$a_display = array (); //记录当前显示的考题编号
$n_subject_sum = $o_section->getSubjectSum ();
$n_show_sum=0;//记录这是第几个题
$s_subjec='';//记录显示的所有题编号
//随机抽取题目,循环次数为本节要答题的总数
for($i = 0; $i < $o_section->getSubjectSum (); $i ++) {
	//随机抽取题目，循环抽10次,直到抽出为止
	for($j = 0; $j < 10; $j ++) {
		$n_rand = rand ( 0, $n_subject_count - 1 );
		$n_subject_id = $o_subject->getSubjectId ( $n_rand ); //按考题数，取随机数，获取考题编号
		//如果考题在数组中，那么继续抽取，如果不在，则显示并把考题追加的节的Finish字段中并追加到数组中
		if (in_array ( $n_subject_id, $a_finish )) {
			//存在
			continue;
		} else {
			//显示考题
			echo ('<div id="subject_'.$n_show_sum.'" style="display:none">
						<div class="title">'.$o_subject->getContent ( $n_rand ).'
						</div>');
			//显示选项
			$o_option = new Bank_Option ();
			$o_option->PushWhere ( array ('&&', 'SubjectId', '=', $n_subject_id ) );
			$o_option->PushOrder ( array ('Number', 'A' ) );
			$n_option_count = $o_option->getAllCount ();
			echo ('<div class="item">');
			$a_right = explode ( "<1>", $o_subject->getRightOptionId ( $n_rand ) );
			for($k = 0; $k < $n_option_count; $k ++) {
				if (count ( $a_right ) > 1) {
					//多选
					echo ('<div class="option">
								<div>
									<input name="Vcl_Item_More_' . $o_option->getOptionId ( $k ) . '" id="Vcl_Item_More_' . $o_option->getOptionId ( $k ) . '" type="checkbox" />
								</div>
								<div>
									' . $o_option->getNumber ( $k ) . ' .
								</div>
								<div class="text2">
									' . $o_option->getText ( $k ) . '
								</div>						   		
						   </div>');
				
				} else {
					//单选
					echo ('<div class="option">
								<div>
									<input type="radio" name="Vcl_Item_' . $n_subject_id . '" value="' . $o_option->getOptionId ( $k ) . '" />
								</div>
								<div>
									' . $o_option->getNumber ( $k ) . ' .
								</div>
								<div class="text2">
									' . $o_option->getText ( $k ) . '
								</div>						   		
						   </div>');
				}
			}
			echo ('</div>');
			echo ('<div class="button">');
			$n_subject_sum = $n_subject_sum - 1; //记录还剩几道考题
			//显示按钮
			if ($o_section->getSubjectSum () == 1) {
				echo ('<div class="submit" align="center" onclick="examSubmit()">提交答题</div>');
			} else if ($n_subject_sum == ($o_section->getSubjectSum () - 1)) {
				echo ('<div align="center" onclick="examExitSubject('.$n_show_sum.')">下一题</div>');
			} else if ($n_subject_sum == 0) {
				echo ('<div align="center" onclick="examPrevSubject('.$n_show_sum.')">上一题</div><div class="submit" align="center" onclick="examSubmit()">提交答题</div>');
			} else {
				echo ('<div align="center" onclick="examPrevSubject('.$n_show_sum.')">上一题</div><div align="center" onclick="examExitSubject('.$n_show_sum.')">下一题</div>');
			}
			echo ('</div>');
			echo ('</div>');
			$n_show_sum++;
			$s_subject.='<1>'.$n_subject_id;
			//把考题编号追加到数组中
			array_push ( $a_finish, $n_subject_id );
			array_push ( $a_display, $n_subject_id );
			//把考题追加到节的Finish中
			$o_temp = new User_Study_Section ( $n_studyid );
			$o_temp->setFinish ( $o_temp->getFinish () . '<1>' . $n_subject_id );
			$o_temp->Save ();
			break;
		}
	}
}
$a_display2 = array ();
//都完了，要看考题是否够了，如果不够，按条件读取考题，清空finish字段
if ($n_subject_sum > 0) {
	//清空finish字段
	$o_temp = new User_Study_Section ( $n_studyid );
	$o_temp->setFinish ( '' );
	$o_temp->Save ();
	//读取所有考题
	$o_subject = new Bank_Subject ();
	for($i = 0; $i < count ( $a_display ); $i ++) {
		$o_subject->PushWhere ( array ('&&', 'SubjectId', '<>', $a_display [$i] ) );
	}
	$o_subject->PushWhere ( array ('&&', 'SectionId', '=', $o_section->getSectionId () ) );
	$n_subject_count = $o_subject->getAllCount ();
	if ($n_subject_count >= $n_subject_sum) { //必须要大于，否则抽不出来了。
		//循环随机读取考题
		for($i = $n_subject_sum; $i > 0; $i --) {
			//显示考题
			$n_rand = rand ( 0, $n_subject_count - 1 );
			$n_subject_id = $o_subject->getSubjectId ( $n_rand );
			if (in_array ( $n_subject_id, $a_display2 )) {
				//如果刚才已经抽取了，那么如果又抽取，挑出，并再循环一次
				$i ++;
				continue;
			}
			//显示考题
			echo ('<div id="subject_'.$n_show_sum.'" style="display:none">
						<div class="title">'.$o_subject->getContent ( $n_rand ).'
						</div>');
			//显示选项
			$o_option = new Bank_Option ();
			$o_option->PushWhere ( array ('&&', 'SubjectId', '=', $n_subject_id ) );
			$o_option->PushOrder ( array ('Number', 'A' ) );
			$n_option_count = $o_option->getAllCount ();
			echo ('<div class="item">');
			$a_right = explode ( "<1>", $o_subject->getRightOptionId ( $n_rand ) );
			for($k = 0; $k < $n_option_count; $k ++) {
				if (count ( $a_right ) > 1) {
					//多选
					echo ('<div class="option">
								<div>
									<input name="Vcl_Item_More_' . $o_option->getOptionId ( $k ) . '" id="Vcl_Item_More_' . $o_option->getOptionId ( $k ) . '" type="checkbox" />
								</div>
								<div>
									' . $o_option->getNumber ( $k ) . ' .
								</div>
								<div class="text2">
									' . $o_option->getText ( $k ) . '
								</div>						   		
						   </div>');
				
				} else {
					//单选
					echo ('<div class="option">
								<div>
									<input type="radio" name="Vcl_Item_' . $n_subject_id . '" value="' . $o_option->getOptionId ( $k ) . '" />
								</div>
								<div>
									' . $o_option->getNumber ( $k ) . ' .
								</div>
								<div class="text2">
									' . $o_option->getText ( $k ) . '
								</div>						   		
						   </div>');
				}
			}
			echo ('</div>');
			echo ('<div class="button">');
			//显示按钮
			if ($o_section->getSubjectSum () == 1) {
				echo ('<div class="submit" align="center" onclick="examSubmit()">提交答题</div>');
			} else if ($i == 1) {
				echo ('<div onclick="examPrevSubject('.$n_show_sum.')" align="center">上一题</div><div class="submit" align="center" onclick="examSubmit()">提交答题</div>');
			} else if ($i == $n_subject_sum && count ( $a_display ) == 0) {
				echo ('<div align="center" onclick="examExitSubject('.$n_show_sum.')">下一题</div>');
			} else {
				echo ('<div align="center" onclick="examPrevSubject('.$n_show_sum.')">上一题</div><div align="center" onclick="examExitSubject('.$n_show_sum.')">下一题</div>');
			}
			echo ('</div>');
			echo ('</div>');
			$n_show_sum++;
			$s_subject.='<1>'.$n_subject_id;
			array_push ( $a_display2, $n_subject_id );
			//把考题追加到节的Finish中
			$o_temp = new User_Study_Section ( $n_studyid );
			$o_temp->setFinish ( $o_temp->getFinish () . '<1>' . $n_subject_id );
			$o_temp->Save ();
		}
	}
}
echo('<input type="hidden" name="Vcl_SubjectId" value="'.$s_subject.'"> ');//输出所有题的编号，以备提交后判卷
?>

</div>
</form>
<iframe id="ajax_submit_frame" name="ajax_submit_frame" width="0"
	height="0" marginwidth="0" border="0" frameborder="0" src="about:blank"></iframe>
</body>
</html>
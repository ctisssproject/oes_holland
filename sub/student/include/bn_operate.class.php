<?php
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/db_view.class.php';
require_once RELATIVITY_PATH . 'include/bn_basic.class.php';
class Operate extends Bn_Basic {
	public function __construct() {
		$this->Result = FALSE;
	}
	public function InvitationFirend($n_uid) {
		if (! ($n_uid > 0)) {
			//直接退出系统
			$this->S_ErrorReasion = SysText::Index ( 'Error_004' );
			return false;
		}
		if ($this->GetInvitationFirendSum ( $n_uid ) == 0) {
			$this->S_ErrorReasion = SysText::Index ( 'Error_005' );
			return false;
		}
		//生成邀请码
		$o_invitation = new Invitation ();
		$n_code = $this->getRandString ( 10 );
		$o_invitation->setCodeId ( $n_code );
		$o_invitation->setUid ( $n_uid );
		$o_invitation->setDate ( $this->GetDate () );
		$o_invitation->setState ( 1 );
		$o_invitation->Save ();
		//发送邮件
		$this->SendEmailInvFirend ( $n_uid, $_POST ['Vcl_Name'], $_POST ['Vcl_Email'], $n_code );
		//
		$this->S_ErrorReasion = SysText::Index ( 'Ok_001' );
		return true;
	
	}
	public function ShareFirend($n_uid) {
		if (! ($n_uid > 0)) {
			//直接退出系统
			$this->S_ErrorReasion = SysText::Index ( 'Error_004' );
			return false;
		}
		//发送邮件
		$this->SendEmailShareFirend ( $n_uid, $_POST ['Vcl_Name'], $_POST ['Vcl_Email'], $_POST ['Vcl_Url'], $_POST ['Vcl_ChapterId'] );
		//
		$this->S_ErrorReasion = SysText::Index ( 'Ok_006' );
		return true;
	
	}
	public function SendCredential($n_uid) {
		if (! ($n_uid > 0)) {
			//直接退出系统
			$this->S_ErrorReasion = SysText::Index ( 'Error_004' );
			return false;
		}
		//发送邮件
		$o_user = new User ( $n_uid );
		if ($o_user->getIsSend () == 1) {
			return true;
		}
		$o_user->setIsSend ( 1 );
		$o_user->Save ();
		$o_send = new Goods_Send ();
		$o_send->setUid ( $n_uid );
		$o_send->setAddress ( $_POST ['Vcl_Address'] );
		$o_send->setName ( $_POST ['Vcl_Name'] );
		$o_send->setPostcode ( $_POST ['Vcl_PostCode'] );
		$o_send->setPhone ( $_POST ['Vcl_Phone'] );
		$o_send->setDate ( $this->GetDateNow () );
		$o_send->setType ( 1 );
		$system = new System ( 1 );
		if ($system->getCredentialCheck () == 1) {
			$o_send->setState ( 1 );
		} else {
			$o_send->setState ( 2 );
		}
		$o_send->Save ();
		$this->S_ErrorReasion = SysText::Index ( 'Ok_013' );
		return true;
	
	}
	public function PrizeExchange($n_uid) {
		if (! ($n_uid > 0)) {
			//直接退出系统
			$this->S_ErrorReasion = SysText::Index ( 'Error_004' );
			return false;
		}
		$this->S_ErrorReasion = SysText::Index ( 'Ok_024' );
		//发送邮件
		$o_user = new User ( $n_uid );
		$o_prize = new Prize ( $_POST ['Vcl_PrizeId'] );
		if ($o_prize->getVantage () > $o_user->getVantage ()) {
			return true;
		}
		if ($o_prize->getSum () == 0) {
			$this->S_ErrorReasion = SysText::Index ( 'Error_014' );
			return false;
		}
		$o_send = new Goods_Send ();
		$o_send->setUid ( $n_uid );
		$o_send->setAddress ( $_POST ['Vcl_Address'] );
		$o_send->setName ( $_POST ['Vcl_Name'] );
		$o_send->setPostcode ( $_POST ['Vcl_PostCode'] );
		$o_send->setPhone ( $_POST ['Vcl_Phone'] );
		$o_send->setDate ( $this->GetDateNow () );
		$o_send->setGoodsId ( $_POST ['Vcl_PrizeId'] );
		$o_send->setSum ( 1 );
		$o_send->setType ( 2 );
		$system = new System ( 1 );
		if ($system->getPrizeCheck () == 1) {
			$o_send->setState ( 1 );
		} else {
			$o_send->setState ( 2 );
		}
		$o_send->Save ();
		if ($o_prize->getVantage () > 0) {
			//用户积分减少
			$o_user->setVantage ( $o_user->getVantage () - $o_prize->getVantage () );
			$o_user->Save ();
			//添加积分记录
			$o_record = new User_Vantage ();
			$o_record->setUid ( $n_uid );
			$o_record->setInOut ( 0 ); //出库
			$o_record->setDate ( $this->GetDateNow () );
			$o_record->setBalance ( $o_user->getVantage () ); //余额
			$o_record->setExplain ( '兑换奖品“' . $o_prize->getName () . '”' );
			$o_record->setSum ( $o_prize->getVantage () );
			$o_record->Save ();
		}
		$_POST ['Vcl_PrizeId'] = $o_user->getVantage ();
		//计算奖品
		$n_sum = $o_prize->getSum () - 1;
		if ($n_sum < 0) {
			$o_prize->setSum ( 0 );
		} else {
			$o_prize->setSum ( $n_sum );
		}
		$o_prize->Save ();
		if ($o_prize->getSum () < $o_prize->getRemSum () && $o_prize->getRemEmail () != '') {
			//发送缺货提醒
			//发送邮件
			$this->JmailSendEmail ( $o_prize->getRemEmail (), '《荷兰旅游专家》奖品库存不足提醒', '您好！《荷兰旅游专家》的“' . $o_prize->getName () . '”奖品不足，请您及时补货！' );
		}
		return true;
	}
	public function InformationUse($n_uid) {
		if (! ($n_uid > 0)) {
			//直接退出系统
			$this->S_ErrorReasion = SysText::Index ( 'Error_004' );
			return false;
		}
		$this->S_ErrorReasion = SysText::Index ( 'Ok_025' );
		//发送邮件
		$o_user = new User ( $n_uid );
		$o_info = new Information ( $_POST ['Vcl_InformationId'] );
		$o_send = new Goods_Send ();
		$o_send->setUid ( $n_uid );
		$o_send->setAddress ( $_POST ['Vcl_Address'] );
		$o_send->setName ( $_POST ['Vcl_Name'] );
		$o_send->setPostcode ( $_POST ['Vcl_PostCode'] );
		$o_send->setPhone ( $_POST ['Vcl_Phone'] );
		$o_send->setDate ( $this->GetDateNow () );
		$o_send->setGoodsId ( $_POST ['Vcl_InformationId'] );
		$o_send->setSum ( $o_info->getSum () );
		$o_send->setType ( 3 );
		$system = new System ( 1 );
		if ($system->getInformationCheck () == 1) {
			$o_send->setState ( 1 );
		} else {
			$o_send->setState ( 2 );
		}
		$o_send->Save ();
		return true;
	}
	public function GetInvitationFirendSum($n_uid) {
		if (! ($n_uid > 0)) {
			return 0;
		}
		//获取今日邀请好友的数量
		$o_invitation = new Invitation ();
		$o_invitation->PushWhere ( array ('&&', 'Uid', '=', $n_uid ) );
		$o_invitation->PushWhere ( array ('&&', 'Date', '=', $this->GetDate () ) );
		$n_count = $o_invitation->getAllCount ();
		//读取系统设置的数量
		$o_system = new System ( 1 );
		if ($n_count >= $o_system->getInvitationSum ()) {
			return 0;
		} else {
			return $o_system->getInvitationSum () - $n_count;
		}
	}
	public function CheckPasswordOld($n_uid, $s_password) {
		if (! ($n_uid > 0)) {
			return false;
		}
		$o_user = new User ( $n_uid );
		if ($o_user->getPassword () == md5 ( 'welcome ' . $s_password . ' to 荷兰旅游促进局' )) {
			return true;
		} else {
			return false;
		}
	}
	public function CredentialStyleModify($n_uid, $id) {
		if (! ($n_uid > 0)) {
			return false;
		}
		$o_send = new Goods_Send ();
		$o_send->PushWhere ( array ('&&', 'Type', '=', 1 ) );
		$o_send->PushWhere ( array ('&&', 'Uid', '=',$n_uid ) );
		$o_send->PushWhere ( array ('&&', 'State', '=', 2 ) );
		if ($o_send->getAllCount () == 0) {
			return ;
		}
		$o_user = new User ( $n_uid );
		$o_user->setCredentialId ( $id );
		$o_user->Save ();
	}
	public function ExamSubmit($n_uid) {
		if (! ($n_uid > 0)) {
			//直接退出系统
			$this->S_ErrorReasion = SysText::Index ( 'Error_004' );
			return false;
		}
		//获取这次显示的所有题的编号
		$a_subject_id = explode ( "<1>", $_POST ['Vcl_SubjectId'] );
		$a_subject_id = array_slice ( $a_subject_id, 1, count ( $a_subject_id ) - 1 ); //修正一下，去掉第一个
		$n_right = 0; //记录答对题的数目
		//开始循环判卷
		for($i = 0; $i < count ( $a_subject_id ); $i ++) {
			$o_subject = new Bank_Subject ( $a_subject_id [$i] );
			//判断是单选还是多选
			$a_right = explode ( "<1>", $o_subject->getRightOptionId () );
			if (count ( $a_right ) > 1) {
				//多选
				$o_option = new Bank_Option ();
				$o_option->PushWhere ( array ('&&', 'SubjectId', '=', $a_subject_id [$i] ) );
				$o_option->PushOrder ( array ('Number', 'A' ) );
				$n_option_count = $o_option->getAllCount (); //读取本题下的题目总数
				$b_right = true;
				for($j = 0; $j < $n_option_count; $j ++) {
					//判断选项编号是否在正确答案中
					if (in_array ( $o_option->getOptionId ( $j ), $a_right )) {
						//在正确答案中，再读取客户做的题，是否被选中，
						$a = $_POST ['Vcl_Item_More_' . $o_option->getOptionId ( $j )];
						if ($_POST ['Vcl_Item_More_' . $o_option->getOptionId ( $j )] != 'on') {
							$b_right = false;
							break;
						}
					} else {
						//不在正确答案中，再读取客户做的题，是否被选中，
						if ($_POST ['Vcl_Item_More_' . $o_option->getOptionId ( $j )] == 'on') {
							$b_right = false;
							break;
						}
					}
				}
				if ($b_right) {
					//答对
					$n_right ++;
				}
			} else {
				//单选
				if ($a_right [0] == $_POST ['Vcl_Item_' . $a_subject_id [$i]]) {
					//答对
					$n_right ++;
				}
			}
		}
		//读取正确率
		$o_section = new Bank_Section ( $o_subject->getSectionId () );
		$n_rate = $o_section->getRate ();
		//计算当前正确率
		$n_rate_user = floor ( $n_right / count ( $a_subject_id ) * 100 );
		if ($n_rate_user >= $n_rate) {
			//考试通过
			$this->S_ErrorReasion = SysText::Index ( 'Ok_007' );
			//计算完成度
			$o_user_chapter = new User_Study_Chapter (); //查找用户是否做过
			$o_user_chapter->PushWhere ( array ('&&', 'Uid', '=', $n_uid ) );
			$o_user_chapter->PushWhere ( array ('&&', 'ChapterId', '=', $o_section->getChapterId () ) );
			if ($o_user_chapter->getAllCount () > 0) {
				//做过
				$s_temp = $o_user_chapter->getFinish ( 0 );
				$o_user_chapter = new User_Study_Chapter ( $o_user_chapter->getStudyId ( 0 ) );
				$o_user_chapter->setFinish ( $s_temp . $o_subject->getSectionId () . '<1>' );
			} else {
				//没做过
				$o_user_chapter = new User_Study_Chapter ();
				$o_user_chapter->setUid ( $n_uid );
				$o_user_chapter->setChapterId ( $o_section->getChapterId () );
				$o_user_chapter->setFinish ( '<1>' . $o_subject->getSectionId () . '<1>' );
			}
			$o_user_chapter->save ();
			//查看该章下有多少节
			$o_temp = new Bank_Section ();
			$o_temp->PushWhere ( array ('&&', 'ChapterId', '=', $o_section->getChapterId () ) );
			$o_temp->PushWhere ( array ('&&', 'State', '=', 1 ) );
			$n_section_sum = $o_temp->getAllCount ();
			//获取已完成节的个数
			$a_user_complete = explode ( "<1>", $o_user_chapter->getFinish () );
			$a_user_complete = array_slice ( $a_user_complete, 1, count ( $a_user_complete ) - 1 ); //修正一下，去掉第一个
			$a_user_complete = array_slice ( $a_user_complete, 0, count ( $a_user_complete ) - 1 ); //修正一下，去掉最后一个
			//设置百分百
			if (floor ( count ( $a_user_complete ) / $n_section_sum * 100 ) >= 100) {
				$o_user_chapter->setPercent ( 100 );
			} else {
				$o_user_chapter->setPercent ( floor ( count ( $a_user_complete ) / $n_section_sum * 100 ) );
			}
			//添加积分
			$o_user_chapter->setVantage ( $o_user_chapter->getVantage () + $o_section->getVantage () );
			$o_user_chapter->Save ();
			//开始计算积分
			$o_user = new user ( $n_uid );
			$o_user->setVantage ( $o_user->getVantage () + $o_section->getVantage () );
			$o_user->Save ();
			//添加积分记录
			$o_record = new User_Vantage ();
			$o_record->setUid ( $n_uid );
			$o_record->setInOut ( 1 ); //入库
			$o_record->setDate ( $this->GetDateNow () );
			$o_record->setBalance ( $o_user->getVantage () ); //余额
			$o_record->setExplain ( '完成课程《' . $o_section->getTitle () . '》获得积分' );
			$o_record->setSum ( $o_section->getVantage () );
			$o_record->Save ();
			//计算整体完成度
			$o_term = new Bank_Term ();
			$o_term->PushWhere ( array ('&&', 'State', '=', 1 ) );
			$o_term->getAllCount ();
			$o_chapter = new Bank_Chapter ();
			$o_chapter->PushWhere ( array ('&&', 'State', '=', 1 ) );
			$o_chapter->PushWhere ( array ('&&', 'TermId', '=', $o_term->getTermId ( 0 ) ) );
			$o_chapter->PushOrder ( array ('Number', 'A' ) );
			$n_chapter_count = $o_chapter->getAllCount ();
			$b_complete = true;
			for($i = 0; $i < $n_chapter_count; $i ++) {
				$o_chapter_user = new User_Study_Chapter ();
				$o_chapter_user->PushWhere ( array ('&&', 'Uid', '=', $n_uid ) );
				$o_chapter_user->PushWhere ( array ('&&', 'ChapterId', '=', $o_chapter->getChapterId ( $i ) ) );
				if ($o_chapter_user->getAllCount () > 0) {
					if ($o_chapter_user->getPercent ( 0 ) < 100) {
						$b_complete = false;
						break;
					}
				} else {
					$b_complete = false;
					break;
				}
			}
			if ($b_complete) {
				//获得荷兰旅游专家证书
				$o_user = new user ( $n_uid );
				//专家奖分
				$o_system = new system ( 1 );
				if ($o_user->getType () < 3) {
					//说明是管理员
				} else {
					$o_user->setType ( 5 ); //变为本年度专家
					$o_user->setPercent ( 100 ); //变为本年度专家
				}
				$o_user->setVantage ( $o_user->getVantage () + $o_system->getReward () );
				$o_user->setTerm ( 0 ); //学期有效期重新计算
				$o_user->Save ();
				//添加积分记录
				$o_record = new User_Vantage ();
				$o_record->setUid ( $n_uid );
				$o_record->setInOut ( 1 ); //入库
				$o_record->setDate ( $this->GetDateNow () );
				$o_record->setBalance ( $o_user->getVantage () ); //余额
				$o_record->setExplain ( '获得《荷兰旅游专家》奖励积分' );
				$o_record->setSum ( $o_system->getReward () );
				$o_record->Save ();
				$this->Result = true;
				$this->S_ErrorReasion = SysText::Index ( 'Ok_008' ) . $o_system->getReward () . SysText::Index ( 'Ok_028' );
				//发送邮件
				$this->SendCongratulate ( $n_uid );
				return true;
			}
		} else {
			//没通过
			$this->S_ErrorReasion = SysText::Index ( 'Error_012' );
			return false;
		}
		return true;
	}
	public function getResult() {
		return $this->Result;
	}
}
?>
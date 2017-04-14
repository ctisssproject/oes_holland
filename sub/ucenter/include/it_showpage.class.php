<?php
require_once RELATIVITY_PATH . 'include/db_view.class.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
//require_once RELATIVITY_PATH . 'include/bn_user.class.php';
require_once RELATIVITY_PATH . 'include/it_basic.class.php';
class ShowPage extends It_Basic {
	private $O_SingleUser;
	
	public function __construct($o_singleUser = NULL) {
		$this->O_SingleUser = $o_singleUser;
		$this->N_PageSize = 25;
	}
	public function AdminList($n_page) {
		$this->S_FileName = 'admin_list.php?';
		$this->N_Page = $n_page;
		$o_table = new User ();
		$o_table->PushWhere ( array ('&&', 'Type', '=', 1 ) );
		$o_table->PushWhere ( array ('&&', 'Uid', '<>', 1 ) );
		$o_table->PushWhere ( array ('||', 'Type', '=', 2 ) );
		$o_table->PushOrder ( array ('UserName', 'A' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			if ($o_table->getState ( $i ) == 1) {
				$s_state = '<span class="green">启用</span>';
				$s_button = '<div title="禁用" class="disable" onclick="adminState(\'禁用\',' . $o_table->getUid ( $i ) . ')"></div>';
			} else {
				$s_state = '<span class="red">禁用</span>';
				$s_button = '<div title="启用" class="enable" onclick="adminState(\'启用\',' . $o_table->getUid ( $i ) . ')"></div>';
			}
			if ($o_table->getType ( $i ) == 1) {
				$s_role = '后台管理';
			} else {
				$s_role = '配送管理';
			}
			$a_date = explode ( " ", $o_table->getRegTime ( $i ) );
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
                                <td>
                                    ' . $o_table->getUserName ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $o_table->getName ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $o_table->getSex ( $i ) . '&nbsp;
                                </td>
                                <td>
                                   ' . $s_role . '&nbsp;
                                </td>
                                <td>
                                    ' . $a_date [0] . '&nbsp;
                                </td>
                                <td>
                                    ' . $s_state . '&nbsp;
                                </td>
                                <td class="operate">
                                    <div title="删除" class="delete" onclick="adminDelete(' . $o_table->getUid ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'admin_modify.php?uid=' . $o_table->getUid ( $i ) . '\')">
                                    </div>
                                    ' . $s_button . '
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>所有后台内部用户：共' . $n_allcount . '人</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    用户名<img style="margin-left: 5px" src="images/sort_a.png" alt="" />
                                </td>
                                <td>
                                    姓名
                                </td>
                                <td>
                                    性别
                                </td>
                                <td>
                                    角色
                                </td>
                                <td>
                                    建立日期
                                </td>
                                <td>
                                    状态
                                </td>
                                <td class="right_none" style="width:13%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function StudentWait($n_page) {
		$this->S_FileName = 'student_wait.php?';
		$this->N_Page = $n_page;
		$o_table = new User ();
		$o_table->PushWhere ( array ('&&', 'Checked', '=', 0 ) );
		$o_table->PushWhere ( array ('&&', 'Type', '>', 2 ) );
		$o_table->PushOrder ( array ('RegTime', 'D' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			$a_date = explode ( " ", $o_table->getRegTime ( $i ) );
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
								<td>
                                    ' . $a_date [0] . '
                                </td>
                                <td>
                                    ' . $o_table->getUserName ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getName ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getSex ( $i ) . '
                                </td>
                                <td>
                                   ' . $o_table->getBirthday ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getCompany ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getDept ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getJob ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getPhone ( $i ) . '
                                </td>
                                <td class="operate" style="width:13%">
                                    <div title="删除" class="delete" onclick="studentDelete(' . $o_table->getUid ( $i ) . ')">
                                    </div>
                                    <div title="详细信息" class="info" onclick="rightGoTo(\'student_info.php?uid=' . $o_table->getUid ( $i ) . '\')">
                                    </div>
                                    <div title="通过审核" class="enable" onclick="studentAllow(' . $o_table->getUid ( $i ) . ')">
                                    </div>
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                           <div> 等待审核用户：共' . $n_allcount . '人</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    注册日期<img style="margin-left: 5px" src="images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    用户名
                                </td>
                                <td>
                                    姓名
                                </td>
                                <td>
                                    性别
                                </td>
                                <td>
                                    出生日期
                                </td>
                                <td>
                                    公司
                                </td>
                                <td>
                                    部门
                                </td>
                                <td>
                                    职务
                                </td>
                                <td>
                                    手机
                                </td>
                                <td class="right_none" style="width:13%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	private function StudentList($n_type, $n_sleep = 0, $s_key) {
		$o_table = new User ();
		if ($s_key != '') {
			$o_table->PushWhere ( array ('&&', 'Name', 'LIKE', '%' . $_GET ['key'] . '%' ) );
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
			$o_table->PushWhere ( array ('||', 'UserName', 'LIKE', '%' . $_GET ['key'] . '%' ) );
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
			$o_table->PushWhere ( array ('||', 'Company', 'LIKE', '%' . $_GET ['key'] . '%' ) );
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		} else {
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'e-learning' ) );
			if ($n_type > 0) {
				if ($n_type == 6) {
					$o_table->PushWhere ( array ('&&', 'Type', '>=', 4 ) );
				} else {
					$o_table->PushWhere ( array ('&&', 'Type', '=', $n_type ) );
				}
			} else if ($n_sleep == 1) {
				$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
				$o_table->PushWhere ( array ('&&', 'IsSleep', '=', 1 ) );
			
			} else {
				$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
			}
		}
		$o_table->PushOrder ( array ('RegTime', 'D' ) );
		$o_table->PushOrder ( array ('UserName', 'D' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			$a_date = explode ( " ", $o_table->getRegTime ( $i ) );
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$s_img = '';
			
			if ($o_table->getIsSleep ( $i ) == 1) {
				$s_img .= '<img src="images/list_sleep_icon.png" alt="睡眠户" align="absmiddle"/> ';
			}
			if ($o_table->getType ( $i ) > 3) {
				$s_img .= '<img src="images/list_expert_icon.png" alt="荷兰旅游专家" align="absmiddle"/> ';
			}
			$n_width = floor ( $o_table->getPercent ( $i ) * 60 / 100 );
			$s_list .= '
						<tr class="' . $s_class . '">
								<td>
                                    ' . $a_date [0] . '
                                </td>
								<td>
									<div style="border:1px solid #999999;;width:60px;height:16px;">										
										<div style="background-color:#54C3F1; width:' . $n_width . 'px;height:16px;position:absolute">											
										</div>	
										<div style="position:absolute;width:60px;text-align:center;">' . $o_table->getPercent ( $i ) . '%</div>										
									</div>                                    
                                </td>
                                <td>
                                    ' . $s_img . $o_table->getUserName ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getName ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getSex ( $i ) . '
                                </td>
                                <td>
                                   ' . $o_table->getBirthday ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getCompany ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getDept ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getJob ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getPhone ( $i ) . '
                                </td>
                                <td class="operate" style="width:10%">
                                    <div title="删除" class="delete" onclick="studentDelete(' . $o_table->getUid ( $i ) . ')">
                                    </div>
                                    <div title="详细信息" class="info" onclick="rightGoTo(\'student_info.php?uid=' . $o_table->getUid ( $i ) . '\')">
                                    </div>
                                </td>
                            </tr>
		';
		}
		if ($n_type == 0) {
			$s_title = "普通学员列表";
		}
		if ($n_type == 3) {
			$s_title = "普通学员列表";
		}
		if ($n_type == 6) {
			$s_title = "专家列表";
		}
		if ($n_type == 4) {
			$s_title = "往年专家列表";
		}
		if ($n_type == 5) {
			$s_title = "新期专家列表";
		}
		if ($n_sleep == 1) {
			$s_title = "睡眠学员列表";
		}
		$s_html = '
			    <div class="title">
                            <div>' . $s_title . '：共' . $n_allcount . '人</div>
                            <div style="margin-left:50px;margin-top:7px">
                            <select id="type" style="margin:0px;width:auto;font-size:14px;height:30px;font-family:微软雅黑;" onchange="selectType(this)">
                            	<option value="1"> 所有学员 </option>
                            	<option value="2"> 普通学员 </option>
                            	<option value="3"> 往年专家 </option>
                            	<option value="4"> 新期专家 </option>
                            	<option value="5"> 所有专家 </option>
                            	<option value="6"> 睡眠户列表 </option>
                            </select>
                            </div>  
                            <input class="subText" id="Vcl_Key" name="Vcl_Key" maxlength="200" value="" style="width: 200px;float:left" type="text" />
                            <div class="subButton" style="float:left" onclick="searchSubmit(\'student_all.php?\')">搜索</div>               
                            <div class="subButton" onclick="window.open(\'student_output.php?type=' . $n_type . '&sleep=' . $n_sleep . '\',\'_blank\')">信息导出</div>
                            <div class="subButton" onclick="location=\'student_sendmail.php?come_from=e-learning\'">群发邮件</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td style="width:80px;">
                                    注册日期<img style="margin-left: 5px" src="images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    专家完成度
                                </td>
                                <td>
                                    用户名
                                </td>
                                <td style="width:60px;">
                                    姓名
                                </td>
                                <td style="width:30px;">
                                    性别
                                </td>
                                <td style="width:80px;">
                                    出生日期
                                </td>
                                <td>
                                    公司
                                </td>
                                <td>
                                    部门
                                </td>
                                <td>
                                    职务
                                </td>
                                <td>
                                    手机
                                </td>
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function StudentMedia($n_page,$s_key) {
		$this->S_FileName = 'student_media.php?key='.$s_key.'&';
		$this->N_Page = $n_page;
		$o_table = new User ();
		if ($s_key != '') {
			$o_table->PushWhere ( array ('&&', 'Name', 'LIKE', '%' . $s_key . '%' ) );
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'media' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
			$o_table->PushWhere ( array ('||', 'UserName', 'LIKE', '%' . $s_key . '%' ) );
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'media' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
			$o_table->PushWhere ( array ('||', 'Company', 'LIKE', '%' . $s_key . '%' ) );
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'media' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		} else {
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'media' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		}
		$o_table->PushOrder ( array ('UserName', 'D' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
                                <td>
                                    ' . $o_table->getUserName ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getName ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getSex ( $i ) . '
                                </td>
                                <td>
                                   ' . $o_table->getBirthday ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getCompany ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getDept ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getJob ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getPhone ( $i ) . '
                                </td>
                                <td class="operate" style="width:10%">
                                    <div title="删除" class="delete" onclick="studentDelete(' . $o_table->getUid ( $i ) . ')">
                                    </div>
                                    <div title="详细信息" class="info" onclick="rightGoTo(\'student_info.php?uid=' . $o_table->getUid ( $i ) . '\')">
                                    </div>
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>媒体用户列表：共' . $n_allcount . '人</div>   
                            <input class="subText" id="Vcl_Key" name="Vcl_Key" maxlength="200" value="" style="width: 200px;float:left" type="text" />
                            <div class="subButton" style="float:left" onclick="searchSubmit(\'student_media.php?\')">搜索</div>                          
                            <div class="subButton" onclick="window.open(\'student_output.php?type=7&sleep=0\',\'_blank\')">信息导出</div>
                            <div class="subButton" onclick="location=\'student_sendmail.php?come_from=media\'">群发邮件</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    用户名<img style="margin-left: 5px" src="images/sort_d.png" alt="" />
                                </td>
                                <td style="width:60px;">
                                    姓名
                                </td>
                                <td style="width:30px;">
                                    性别
                                </td>
                                <td style="width:80px;">
                                    出生日期
                                </td>
                                <td>
                                    公司
                                </td>
                                <td>
                                    部门
                                </td>
                                <td>
                                    职务
                                </td>
                                <td>
                                    手机
                                </td>
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function StudentWechat($n_page,$s_key) {
		$this->S_FileName = 'student_wechat.php?key='.$s_key.'&';
		$this->N_Page = $n_page;
		$o_table = new User ();
		if ($s_key != '') {
			$o_table->PushWhere ( array ('&&', 'Name', 'LIKE', '%' . $s_key . '%' ) );
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'wechat' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
			$o_table->PushWhere ( array ('||', 'UserName', 'LIKE', '%' . $s_key . '%' ) );
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'wechat' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
			$o_table->PushWhere ( array ('||', 'Company', 'LIKE', '%' . $s_key . '%' ) );
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'wechat' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		} else {
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'wechat' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		}
		$o_table->PushOrder ( array ('UserName', 'D' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			$s_img='';
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			if ($o_table->getIsSleep ( $i ) == 1) {
				$s_img .= '<img src="images/list_sleep_icon.png" alt="睡眠户" align="absmiddle"/> ';
			}
			if ($o_table->getPercent ( $i ) >= 100) {
				$s_img .= '<img src="images/list_expert_icon.png" alt="荷兰旅游专家" align="absmiddle"/> ';
			}
			$a_date = explode ( " ", $o_table->getRegTime ( $i ) );
			$n_width = floor ( $o_table->getPercent ( $i ) * 60 / 100 );
			$s_list .= '
						<tr class="' . $s_class . '">
								<td>
                                    ' . $a_date [0] . '
                                </td>
                                <td>
									<div style="border:1px solid #999999;;width:60px;height:16px;">										
										<div style="background-color:#54C3F1; width:' . $n_width . 'px;height:16px;position:absolute">											
										</div>	
										<div style="position:absolute;width:60px;text-align:center;">' . $o_table->getPercent ( $i ) . '%</div>										
									</div>                                    
                                </td>
                                <td>
                                    ' . $s_img . $o_table->getName ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getSex ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getCompany ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getJob ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getPhone ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getEmail1 ( $i ) . '
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>微信用户列表：共' . $n_allcount . '人</div>  
                            <input class="subText" id="Vcl_Key" name="Vcl_Key" maxlength="200" value="" style="width: 200px;float:left" type="text" />
                            <div class="subButton" style="float:left" onclick="searchSubmit(\'student_wechat.php?\')">搜索</div>            
                            <div class="subButton" onclick="window.open(\'student_output.php?type=9&sleep=0\',\'_blank\')">信息导出</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td style="width:80px;">
                                    注册日期<img style="margin-left: 5px" src="images/sort_d.png" alt="" />
                                </td>
                                <td style="width:100px;">
                                    专家完成度
                                </td>
                                <td style="width:60px;">
                                    姓名
                                </td>
                                <td style="width:30px;">
                                    性别
                                </td>
                                <td>
                                    公司
                                </td>
                                <td>
                                    职务
                                </td>
                                <td>
                                    手机
                                </td>
                                <td>
                                    邮箱
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function StudentAll($n_page) {
		$this->S_FileName = 'student_all.php?type=' . $_GET ['type'] . '&sleep=' . $_GET ['sleep'] . '&key=' . $_GET ['key'] . '&';
		$this->N_Page = $n_page;
		return $this->StudentList ( $_GET ['type'], $_GET ['sleep'], $_GET ['key'] );
	}
	/*	public function StudentExpert($n_page) {
		$this->S_FileName = 'student_expert.php?';
		$this->N_Page = $n_page;
		return $this->StudentList ( 6 );
	}
	public function StudentExpertOld($n_page) {
		$this->S_FileName = 'student_expert_old.php?';
		$this->N_Page = $n_page;
		return $this->StudentList ( 4 );
	}
	public function StudentExpertNew($n_page) {
		$this->S_FileName = 'student_expert_new.php?';
		$this->N_Page = $n_page;
		return $this->StudentList ( 5 );
	}
	public function StudentNormal($n_page) {
		$this->S_FileName = 'student_normal.php?';
		$this->N_Page = $n_page;
		return $this->StudentList ( 3 );
	}
	public function StudentSleep($n_page) {
		$this->S_FileName = 'student_sleep.php?';
		$this->N_Page = $n_page;
		return $this->StudentList ( 0, 1 );
	}*/
	public function SystemNewsList($n_page) {
		$this->S_FileName = 'system_news.php?';
		$this->N_Page = $n_page;
		$o_table = new News ();
		$o_table->PushOrder ( array ('Date', 'D' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			if ($o_table->getState ( $i ) == 1) {
				$s_state = '<span class="green">启用</span>';
				$s_button = '<div title="禁用" class="disable" onclick="systemNewsState(\'禁用\',' . $o_table->getNewsId ( $i ) . ')"></div>';
			} else {
				$s_state = '<span class="red">禁用</span>';
				$s_button = '<div title="启用" class="enable" onclick="systemNewsState(\'启用\',' . $o_table->getNewsId ( $i ) . ')"></div>';
			}
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
                                <td>
                                    ' . $o_table->getDate ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    <a title="点击后预览资讯" href="' . RELATIVITY_PATH . 'news.php?newsid=' . $o_table->getNewsId ( $i ) . '" target="_blank">' . $o_table->getTitle ( $i ) . '</a>
                                </td>
                                <td>
                                    ' . $s_state . '&nbsp;
                                </td>
                                <td class="operate">
                                    <div title="删除" class="delete" onclick="systemNewsDelete(' . $o_table->getNewsId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'system_news_modify.php?newsid=' . $o_table->getNewsId ( $i ) . '\')">
                                    </div>
                                    ' . $s_button . '
                                </td>
                            </tr>
		';
		}
		//构建下拉列表
		$s_html = '
			    <div class="title">
                            <div>最新资讯列表：共' . $n_allcount . '条</div>                            
                            <div class="subButton" onclick="rightGoTo(\'system_news_add.php\')">发布资讯</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    发布日期<img style="margin-left: 5px" src="images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    资讯标题
                                </td>
                                <td>
                                    状态
                                </td>
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function SystemAdvertList($n_page) {
		$this->S_FileName = 'system_advert.php?';
		$this->N_Page = $n_page;
		$o_table = new Advert ();
		$o_table->PushWhere ( array ('&&', 'AdvertId', '<>', 1 ) );
		$o_table->PushWhere ( array ('&&', 'AdvertId', '<>', 2 ) );
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			if ($o_table->getState ( $i ) == 1) {
				$s_state = '<span class="green">启用</span>';
				$s_button = '<div title="禁用" class="disable" onclick="systemAdvertState(\'禁用\',' . $o_table->getAdvertId ( $i ) . ')"></div>';
			} else {
				$s_state = '<span class="red">禁用</span>';
				$s_button = '<div title="启用" class="enable" onclick="systemAdvertState(\'启用\',' . $o_table->getAdvertId ( $i ) . ')"></div>';
			}
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			//计算图片的高，宽
			if ($o_table->getSize ( $i ) == 1) {
				$n_width = 255;
				$n_height = 147;
				$s_size = '';
			}
			if ($o_table->getSize ( $i ) == 2) {
				$n_width = 468;
				$n_height = 147;
				$s_size = '';
			}
			if ($o_table->getSize ( $i ) == 3) {
				$n_width = 707;
				$n_height = 147;
				$s_size = '';
			}
			$n_width = floor ( $n_width * 0.5 );
			$n_height = floor ( $n_height * 0.5 );
			$s_open = '不弹出';
			if ($o_table->getOpen ( $i ) == 1) {
				$s_open = '弹出';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
                                <td>
                                    ' . $o_table->getNumber ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    <a title="点击后弹出广告相关页" href="' . $o_table->getUrl ( $i ) . '" target="_blank"><img style="width:' . $n_width . 'px;height:' . $n_height . 'px" src="' . $o_table->getOnout ( $i ) . '" alt="" /></a>
                                </td>
                                <td>
                                    ' . $o_table->getTitle ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    <img src="images/system_advert_size_' . $o_table->getSize ( $i ) . '.png" alt="" />&nbsp;
                                </td>
                                <td>
                                    ' . $s_open . '&nbsp;
                                </td>
                                <td>
                                    ' . $s_state . '&nbsp;
                                </td>
                                <td class="operate">
                                    <div title="删除" class="delete" onclick="systemAdvertDelete(' . $o_table->getAdvertId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'system_advert_modify.php?advertid=' . $o_table->getAdvertId ( $i ) . '\')">
                                    </div>
                                    ' . $s_button . '
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>广告列表：共' . $n_allcount . '条</div>                          
                            <div class="subButton" onclick="window.open(\'../../index.php\',\'_blank\')">效果预览</div>
                            <div class="subButton" onclick="rightGoTo(\'system_advert_add.php\')">添加广告</div>  
                            <div class="subButton" onclick="location.reload()">刷新</div>                          
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    显示顺序<img style="margin-left: 5px" src="images/sort_a.png" alt="" />
                                </td>
                                <td>
             	图片
                                </td>
                                <td>
                                    说明文字
                                </td>
                                <td>
                                    尺寸
                                </td>
                               <td>
                                   是否弹出
                                </td>
                                <td>
                                   状态
                                </td>
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function SystemPartnersList($n_page) {
		$this->S_FileName = 'system_partners.php?';
		$this->N_Page = $n_page;
		$o_table = new Partners ();
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			if ($o_table->getState ( $i ) == 1) {
				$s_state = '<span class="green">启用</span>';
				$s_button = '<div title="禁用" class="disable" onclick="systemPartnersState(\'禁用\',' . $o_table->getPartnerId ( $i ) . ')"></div>';
			} else {
				$s_state = '<span class="red">禁用</span>';
				$s_button = '<div title="启用" class="enable" onclick="systemPartnersState(\'启用\',' . $o_table->getPartnerId ( $i ) . ')"></div>';
			}
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
                                <td>
                                    ' . $o_table->getNumber ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    <a title="点击后弹出相关链接" href="' . $o_table->getUrl ( $i ) . '" target="_blank"><img style="" src="' . $o_table->getIcon ( $i ) . '" alt="" /></a>
                                </td>
                                <td>
                                    ' . $o_table->getTitle ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $s_state . '&nbsp;
                                </td>
                                <td class="operate">
                                    <div title="删除" class="delete" onclick="systemPartnersDelete(' . $o_table->getPartnerId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'system_partners_modify.php?partnerid=' . $o_table->getPartnerId ( $i ) . '\')">
                                    </div>
                                    ' . $s_button . '
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>合作伙伴列表：共' . $n_allcount . '个</div>
                            <div class="subButton" onclick="window.open(\'../../index.php\',\'_blank\')">效果预览</div>
                            <div class="subButton" onclick="rightGoTo(\'system_partners_add.php\')">添加</div>  
                            <div class="subButton" onclick="location.reload()">刷新</div>                            
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    显示顺序<img style="margin-left: 5px" src="images/sort_a.png" alt="" />
                                </td>
                                <td>
             	图片
                                </td>
                                <td>
                                    说明文字
                                </td>
                                <td>
                                   状态
                                </td>
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function SystemFocusList($n_page) {
		$this->S_FileName = 'system_focus.php?';
		$this->N_Page = $n_page;
		$o_table = new FocusPhoto ();
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			if ($o_table->getState ( $i ) == 1) {
				$s_state = '<span class="green">启用</span>';
				$s_button = '<div title="禁用" class="disable" onclick="systemFocusState(\'禁用\',' . $o_table->getPhotoId ( $i ) . ')"></div>';
			} else {
				$s_state = '<span class="red">禁用</span>';
				$s_button = '<div title="启用" class="enable" onclick="systemFocusState(\'启用\',' . $o_table->getPhotoId ( $i ) . ')"></div>';
			}
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
                                <td>
                                    ' . $o_table->getNumber ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    <img style="width:200px;height:88px" src="' . $o_table->getPath ( $i ) . '" alt="" /></a>
                                </td>
                                <td>
                                    ' . $o_table->getTitle ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $s_state . '&nbsp;
                                </td>
                                <td class="operate">
                                    <div title="删除" class="delete" onclick="systemFocusDelete(' . $o_table->getPhotoId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'system_focus_modify.php?photoid=' . $o_table->getPhotoId ( $i ) . '\')">
                                    </div>
                                    ' . $s_button . '
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>焦点图片列表：共' . $n_allcount . '个</div>
                            <div class="subButton" onclick="window.open(\'../../index.php\',\'_blank\')">效果预览</div>
                            <div class="subButton" onclick="rightGoTo(\'system_focus_add.php\')">添加图片</div>  
                            <div class="subButton" onclick="location.reload()">刷新</div>                            
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    显示顺序<img style="margin-left: 5px" src="images/sort_a.png" alt="" />
                                </td>
                                <td>
             	图片
                                </td>
                                <td>
                                  图片标题
                                </td>
                                <td>
                                   状态
                                </td>
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function SystemVantageList($n_page) {
		$this->S_FileName = 'system_vantage.php?';
		$this->N_Page = $n_page;
		$o_table = new VantagePhoto ();
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			if ($o_table->getState ( $i ) == 1) {
				$s_state = '<span class="green">启用</span>';
				$s_button = '<div title="禁用" class="disable" onclick="systemVantageState(\'禁用\',' . $o_table->getPhotoId ( $i ) . ')"></div>';
			} else {
				$s_state = '<span class="red">禁用</span>';
				$s_button = '<div title="启用" class="enable" onclick="systemVantageState(\'启用\',' . $o_table->getPhotoId ( $i ) . ')"></div>';
			}
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
                                <td>
                                    ' . $o_table->getNumber ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    <img style="width:200px;height:69px" src="' . $o_table->getPath ( $i ) . '" alt="" /></a>
                                </td>
                                <td>
                                    ' . $s_state . '&nbsp;
                                </td>
                                <td class="operate">
                                    <div title="删除" class="delete" onclick="systemVantageDelete(' . $o_table->getPhotoId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'system_vantage_modify.php?photoid=' . $o_table->getPhotoId ( $i ) . '\')">
                                    </div>
                                    ' . $s_button . '
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>焦点图片列表：共' . $n_allcount . '个</div>
                            <div class="subButton" onclick="rightGoTo(\'system_vantage_add.php\')">添加图片</div>  
                            <div class="subButton" onclick="location.reload()">刷新</div>                            
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    显示顺序<img style="margin-left: 5px" src="images/sort_a.png" alt="" />
                                </td>
                                <td>
             	图片
                                </td>
                                <td>
                                   状态
                                </td>
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function CourseTermList($n_page) {
		$this->S_FileName = 'course_term.php?';
		$this->N_Page = $n_page;
		$o_table = new Bank_Term ();
		$o_table->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$o_table->PushOrder ( array ('Date', 'D' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			if ($o_table->getState ( $i ) == 1) {
				$s_state = '<span class="green">当前试题</span>';
				$s_button = '<div title="修改" class="modify" onclick="rightGoTo(\'course_term_modify.php?termid=' . $o_table->getTermId ( $i ) . '\')"></div>';
			} else {
				$s_state = '<span class="red">预备试题</span>';
				$s_button = '
				<div title="删除" class="delete" onclick="courseTermDelete(' . $o_table->getTermId ( $i ) . ')"></div>
				<div title="修改" class="modify" onclick="rightGoTo(\'course_term_modify.php?termid=' . $o_table->getTermId ( $i ) . '\')"></div>
				<div title="发布学期" class="enable" onclick="rightGoTo(\'course_term_publish.php?termid=' . $o_table->getTermId ( $i ) . '\')"></div>';
			}
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$o_temp = new Bank_Chapter ();
			$o_temp->PushWhere ( array ('&&', 'State', '<>', 2 ) );
			$o_temp->PushWhere ( array ('&&', 'TermId', '=', $o_table->getTermId ( $i ) ) );
			$n_chapter_count = $o_temp->getAllCount ();
			$s_list .= '
						<tr class="' . $s_class . '">
                                <td>
                                    ' . $o_table->getDate ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    <a title="点击后预览" href="' . RELATIVITY_PATH . 'sub/student/chapter.php?termid=' . $o_table->getTermId ( $i ) . '" target="_blank">' . $o_table->getName ( $i ) . '</a>
                                </td>
                                <td>
                                    ' . $o_table->getEndDate ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $o_table->getExplain ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $n_chapter_count . '&nbsp;
                                </td>
                                <td>
                                    ' . $s_state . '&nbsp;
                                </td>
                                <td class="operate">' . $s_button . '
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>学期列表：共' . $n_allcount . '个</div>
                            <div class="subButton" onclick="rightGoTo(\'course_term_add.php\')">添加学期</div>
                            <div class="subButton" onclick="rightGoTo(\'course_search.php\')">搜索</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    创建日期<img style="margin-left: 5px" src="images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    学期名称
                                </td>
                                <td>
                                    结束日期
                                </td>
                                <td>
                                    说明
                                </td>
                                <td>
                                    章数量
                                </td>
                                <td>
                                    状态
                                </td>
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function CourseChapterList($n_page, $n_termid) {
		$this->S_FileName = 'course_chapter.php?termid=' . $n_termid . '&';
		$this->N_Page = $n_page;
		$o_table = new Bank_Chapter ();
		$o_table->PushWhere ( array ('&&', 'TermId', '=', $n_termid ) );
		$o_table->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			$s_img1 = '&nbsp;';
			if ($o_table->getRestudy ( $i ) == 1) {
				$s_img1 = '<img style="margin-left: 5px" src="images/ok.png" alt="" />';
			}
			$s_img2 = '&nbsp;';
			if ($o_table->getSendCredentials ( $i ) == 1) {
				$s_img2 = '<img style="margin-left: 5px" src="images/ok.png" alt="" />';
			}
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$o_temp = new Bank_Section ();
			$o_temp->PushWhere ( array ('&&', 'State', '<>', 2 ) );
			$o_temp->PushWhere ( array ('&&', 'ChapterId', '=', $o_table->getChapterId ( $i ) ) );
			$n_section_count = $o_temp->getAllCount ();
			if ($i == 0) {
				$n_up = 1;
			} else {
				$n_up = $i;
			}
			if (($i + 2) > $n_count) {
				$n_down = $n_count;
			} else {
				$n_down = $i + 2;
			}
			$s_list .= '
						<tr class="' . $s_class . '">
                                <td>
                                	
                                    <div class="number">' . $o_table->getNumber ( $i ) . '</div>
                                    <div class="updown">
                                    	<div class="up" onclick="courseChapterSetNumber(' . $o_table->getChapterId ( $i ) . ',' . $n_up . ')">
                                    	</div>
                                    	<div class="down" onclick="courseChapterSetNumber(' . $o_table->getChapterId ( $i ) . ',' . $n_down . ')">
                                    	</div>
                                    </div>
                                </td>
                                <td>
                                    <a title="点击后预览" href="' . RELATIVITY_PATH . 'sub/student/chapter.php?chapterid=' . $o_table->getChapterId ( $i ) . '" target="_blank">' . $o_table->getName ( $i ) . '</a>
                                </td>
                                <td>
                                    ' . $n_section_count . '
                                </td>
                                <td>
                                    ' . $s_img1 . '
                                </td>
                                <td>
                                    ' . $s_img2 . '
                                </td>
                                <td class="operate">
                                	<div title="删除" class="delete" onclick="courseChapterDelete(' . $o_table->getChapterId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'course_chapter_modify.php?chapterid=' . $o_table->getChapterId ( $i ) . '\')">
                                    </div>
                                    <div title="复制" class="copy" onclick="Dialog_Iframe(\'dialog/course_chapter_copy.php?chapterid=' . $o_table->getChapterId ( $i ) . '\',235,135,\'\',this)">
                                    </div>
                                    <div title="移动" class="move" onclick="Dialog_Iframe(\'dialog/course_chapter_move.php?chapterid=' . $o_table->getChapterId ( $i ) . '\',235,135,\'\',this)">
                                    </div>
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>章列表：共' . $n_allcount . '个</div>
                            <div class="subButton" onclick="rightGoTo(\'course_chapter_input.php?termid=' . $n_termid . '\')">从行程导入</div>
                            <div class="subButton" onclick="rightGoTo(\'course_chapter_add.php?termid=' . $n_termid . '\')">添加章</div>
                            <div class="subButton" onclick="location.reload()">刷新</div> 
                            <div class="subButton" onclick="rightGoTo(\'course_search.php\')">搜索</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    显示顺序<img style="margin-left: 5px" src="images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    章名称
                                </td>
                                <td>
                                    节数量
                                </td>
                                <td>
                                    专家重做
                                </td>
                                <td>
                                    单章专家
                                </td>
                                <td class="right_none" style="width:15%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function CourseSectionList($n_page, $s_chapterid) {
		$this->S_FileName = 'course_section.php?chapterid=' . $s_chapterid . '&';
		$this->N_Page = $n_page;
		$o_table = new Bank_Section ();
		$o_table->PushWhere ( array ('&&', 'ChapterId', '=', $s_chapterid ) );
		$o_table->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$o_table->PushOrder ( array ('Number', 'A' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$o_temp = new Bank_Subject ();
			$o_temp->PushWhere ( array ('&&', 'SectionId', '=', $o_table->getSectionId ( $i ) ) );
			$n_section_count = $o_temp->getAllCount ();
			if ($i == 0) {
				$n_up = 1;
			} else {
				$n_up = $i;
			}
			if (($i + 2) > $n_count) {
				$n_down = $n_count;
			} else {
				$n_down = $i + 2;
			}
			$s_alert = '';
			if ($o_table->getSubjectSum ( $i ) > $n_section_count) {
				$s_alert = ' class="alert"';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
                                <td>
                                	
                                    <div class="number">' . $o_table->getNumber ( $i ) . '</div>
                                    <div class="updown">
                                    	<div class="up" onclick="courseSectionSetNumber(' . $o_table->getSectionId ( $i ) . ',' . $n_up . ')">
                                    	</div>
                                    	<div class="down" onclick="courseSectionSetNumber(' . $o_table->getSectionId ( $i ) . ',' . $n_down . ')">
                                    	</div>
                                    </div>
                                </td>
                                <td>
                                    <a title="点击后预览" href="' . RELATIVITY_PATH . 'sub/student/chapter.php?sectionid=' . $o_table->getSectionId ( $i ) . '" target="_blank">' . $o_table->getTitle ( $i ) . '</a>
                                </td>
                                <td>
                                    ' . $n_section_count . '
                                </td>
                                <td' . $s_alert . '>
                                    ' . $o_table->getSubjectSum ( $i ) . '
                                </td>                                
                                <td>
                                    ' . $o_table->getTime ( $i ) . ' 分钟
                                </td>
                                <td>
                                    ' . $o_table->getRate ( $i ) . '%
                                </td>
                                <td>
                                    ' . $o_table->getVantage ( $i ) . ' 分
                                </td>
                                <td class="operate">
                                	<div title="删除" class="delete" onclick="courseSectionDelete(' . $o_table->getSectionId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'course_section_modify.php?sectionid=' . $o_table->getSectionId ( $i ) . '\')">
                                    </div>
                                    <div title="复制" class="copy" onclick="Dialog_Iframe(\'dialog/course_section_copy.php?sectionid=' . $o_table->getSectionId ( $i ) . '\',300,170,\'\',this)">
                                    </div>
                                    <div title="移动" class="move" onclick="Dialog_Iframe(\'dialog/course_section_move.php?sectionid=' . $o_table->getSectionId ( $i ) . '\',300,170,\'\',this)">
                                    </div>
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>节列表：共' . $n_allcount . '个</div>
                            <div class="subButton" onclick="rightGoTo(\'course_section_add.php?chapterid=' . $s_chapterid . '\')">添加节</div>
                            <div class="subButton" onclick="location.reload()">刷新</div> 
                            <div class="subButton" onclick="rightGoTo(\'course_search.php\')">搜索</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    显示顺序<img style="margin-left: 5px" src="images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    节名称
                                </td>                                
                                <td>
                                    题目总数
                                </td>
                                <td>
               	考试题数                     
                                </td>
                                <td>
                                   考试时长
                                </td>
                                <td>
                                    正确率
                                </td>
                                <td>
                                    奖励积分
                                </td>
                                <td class="right_none" style="width:15%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function CourseSubjectList($n_page, $s_sectionid) {
		$this->S_FileName = 'course_subject.php?sectionid=' . $s_sectionid . '&';
		$this->N_Page = $n_page;
		$o_table = new Bank_Subject ();
		$o_table->PushWhere ( array ('&&', 'SectionId', '=', $s_sectionid ) );
		$o_table->PushOrder ( array ('SubjectId', 'D' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$o_temp = new Bank_Option ();
			$o_temp->PushWhere ( array ('&&', 'SubjectId', '=', $o_table->getSubjectId ( $i ) ) );
			$n_subjcet_count = $o_temp->getAllCount ();
			$a_temp = explode ( "<1>", $o_table->getRightOption ( $i ) );
			$s_type = '';
			for($j = 0; $j < count ( $a_temp ); $j ++) {
				$s_type .= $a_temp [$j] . ' ';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
                                <td>
                                	' . ($i + 1) . '
                                </td>
                                <td>
                                    ' . $o_table->getContent ( $i ) . '
                                </td>
                                <td>
                                    ' . $n_subjcet_count . '
                                </td>
                                <td>
                                    ' . $s_type . ' 
                                </td>
                                <td class="operate">
                                	<div title="删除" class="delete" onclick="courseSubjectDelete(' . $o_table->getSubjectId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'course_subject_modify.php?subjectid=' . $o_table->getSubjectId ( $i ) . '\')">
                                    </div>
                                    <div title="复制" class="copy" onclick="Dialog_Iframe(\'dialog/course_subject_copy.php?subjectid=' . $o_table->getSubjectId ( $i ) . '\',300,205,\'\',this)">
                                    </div>
                                    <div title="移动" class="move" onclick="Dialog_Iframe(\'dialog/course_subject_move.php?subjectid=' . $o_table->getSubjectId ( $i ) . '\',300,205,\'\',this)">
                                    </div>
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>试题列表：共' . $n_allcount . '题</div>
                            <div class="subButton" onclick="rightGoTo(\'course_subject_add.php?sectionid=' . $s_sectionid . '\')">添加试题</div>
                            <div class="subButton" onclick="location.reload()">刷新</div> 
                            <div class="subButton" onclick="rightGoTo(\'course_search.php\')">搜索</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td style="width:50px">
                                    编号<img style="margin-left: 5px" src="images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    题目内容
                                </td>                                
                                <td style="width:60px">
                                    选项个数
                                </td>
                                <td style="width:60px">
                                    答案
                                </td>
                                <td class="right_none" style="width:15%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function GoodsCredential($n_page, $n_state = -1, $b_button = true) {
		$s_search = '';
		if ($b_button == false) {
			$this->S_FileName = 'credential_list.php?state=' . $n_state . '&key=' . $_GET ['key'] . '&';
			$s_search = 'credential_list.php?';
		} else {
			$this->S_FileName = 'goods_credential.php?state=' . $n_state . '&key=' . $_GET ['key'] . '&';
			$s_search = 'goods_credential.php?';
		}
		$this->N_Page = $n_page;
		$o_table = new Goods_Send ();
		if ($_GET ['key'] != "") {
			$o_table->PushWhere ( array ('&&', 'Name', 'LIKE', '%' . $_GET ['key'] . '%' ) );
		} else {
			if ($n_state >= 0) {
				$o_table->PushWhere ( array ('&&', 'State', '=', $n_state ) );
			}
		}
		$o_table->PushWhere ( array ('&&', 'State', '<>', 0 ) );
		$o_table->PushWhere ( array ('&&', 'Type', '=', 1 ) );
		$o_table->PushOrder ( array ('State', 'A' ) );
		$o_table->PushOrder ( array ('Date', 'D' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			$a_date = explode ( " ", $o_table->getDate ( $i ) );
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$s_img = '';
			if ($o_table->getState ( $i ) == 1) {
				$s_state = '<span class="red">等待审核</span>';
				$s_logistice = '无信息';
				$s_operate = '				
				<div title="审核通过" class="enable" onclick="goodsCredentialCheck(' . $o_table->getId ( $i ) . ')"></div>
							<div title="删除" class="delete" onclick="goodsCredentialDelete(' . $o_table->getId ( $i ) . ')"></div>
				';
			}
			if ($o_table->getState ( $i ) == 2) {
				$s_state = '<span class="blue">等待发货</span>';
				$s_logistice = '无信息';
				$s_operate = '<div title="进入发货页面" class="enable" onclick="rightGoTo(\'' . RELATIVITY_PATH . 'sub/ucenter/goods_credential_send.php?id=' . $o_table->getId ( $i ) . '\')"></div>';
			}
			if ($o_table->getState ( $i ) == 3) {
				$s_state = '<span class="green">已发货</span>';
				$s_logistice = $o_table->getLogistic ( $i ) . ' - ' . $o_table->getOrderNumber ( $i );
				$s_operate = '<div title="详细信息" class="info" onclick="rightGoTo(\'' . RELATIVITY_PATH . 'sub/ucenter/goods_credential_send_info.php?id=' . $o_table->getId ( $i ) . '\')"></div>';
			}
			$n_width = floor ( $o_table->getPercent ( $i ) * 60 / 100 );
			$s_list .= '
						<tr class="' . $s_class . '">
								<td>
                                    ' . $a_date [0] . '
                                </td>
                                <td>
                                    <a href="javascript:;" onclick="rightGoTo(\'' . RELATIVITY_PATH . 'sub/ucenter/student_info.php?uid=' . $o_table->getUid ( $i ) . '\')">' . $o_table->getName ( $i ) . '</a>
                                </td>
                                <td>
                                    ' . $o_table->getAddress ( $i ) . '
                                </td>
                                <td>
                                   ' . $o_table->getPostcode ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getPhone ( $i ) . '
                                </td>
                                <td>
                                    ' . $s_logistice . '
                                </td>
                                <td>
                                    ' . $s_state . '
                                </td>
                                <td class="operate" style="width:10%">
                                    
                                    ' . $s_operate . '
                                </td>
                            </tr>
		';
		}
		if ($n_state == - 1) {
			$s_title = '证书寄送申请';
		}
		if ($n_state == 1) {
			$s_title = '等待审核的证书寄送申请';
		}
		if ($n_state == 2) {
			$s_title = '等待发货的证书寄送申请';
		}
		if ($n_state == 3) {
			$s_title = '已经发货的证书寄送申请';
		}
		$s_button = '';
		if ($b_button) {
			$s_button = '
							<div class="subButton" onclick="window.open(\'goods_credential_output.php\',\'_blank\')">导出已发货</div>				
							<div class="subButton" onclick="rightGoTo(\'goods_credential.php?state=3\')">已发货</div>	
                            <div class="subButton" onclick="rightGoTo(\'goods_credential.php?state=2\')">等待发货</div>				
							<div class="subButton" onclick="rightGoTo(\'goods_credential.php?state=1\')">等待审核</div>
							<div class="subButton" onclick="rightGoTo(\'goods_credential.php?state=-1\')">所有记录</div>
			';
		}
		$s_html = '
			    <div class="title">
                            <div>' . $s_title . '：共' . $n_allcount . '人</div>  
                            <input class="subText" id="Vcl_Key" name="Vcl_Key" maxlength="200" value="" style="width: 200px;float:left" type="text" />
                            <div class="subButton" style="float:left" onclick="searchSubmit(\'' . $s_search . '\')">搜索</div>                        
							' . $s_button . '
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    提交日期<img style="margin-left: 5px" src="' . RELATIVITY_PATH . 'sub/ucenter/images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    收件人
                                </td>
                                <td>
                                  地址
                                </td>
                                <td>
                                    邮编
                                </td>
                                <td>
                                    电话
                                </td>
                                <td>
                                    快递信息
                                </td> 
                                <td>
                                   状态
                                </td>                               
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function GoodsInformationUse($n_page, $n_state = -1, $b_button = true) {
		if ($b_button == true) {
			$this->S_FileName = 'goods_information_use.php?state=' . $n_state . '&';
		} else {
			$this->S_FileName = 'information_list.php?state=' . $n_state . '&';
		}
		//$this->S_FileName = RELATIVITY_PATH.'sub/ucenter/goods_information_use.php?state=' . $n_state . '&';
		$this->N_Page = $n_page;
		$o_table = new View_Goods_Information ();
		if ($n_state >= 0) {
			$o_table->PushWhere ( array ('&&', 'State', '=', $n_state ) );
		}
		$o_table->PushWhere ( array ('&&', 'State', '<>', 0 ) );
		$o_table->PushWhere ( array ('&&', 'Type', '=', 3 ) );
		$o_table->PushOrder ( array ('State', 'A' ) );
		$o_table->PushOrder ( array ('Date', 'D' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			$a_date = explode ( " ", $o_table->getDate ( $i ) );
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$s_img = '';
			if ($o_table->getState ( $i ) == 1) {
				$s_state = '<span class="red">等待审核</span>';
				$s_logistice = '无信息';
				$s_operate = '				
				<div title="进入审核页面" class="enable" onclick="rightGoTo(\'goods_information_use_check.php?useid=' . $o_table->getId ( $i ) . '\')"></div>
							<div title="删除" class="delete" onclick="goodsInformationUseDelete(' . $o_table->getId ( $i ) . ')"></div>
				';
			}
			if ($o_table->getState ( $i ) == 2) {
				$s_state = '<span class="blue">等待发货</span>';
				$s_logistice = '无信息';
				$s_operate = '<div title="进入发货页面" class="enable" onclick="rightGoTo(\'' . RELATIVITY_PATH . 'sub/ucenter/goods_information_use_send.php?useid=' . $o_table->getId ( $i ) . '\')"></div>';
			}
			if ($o_table->getState ( $i ) == 3) {
				$s_state = '<span class="green">已发货</span>';
				$s_logistice = $o_table->getLogistic ( $i ) . ' - ' . $o_table->getOrderNumber ( $i );
				$s_operate = '<div title="详细信息" class="info" onclick="rightGoTo(\'' . RELATIVITY_PATH . 'sub/ucenter/goods_information_use_send_info.php?useid=' . $o_table->getId ( $i ) . '\')"></div>';
			}
			$n_width = floor ( $o_table->getPercent ( $i ) * 60 / 100 );
			$s_list .= '
						<tr class="' . $s_class . '">
								<td>
                                    ' . $a_date [0] . '
                                </td>
                                <td>
                                    <a href="javascript:;" onclick="rightGoTo(\'' . RELATIVITY_PATH . 'sub/ucenter/student_info.php?uid=' . $o_table->getUid ( $i ) . '\')">' . $o_table->getName ( $i ) . '</a>
                                </td>
                                <td>
                                    <img align="absmiddle" style="margin-left: 5px;width:32px;height:32px" src="' . $o_table->getPhoto ( $i ) . '" alt="" /> <span class="gray">' . $o_table->getInfoName ( $i ) . '</span>
                                </td>
                                <td>
                                    ' . $o_table->getSum ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getAddress ( $i ) . '
                                </td>
                                <td>
                                   ' . $o_table->getPostcode ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getPhone ( $i ) . '
                                </td>
                                <td>
                                    ' . $s_logistice . '
                                </td>
                                <td>
                                    ' . $s_state . '
                                </td>
                                <td class="operate" style="width:10%">
                                    
                                    ' . $s_operate . '
                                </td>
                            </tr>
		';
		}
		if ($n_state == - 1) {
			$s_title = '资料寄送申请';
		}
		if ($n_state == 1) {
			$s_title = '等待审核的资料寄送申请';
		}
		if ($n_state == 2) {
			$s_title = '等待发货的资料寄送申请';
		}
		if ($n_state == 3) {
			$s_title = '已经发货的资料寄送申请';
		}
		$s_button = '';
		if ($b_button) {
			$s_button = '
							<div class="subButton" onclick="window.open(\'goods_information_output.php\',\'_blank\')">导出已发货</div>
							<div class="subButton" onclick="rightGoTo(\'goods_information_use.php?state=3\')">已发货</div>	
                            <div class="subButton" onclick="rightGoTo(\'goods_information_use.php?state=2\')">等待发货</div>				
							<div class="subButton" onclick="rightGoTo(\'goods_information_use.php?state=1\')">等待审核</div>
							<div class="subButton" onclick="rightGoTo(\'goods_information_use.php?state=-1\')">所有记录</div>
			';
		}
		$s_html = '
			    <div class="title">
                            <div>' . $s_title . '：共' . $n_allcount . '人</div>
                            ' . $s_button . '
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    提交日期<img style="margin-left: 5px" src="' . RELATIVITY_PATH . 'sub/ucenter/images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    收件人
                                </td>
                                <td>
                                  资料
                                </td>
                                <td>
                                  数量
                                </td>
                                <td>
                                  地址
                                </td>
                                <td>
                                    邮编
                                </td>
                                <td>
                                    电话
                                </td>
                                <td>
                                    快递信息
                                </td> 
                                <td>
                                   状态
                                </td>                               
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function GoodsPrizeExchange($n_page, $n_state = -1, $b_button = true) {
		$s_search = '';
		if ($b_button == true) {
			$this->S_FileName = 'goods_prize_exchange.php?state=' . $n_state . '&key=' . $_GET ['key'] . '&';
			$s_search = 'goods_prize_exchange.php?';
		} else {
			$this->S_FileName = 'prize_list.php?state=' . $n_state . '&key=' . $_GET ['key'] . '&';
			$s_search = 'prize_list.php?';
		}
		$this->N_Page = $n_page;
		$o_table = new View_Goods_Prize ();
		if ($_GET ['key'] != "") {
			$o_table->PushWhere ( array ('&&', 'Name', 'LIKE', '%' . $_GET ['key'] . '%' ) );
		} else {
			if ($n_state >= 0) {
				$o_table->PushWhere ( array ('&&', 'State', '=', $n_state ) );
			}
		}
		$o_table->PushWhere ( array ('&&', 'State', '<>', 0 ) );
		$o_table->PushWhere ( array ('&&', 'Type', '=', 2 ) );
		$o_table->PushOrder ( array ('State', 'A' ) );
		$o_table->PushOrder ( array ('Date', 'D' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			$a_date = explode ( " ", $o_table->getDate ( $i ) );
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$s_img = '';
			if ($o_table->getState ( $i ) == 1) {
				$s_state = '<span class="red">等待审核</span>';
				$s_logistice = '无信息';
				$s_operate = '				
				<div title="审核通过" class="enable" onclick="goodsPrizeExchangeCheck(' . $o_table->getId ( $i ) . ')"></div>
				';
			}
			if ($o_table->getState ( $i ) == 2) {
				$s_state = '<span class="blue">等待发货</span>';
				$s_logistice = '无信息';
				$s_operate = '<div title="进入发货页面" class="enable" onclick="rightGoTo(\'' . RELATIVITY_PATH . 'sub/ucenter/goods_prize_exchange_send.php?exchangeid=' . $o_table->getId ( $i ) . '\')"></div>';
			}
			if ($o_table->getState ( $i ) == 3) {
				$s_state = '<span class="green">已发货</span>';
				$s_logistice = $o_table->getLogistic ( $i ) . ' - ' . $o_table->getOrderNumber ( $i );
				$s_operate = '<div title="详细信息" class="info" onclick="rightGoTo(\'' . RELATIVITY_PATH . 'sub/ucenter/goods_prize_exchange_send_info.php?exchangeid=' . $o_table->getId ( $i ) . '\')"></div>';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
								<td>
                                    ' . $a_date [0] . '
                                </td>
                                <td>
                                    <a href="javascript:;" onclick="rightGoTo(\'' . RELATIVITY_PATH . 'sub/ucenter/student_info.php?uid=' . $o_table->getUid ( $i ) . '\')">' . $o_table->getName ( $i ) . '</a>
                                </td>
                                <td>
                                    <img align="absmiddle" style="margin-left: 5px;width:32px;height:32px" src="' . $o_table->getPhoto ( $i ) . '" alt="" /> <span class="gray">' . $o_table->getPrizeName ( $i ) . '</span>
                                </td>
                                <td>
                                    ' . $o_table->getSum ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getAddress ( $i ) . '
                                </td>
                                <td>
                                   ' . $o_table->getPostcode ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getPhone ( $i ) . '
                                </td>
                                <td>
                                    ' . $s_logistice . '
                                </td>
                                <td>
                                    ' . $s_state . '
                                </td>
                                <td class="operate" style="width:10%">
                                    
                                    ' . $s_operate . '
                                </td>
                            </tr>
		';
		}
		if ($n_state == - 1) {
			$s_title = '奖品兑换';
		}
		if ($n_state == 1) {
			$s_title = '等待审核的奖品兑换';
		}
		if ($n_state == 2) {
			$s_title = '等待发货的奖品兑换';
		}
		if ($n_state == 3) {
			$s_title = '已经发货的奖品兑换';
		}
		$s_button = '';
		if ($b_button) {
			$s_button = '
							<div class="subButton" onclick="window.open(\'goods_prize_output.php\',\'_blank\')">导出已发货</div>
							<div class="subButton" onclick="rightGoTo(\'goods_prize_exchange.php?state=3\')">已发货</div>	
                            <div class="subButton" onclick="rightGoTo(\'goods_prize_exchange.php?state=2\')">等待发货</div>				
							<div class="subButton" onclick="rightGoTo(\'goods_prize_exchange.php?state=1\')">等待审核</div>
							<div class="subButton" onclick="rightGoTo(\'goods_prize_exchange.php?state=-1\')">所有记录</div>
			';
		}
		$s_html = '
			    <div class="title">
                            <div>' . $s_title . '：共' . $n_allcount . '人</div>
                            <input class="subText" id="Vcl_Key" name="Vcl_Key" maxlength="200" value="" style="width: 200px;float:left" type="text" />
                            <div class="subButton" style="float:left" onclick="searchSubmit(\'' . $s_search . '\')">搜索</div> 
                            ' . $s_button . '
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    提交日期<img style="margin-left: 5px" src="' . RELATIVITY_PATH . 'sub/ucenter/images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    收件人
                                </td>
                                <td>
                                  奖品
                                </td>
                                <td>
                                  数量
                                </td>
                                <td>
                                  地址
                                </td>
                                <td>
                                    邮编
                                </td>
                                <td>
                                    电话
                                </td>
                                <td>
                                    快递信息
                                </td> 
                                <td>
                                   状态
                                </td>                               
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function GoodsSendList($n_page, $n_state = -1, $b_button = true, $filename = 'goods_send.php') {
		if ($b_button == true) {
			$this->S_FileName = $filename . '?state=' . $n_state . '&';
		} else {
			$this->S_FileName = 'prize_list.php?state=' . $n_state . '&';
		}
		$this->N_Page = $n_page;
		$o_table = new Goods_Send ();
		$n_count_all = $o_table->GetRecordAllCount ();
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count_all) {
			$this->N_Page = ceil ( $n_count_all / $this->N_PageSize );
			$n_yu = $n_count_all % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_count = $o_table->GetRecordCount ();
		$s_pagebutton = $this->getPageButtom ( $n_count_all, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			$o_user = new User ( $o_table->GetRecordUid ( $i ) );
			$a_date = explode ( " ", $o_table->getDate ( $i ) );
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$o_temp = new Goods_Send (); //统计证书
			//$o_temp->PushWhere ( array ('&&', 'State', '=', 1 ) );
			//$o_temp->PushWhere ( array ('&&', 'Type', '=', 1 ) );
			//$o_temp->PushWhere ( array ('&&', 'Uid', '=',$o_user->getUid() ) );
			$o_temp->PushWhere ( array ('||', 'State', '=', 2 ) );
			$o_temp->PushWhere ( array ('&&', 'Type', '=', 1 ) );
			$o_temp->PushWhere ( array ('&&', 'Uid', '=', $o_user->getUid () ) );
			$n_1 = $o_temp->getAllCount ();
			$o_temp = new Goods_Send (); //统计奖品
			//$o_temp->PushWhere ( array ('&&', 'State', '=', 1 ) );
			//$o_temp->PushWhere ( array ('&&', 'Type', '=', 2 ) );
			//$o_temp->PushWhere ( array ('&&', 'Uid', '=',$o_user->getUid() ) );
			$o_temp->PushWhere ( array ('||', 'State', '=', 2 ) );
			$o_temp->PushWhere ( array ('&&', 'Type', '=', 2 ) );
			$o_temp->PushWhere ( array ('&&', 'Uid', '=', $o_user->getUid () ) );
			$n_2 = $o_temp->getAllCount ();
			$o_temp = new Goods_Send (); //统计资料
			//$o_temp->PushWhere ( array ('&&', 'State', '=', 1 ) );
			//$o_temp->PushWhere ( array ('&&', 'Type', '=', 3 ) );
			//$o_temp->PushWhere ( array ('&&', 'Uid', '=',$o_user->getUid() ) );
			$o_temp->PushWhere ( array ('||', 'State', '=', 2 ) );
			$o_temp->PushWhere ( array ('&&', 'Type', '=', 3 ) );
			$o_temp->PushWhere ( array ('&&', 'Uid', '=', $o_user->getUid () ) );
			$n_3 = $o_temp->getAllCount ();
			$s_list .= '
						<tr class="' . $s_class . '">
								<td>
                                    ' . $o_user->getUserName () . '
                                </td>
                                <td>
                                    ' . $o_user->getName () . '
                                </td>
                                <td>
                                    ' . $n_1 . '
                                </td>
                                <td>
                                    ' . $n_2 . '
                                </td>
                                <td>
                                   ' . $n_3 . '
                                </td>                                
                                <td>
                                   <span class="blue">等待发货</span>
                                </td>
                                <td class="operate" style="width:10%">                                    
                                    <div title="进入发货页面" class="enable" onclick="rightGoTo(\'' . RELATIVITY_PATH . 'sub/ucenter/goods_send_start.php?uid=' . $o_table->GetRecordUid ( $i ) . '\')"></div>
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>批量寄送：共' . $n_count_all . '人</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    用户名
                                </td>
                                <td>
                                    姓名
                                </td>
                                <td>
                                  证书
                                </td>
                                <td>
                                  奖品
                                </td>
                                <td>
                                  宣传资料
                                </td>
                                <td>
                                   状态
                                </td>                               
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function GoodsPrize($n_page) {
		$this->S_FileName = 'goods_prize.php?';
		$this->N_Page = $n_page;
		$o_table = new Prize ();
		$o_table->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$o_table->PushOrder ( array ('PrizeId', 'D' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			$a_date = explode ( " ", $o_table->getDate ( $i ) );
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$s_img1 = '';
			if ($o_table->getIsExpert ( $i ) == 1) {
				$s_img1 = '<img style="margin-left: 5px" src="images/ok.png" alt="" />';
			}
			$s_img2 = '';
			if ($o_table->getChapterId ( $i ) > 0) {
				$o_temp = new Bank_Chapter ( $o_table->getChapterId ( $i ) );
				$s_img2 = $o_temp->getCredentialsName ();
			}
			if ($o_table->getState ( $i ) == 1) {
				$s_state = '<span class="green">启用</span>';
				$s_button = '<div title="禁用" class="disable" onclick="goodsPrizeState(\'禁用\',' . $o_table->getPrizeId ( $i ) . ')"></div>';
			} else {
				$s_state = '<span class="red">禁用</span>';
				$s_button = '<div title="启用" class="enable" onclick="goodsPrizeState(\'启用\',' . $o_table->getPrizeId ( $i ) . ')"></div>';
			}
			$s_alert = '';
			if ($o_table->getSum ( $i ) < $o_table->getRemSum ( $i )) {
				$s_alert = ' class="alert"';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
								<td>
                                    <img align="absmiddle" style="margin-left: 5px;width:32px;height:32px" src="' . $o_table->getPhoto ( $i ) . '" alt="" />
                                </td>
								<td>
                                    ' . $o_table->getName ( $i ) . '
                                </td>                                
                                <td>
                                    ' . $o_table->getVantage ( $i ) . '
                                </td>
                                <td>
                                    ' . $s_img1 . '&nbsp;
                                </td>
                                <td>
                                   ' . $s_img2 . '&nbsp;
                                </td>
                                <td' . $s_alert . '>
                                   ' . $o_table->getSum ( $i ) . '
                                </td>
                                <td>
                                    ' . $s_state . '
                                </td>
                                <td class="operate" style="width:10%">
									<div title="删除" class="delete" onclick="goodsPrizeDelete(' . $o_table->getPrizeId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'goods_prize_modify.php?prizeid=' . $o_table->getPrizeId ( $i ) . '\')">
                                    </div>
                                    ' . $s_button . '
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>奖品列表：共' . $n_allcount . '个</div>
                            <div class="subButton" onclick="window.open(\'' . RELATIVITY_PATH . 'sub/student/prize.php\',\'_blank\')">预览</div>
                            <div class="subButton" onclick="rightGoTo(\'goods_prize_add.php\')">添加奖品</div>
                            <div class="subButton" onclick="location.reload()">刷新</div> 
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">                                
                                <td>
                                    图片
                                </td>
                                <td>
                                    奖品名称
                                </td>
                                <td>
                                  所需积分
                                </td>
                                <td>
                                  专家奖品
                                </td>
                                <td>
                                  专项专家奖品
                                </td>
                                <td>
                                  库存
                                </td>
                                <td>
                                   状态
                                </td>                               
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function GoodsInformation($n_page) {
		$this->S_FileName = 'goods_information.php?';
		$this->N_Page = $n_page;
		$o_table = new Information ();
		$o_table->PushWhere ( array ('&&', 'State', '<>', 2 ) );
		$o_table->PushOrder ( array ('InformationId', 'D' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			$a_date = explode ( " ", $o_table->getDate ( $i ) );
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			if ($o_table->getState ( $i ) == 1) {
				$s_state = '<span class="green">启用</span>';
				$s_button = '<div title="禁用" class="disable" onclick="goodsInformationState(\'禁用\',' . $o_table->getInformationId ( $i ) . ')"></div>';
			} else {
				$s_state = '<span class="red">禁用</span>';
				$s_button = '<div title="启用" class="enable" onclick="goodsInformationState(\'启用\',' . $o_table->getInformationId ( $i ) . ')"></div>';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
								<td>
                                    <img align="absmiddle" style="margin-left: 5px;width:32px;height:32px" src="' . $o_table->getPhoto ( $i ) . '" alt="" />
                                </td>
								<td>
                                    ' . $o_table->getName ( $i ) . '
                                </td>     
                                <td>
                                    ' . $o_table->getSum ( $i ) . '
                                </td>                            
                                <td>
                                    ' . $s_state . '
                                </td>
                                <td class="operate" style="width:10%">
									<div title="删除" class="delete" onclick="goodsInformationDelete(' . $o_table->getInformationId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'goods_information_modify.php?informationid=' . $o_table->getInformationId ( $i ) . '\')">
                                    </div>
                                    ' . $s_button . '
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>资料列表：共' . $n_allcount . '个</div>
                            <div class="subButton" onclick="window.open(\'' . RELATIVITY_PATH . 'sub/student/prize.php\',\'_blank\')">预览</div>
                            <div class="subButton" onclick="rightGoTo(\'goods_information_add.php\')">添加资料</div>
                            <div class="subButton" onclick="location.reload()">刷新</div> 
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">                                
                                <td>
                                    图片
                                </td>
                                <td>
                                    资料名称
                                </td>   
                                <td>
                                    领用数量
                                </td>                              
                                <td>
                                   状态
                                </td>                               
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function StudentMail($n_page) {
		$this->S_FileName = 'student_mail.php?';
		$this->N_Page = $n_page;
		$o_table = new MailRecord ();
		$o_table->PushOrder ( array ('Date', 'D' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			if ($o_table->getState ( $i ) == 1) {
				$s_state = '<span class="green">启用</span>';
				$s_button = '<div title="禁用" class="disable" onclick="systemNewsState(\'禁用\',' . $o_table->getNewsId ( $i ) . ')"></div>';
			} else {
				$s_state = '<span class="red">禁用</span>';
				$s_button = '<div title="启用" class="enable" onclick="systemNewsState(\'启用\',' . $o_table->getNewsId ( $i ) . ')"></div>';
			}
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
                                <td>
                                    ' . $o_table->getDate ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    <a title="点击后查看邮件正文" href="student_mail_show.php?id=' . $o_table->getId ( $i ) . '" target="_blank">' . $o_table->getTitle ( $i ) . '</a>
                                </td>
                                <td>
                                    ' . $o_table->getUserName ( $i ) . '&nbsp;
                                </td>                                
                                <td>
                                    ' . $o_table->getType ( $i ) . '&nbsp;
                                </td>
                                <td class="operate">
                                    <div title="导出Execl" class="modify" onclick="window.open(\'student_mail_output.php?id=' . $o_table->getId ( $i ) . '\',\'_blank\')">
                                    </div>
                                    <div title="查看邮件正文" class="enable" onclick="window.open(\'student_mail_show.php?id=' . $o_table->getId ( $i ) . '\',\'_blank\')"></div>
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>群发邮件记录：共' . $n_allcount . '条</div>
                            <div class="subButton" onclick="location=\'student_sendmail.php\'">群发邮件</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    发送日期<img style="margin-left: 5px" src="images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    标题
                                </td>
                                <td>
                                    操作人
                                </td>                                
                                <td>
                                    发送对象
                                </td>
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
	public function StudentTravel($n_page,$s_key) {
		$this->S_FileName = 'student_travel.php?key='.$s_key.'&';
		$this->N_Page = $n_page;
		$o_table = new User ();
		if ($s_key != '') {
			$o_table->PushWhere ( array ('&&', 'Name', 'LIKE', '%' . $s_key . '%' ) );
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'travel' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
			$o_table->PushWhere ( array ('||', 'UserName', 'LIKE', '%' . $s_key . '%' ) );
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'travel' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
			$o_table->PushWhere ( array ('||', 'Company', 'LIKE', '%' . $s_key . '%' ) );
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'travel' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		} else {
			$o_table->PushWhere ( array ('&&', 'Checked', '=', 1 ) );
			$o_table->PushWhere ( array ('&&', 'ComeFrom', '=', 'travel' ) );
			$o_table->PushWhere ( array ('&&', 'Type', '>=', 3 ) );
		}
		$o_table->PushOrder ( array ('UserName', 'D' ) );
		$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize ); //起始记录
		$o_table->setCountLine ( $this->N_PageSize );
		$n_count = $o_table->getAllCount ();
		if (($this->N_PageSize * ($this->N_Page - 1)) >= $n_count) {
			$this->N_Page = ceil ( $n_count / $this->N_PageSize );
			$n_yu = $n_count % $this->N_PageSize;
			$o_table->setStartLine ( ($this->N_Page - 1) * $this->N_PageSize );
			$o_table->setCountLine ( $this->N_PageSize );
		}
		$n_allcount = $o_table->getAllCount ();
		$n_count = $o_table->getCount ();
		$s_pagebutton = $this->getPageButtom ( $n_allcount, $this->N_PageSize, $this->N_Page );
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$a_date = explode ( " ", $o_table->getRegTime ( $i ) );
			$s_list .= '
						<tr class="' . $s_class . '">
								<td>
                                    ' . $a_date [0] . '
                                </td>
                                <td>
                                    ' . $o_table->getUserName ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getName ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getSex ( $i ) . '
                                </td>
                                <td>
                                   ' . $o_table->getBirthday ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getCompany ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getDept ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getJob ( $i ) . '
                                </td>
                                <td>
                                    ' . $o_table->getPhone ( $i ) . '
                                </td>
                                <td class="operate" style="width:10%">
                                    <div title="删除" class="delete" onclick="studentDelete(' . $o_table->getUid ( $i ) . ')">
                                    </div>
                                    <div title="详细信息" class="info" onclick="rightGoTo(\'student_info.php?uid=' . $o_table->getUid ( $i ) . '\')">
                                    </div>
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>大众用户列表：共' . $n_allcount . '人</div>  
                            <input class="subText" id="Vcl_Key" name="Vcl_Key" maxlength="200" value="" style="width: 200px;float:left" type="text" />
                            <div class="subButton" style="float:left" onclick="searchSubmit(\'student_travel.php?\')">搜索</div>            
                            <div class="subButton" onclick="window.open(\'student_output.php?type=8&sleep=0\',\'_blank\')">信息导出</div>
                            <div class="subButton" onclick="location=\'student_sendmail.php?come_from=travel\'">群发邮件</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td style="width:80px;">
                                    注册日期<img style="margin-left: 5px" src="images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    用户名
                                </td>
                                <td style="width:60px;">
                                    姓名
                                </td>
                                <td style="width:30px;">
                                    性别
                                </td>
                                <td style="width:80px;">
                                    出生日期
                                </td>
                                <td>
                                    公司
                                </td>
                                <td>
                                    部门
                                </td>
                                <td>
                                    职务
                                </td>
                                <td>
                                    手机
                                </td>
                                <td class="right_none" style="width:10%">
                                    操作
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}
}

?>
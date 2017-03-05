<?php
require_once RELATIVITY_PATH . 'include/db_view.class.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
//require_once RELATIVITY_PATH . 'include/bn_user.class.php';
require_once RELATIVITY_PATH . 'include/it_basic.class.php';
class ShowPage extends It_Basic {
	private $O_SingleUser;
	
	public function __construct($o_singleUser = NULL) {
		$this->O_SingleUser = $o_singleUser;
		$this->N_PageSize =25;
	}
	public function CityList($n_page) {
		$this->S_FileName = 'city_list.php?';
		$this->N_Page = $n_page;
		$o_table = new Library_City ();
		$o_table->PushOrder ( array ('Name', 'A' ) );
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
			//查询酒店数
			$o_temp=new Library_Hotel();
			$o_temp->PushWhere ( array ('&&', 'CityId', '=', $o_table->getCityId($i) ) );
			$n_hotel=$o_temp->getAllCount(); 
			$o_temp=new Library_Region();
			$o_temp->PushWhere ( array ('&&', 'CityId', '=', $o_table->getCityId($i) ) );
			$n_region=$o_temp->getAllCount();
			$s_list .= '
						<tr class="'.$s_class.'">
                                <td>
                                    ' . $o_table->getName ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $n_region . '&nbsp;
                                </td>
                                <td class="operate">
                                    <div title="删除" class="delete" onclick="cityDelete(' . $o_table->getCityId ( $i ) . ','.$n_hotel.','.$n_region.')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'city_modify.php?id=' . $o_table->getCityId ( $i ) . '\')">
                                    </div>
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>资料库中的城市：共' . $n_allcount . '个</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    城市名称<img style="margin-left: 5px" src="images/sort_a.png" alt="" />
                                </td>
                                <td style="width:80px">
                                   拥有资料数
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
	public function HotelList($n_page,$s_key) {
		$this->S_FileName = 'hotel_list.php?cityid='.$_GET['cityid'].'&key=' . $s_key . '&';
		$this->N_Page = $n_page;
		$o_table = new View_Library_Hotel (); 
		if ($s_key != '') {
			$o_table->PushWhere ( array ('&&', 'Name', 'LIKE', '%' .$s_key. '%' ) );
			$o_table->PushWhere ( array ('||', 'Content', 'LIKE', '%' . $s_key . '%' ) );
			$o_table->PushWhere ( array ('||', 'CityName', 'LIKE', '%' . $s_key . '%' ) );	
		} else {
			if ($_GET['cityid']>0)
			{
				$o_table->PushWhere ( array ('&&', 'CityId', '=', $_GET['cityid'] ) );
			}
		}
		$o_table->PushOrder ( array ('CityName', 'A' ) );
		$o_table->PushOrder ( array ('Name', 'A' ) );
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
			//查询酒店数
			$s_list .= '
						<tr class="'.$s_class.'">
                                <td>
                                    ' . $o_table->getName ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $o_table->getCityName ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    $ ' . $o_table->getPrice ( $i ) . '&nbsp;
                                </td>
                                <td class="operate">
                                    <div title="删除" class="delete" onclick="hotelDelete(' . $o_table->getHotelId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'hotel_modify.php?id=' . $o_table->getHotelId ( $i ) . '\')">
                                    </div>
                                </td>
                            </tr>
		';
		}
		$s_city='<option value="0">全部城市</option>';
		//构建城市下拉列表
		$o_city=new Library_City();
		$o_city->PushOrder ( array ('Name', 'A' ) );
		$n_count=$o_city->getAllCount();
		for($i=0;$i<$n_count;$i++)
		{
			if ($_GET['cityid']==$o_city->getCityId($i))
			{
				$s_city.='<option value="'.$o_city->getCityId($i).'" selected="seclected">'.$o_city->getName($i).'</option>';
			}else{
				$s_city.='<option value="'.$o_city->getCityId($i).'">'.$o_city->getName($i).'</option>';
			}
		}
		$o_option='';
		$s_html = '
			    <div class="title">
                            <div>资料库中的酒店：共' . $n_allcount . '个</div> 
                            <div style="margin-left:50px;margin-top:7px">
                            <select id="city" style="margin:0px;width:auto;font-size:14px;height:30px;font-family:微软雅黑;" onchange="selectCity(this)">
                            	'.$s_city.'
                            </select>
                            </div>
                            <input class="subText" id="Vcl_Key" name="Vcl_Key" maxlength="200" value="" style="width: 200px;float:left" type="text" />
                            <div class="subButton" style="float:left" onclick="searchSubmit(\'hotel_list.php?\')">搜索</div> 
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    酒店名称<img style="margin-left: 5px" src="images/sort_a.png" alt="" />
                                </td>
                                <td>
                                    所在城市
                                </td>
                                <td>
                                    价格(天)
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
	public function RegionList($n_page, $s_key) {
		$this->S_FileName = 'region_list.php?cityid='.$_GET['cityid'].'&typeid='.$_GET['typeid'].'&key=' . $s_key . '&';
		$this->N_Page = $n_page;
		$o_table = new View_Library_Region (); 
		if ($s_key != '') {
			$o_table->PushWhere ( array ('&&', 'Name', 'LIKE', '%' .$s_key. '%' ) );
			$o_table->PushWhere ( array ('||', 'Content', 'LIKE', '%' . $s_key . '%' ) );
			$o_table->PushWhere ( array ('||', 'CityName', 'LIKE', '%' . $s_key . '%' ) );
			$o_table->PushWhere ( array ('||', 'Key', 'LIKE', '%' . $s_key . '%' ) );
		} else {
			if ($_GET['cityid']>0)
			{
				$o_table->PushWhere ( array ('&&', 'CityId', '=', $_GET['cityid'] ) );
			}
			if ($_GET['typeid']>0)
			{
				$o_table->PushWhere ( array ('&&', 'TypeId', '=', $_GET['typeid'] ) );
			}
		}
		$o_table->PushOrder ( array ('TypeId', 'A' ) );
		$o_table->PushOrder ( array ('CityName', 'A' ) );
		$o_table->PushOrder ( array ('Name', 'A' ) );
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
			$o_image=new Library_Region_Photo();
			$o_image->PushWhere ( array ('&&', 'RegionId', '=', $o_table->getRegionId ( $i ) ) );
			$o_image->PushOrder ( array ('Number', 'A' ) );
			//查询酒店数
			$s_list .= '
						<tr class="'.$s_class.'">
								<td>
                                    ' . $o_table->getTypeName ( $i ) . '&nbsp;
                                </td>                                
                                <td>
                                    ' . $o_table->getCityName ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $o_table->getName ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    € ' . $o_table->getPrice ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    共 ' .$o_image->getAllCount() . ' 张&nbsp; <a href="region_photo.php?id=' . $o_table->getRegionId ( $i ) . '" style="color:green">编辑</a>
                                </td>
                                <td class="operate">
                                    <div title="删除" class="delete" onclick="regionDelete(' . $o_table->getRegionId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'region_modify.php?id=' . $o_table->getRegionId ( $i ) . '\')">
                                    </div>
                                </td>
                            </tr>
		';
		}
		$s_city='<option value="0">全部城市</option>';
		//构建城市下拉列表
		$o_city=new Library_City();
		$o_city->PushOrder ( array ('Name', 'A' ) );
		$n_count=$o_city->getAllCount();
		for($i=0;$i<$n_count;$i++)
		{
			if ($_GET['cityid']==$o_city->getCityId($i))
			{
				$s_city.='<option value="'.$o_city->getCityId($i).'" selected="seclected">'.$o_city->getName($i).'</option>';
			}else{
				$s_city.='<option value="'.$o_city->getCityId($i).'">'.$o_city->getName($i).'</option>';
			}
		}
		//构建类型下拉列表
		$s_type='<option value="0">全部类型</option>';
		$o_type=new Library_Region_Type();
		$o_type->PushOrder ( array ('Name', 'A' ) );
		$n_count=$o_type->getAllCount();
		for($i=0;$i<$n_count;$i++)
		{
			if ($_GET['typeid']==$o_type->getTypeId($i))
			{
				$s_type.='<option value="'.$o_type->getTypeId($i).'" selected="seclected">'.$o_type->getName($i).'</option>';
			}else{
				$s_type.='<option value="'.$o_type->getTypeId($i).'">'.$o_type->getName($i).'</option>';
			}
		}
		$o_option='';
		$s_html = '
			    <div class="title">
                            <div>资料库：共' . $n_allcount . '个</div> 
                            <div style="margin-left:50px;margin-top:7px">
                            <select id="type" style="margin:0px;width:auto;font-size:14px;height:27px;font-family:微软雅黑;" onchange="selectCity()">
                            	'.$s_type.'
                            </select>
                            </div>
                            <div style="margin-left:10px;margin-top:7px">
                            <select id="city" style="margin:0px;width:auto;font-size:14px;height:27px;font-family:微软雅黑;" onchange="selectCity()">
                            	'.$s_city.'
                            </select>
                            </div>
                            <input class="subText" id="Vcl_Key" name="Vcl_Key" maxlength="200" value="" style="width: 200px;float:left" type="text" />
                            <div class="subButton" style="float:left" onclick="searchSubmit(\'region_list.php?\')">搜索</div> 
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                            	<td>
                                    类型<img style="margin-left: 5px" src="images/sort_a.png" alt="" />
                                </td>                                
                                <td>
                                    所在城市
                                </td>
                                <td>
                                    资料名称
                                </td>
                                <td>
                                    价格(天)
                                </td>
                                <td>
                                    图片
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
	public function RegionPhoto() {
		$o_table = new Library_Region_Photo (); 
		$o_table->PushWhere ( array ('&&', 'RegionId', '=', $_GET['id'] ) );
		$o_table->PushOrder ( array ('Id', 'D' ) );
		$n_count = $o_table->getAllCount ();
		//获取部门名称
		for($i = 0; $i < $n_count; $i ++) { //按条数循环显示
			//查询酒店数
			$s_list .= '
					<div style="float:left;width:150px;height:107px;margin-left:5px;margin-top:5px">
					<div style="margin-left:125px;padding:5px;float:right;position:fixed;"><a style="color:red" href="javascript:;" onclick="regionPhotoDelete('.$o_table->getId($i).')"><img src="images/close.png" alt=""/></a></div>
                                  <a href="'.RELATIVITY_PATH.$o_table->getImage($i).'" target="_blank"><img style="width:150px;height:107px;" src="'.RELATIVITY_PATH.$o_table->getIcon($i).'" alt="" /></a>
                                  
                    </div>	
		';
		}
		$o_option='';
		$s_html = '
			    <div class="title">
                            <div>图片：共' . $n_count . '个</div> 
                            <div class="subButton2" onclick="location=\'region_list.php\'">返回</div>
                        </div>
                </div>
                <div>
                '.$s_list.'
                        <div style="float:left;width:150px;height:107px;margin-left:5px;margin-top:5px">
                                  <a href="region_photo_add.php?id=' . $_GET['id'] . '"><img src="images/addphoto.jpg" alt="" /></a>
                                  </div>
                </div>
		';
		return $s_html;
	}	
	public function TravelTitleList($n_page) {
		$this->S_FileName = 'travel_title.php?typeid='.$_GET['typeid'].'&';
		$this->N_Page = $n_page;
		$o_table = new View_Travel_Title ();
		if ($_GET['typeid']>0)
		{
			$o_table->PushWhere ( array ('&&', 'TypeId', '=', $_GET['typeid'] ) );
		}
		$o_table->PushWhere ( array ('&&', 'State', '=', 1 ) );
		$o_table->PushOrder ( array ('TypeId', 'A' ) );
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
			$s_button = '
			<div title="删除" class="delete" onclick="travelTitleDelete(' . $o_table->getTitleId ( $i ) . ')"></div>
			<div title="修改" class="modify" onclick="rightGoTo(\'travel_title_modify.php?titleid=' . $o_table->getTitleId ( $i ) . '\')"></div>';
			$s_class = 'bright';
			if (abs ( $i % 2 ) == 0) {
				$s_class = 'dark';
			}
			$s_list .= '
						<tr class="' . $s_class . '">
								<td>
                                    ' . $o_table->getTypeName ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $o_table->getDate ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    <a title="点击后预览" href="' . RELATIVITY_PATH . 'sub/travel/content.php?id=' . $o_table->getTitleId ( $i ) . '" target="_blank">' . $o_table->getName ( $i ) . '</a>
                                </td>
                                <td>
                                    ' . $o_table->getVisit ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $o_table->getDownload ( $i ) . '&nbsp;
                                </td>
                                <td class="operate">' . $s_button . '
                                </td>
                            </tr>
		';
		}
		$s_type='<option value="0">&nbsp;&nbsp;全部分类&nbsp;&nbsp;</option>';
		//构建城市下拉列表
		$o_type=new Travel_Type();
		$o_type->PushOrder ( array ('Number', 'A' ) );
		$n_count=$o_type->getAllCount();
		for($i=0;$i<$n_count;$i++)
		{
			if ($_GET['typeid']==$o_type->getTypeId($i))
			{
				$s_type.='<option value="'.$o_type->getTypeId($i).'" selected="seclected">&nbsp;&nbsp;'.$o_type->getName($i).'&nbsp;&nbsp;</option>';
			}else{
				$s_type.='<option value="'.$o_type->getTypeId($i).'">&nbsp;&nbsp;'.$o_type->getName($i).'&nbsp;&nbsp;</option>';
			}
		}
		$s_html = '
			    <div class="title">
                            <div>精彩行程线路：共' . $n_allcount . '个</div>
                            <div style="margin-left:50px;margin-top:7px">
                            <select id="type" style="margin:0px;width:auto;font-size:14px;height:27px;font-family:微软雅黑;" onchange="selectType()">
                            	'.$s_type.'
                            </select>
                            </div>
                            <div class="subButton" onclick="rightGoTo(\'travel_title_add.php\')">添加行程线路</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                            	<td>
                                    分类名称<img style="margin-left: 5px" src="images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    创建日期
                                </td>
                                <td>
                                    行程线路名称
                                </td>
                                <td>
                                    浏览数
                                </td>
                                <td>
                                    下载数
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
	public function TravelItemList($n_page, $n_termid) {
		$this->S_FileName = 'travel_item.php?titleid=' . $n_termid . '&';
		$this->N_Page = $n_page;
		$o_table = new Travel_Item ();
		$o_table->PushWhere ( array ('&&', 'TitleId', '=', $n_termid ) );
		$o_table->PushWhere ( array ('&&', 'State', '=', 1 ) );
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
                                    	<div class="up" onclick="travelItemSetNumber(' . $o_table->getItemId ( $i ) . ',' . $n_up . ')">
                                    	</div>
                                    	<div class="down" onclick="travelItemSetNumber(' . $o_table->getItemId ( $i ) . ',' . $n_down . ')">
                                    	</div>
                                    </div>
                                </td>
                                <td>
                                    <a title="点击后预览" href="' . RELATIVITY_PATH . 'sub/travel/content.php?id=' . $n_termid . '" target="_blank">' . $o_table->getName ( $i ) . '</a>
                                </td>
                                <td class="operate">
                                	<div title="删除" class="delete" onclick="travelItemDelete(' . $o_table->getItemId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'travel_item_modify.php?itemid=' . $o_table->getItemId ( $i ) . '\')">
                                    </div>
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>分站表：共' . $n_allcount . '个</div>
                            <div class="subButton" onclick="rightGoTo(\'travel_item_add.php?titleid=' . $n_termid . '\')">添加分站</div>
                            <div class="subButton" onclick="location.reload()">刷新</div> 
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    显示顺序<img style="margin-left: 5px" src="images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    分站名称
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
	public function TravelDetailList($n_page, $n_termid) {
		$this->S_FileName = 'travel_detail.php?itemid=' . $n_termid . '&';
		$this->N_Page = $n_page;
		$o_table = new Travel_Detail ();
		$o_table->PushWhere ( array ('&&', 'ItemId', '=', $n_termid ) );
		$o_table->PushOrder ( array ('StartHour', 'A' ) );
		$o_table->PushOrder ( array ('StartMin', 'A' ) );
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
			//获取景区名称和所在城市
			$o_city=new Library_City($o_table->getCityId ( $i ));
			$o_region=new View_Library_Region($o_table->getRegionId ( $i ));
			$s_list .= '
						<tr class="' . $s_class . '">
                                <td>
                                	<a title="点击后预览" href="' . RELATIVITY_PATH . 'sub/library/travel_detail_show.php?detailid=' . $o_table->getDetailId ( $i ) . '">' . $o_table->getStartHour ( $i ) . ' : '.$o_table->getStartMin ( $i ).'&nbsp;</a>
                                </td>
                                <td>
                                	<a title="点击后预览" href="' . RELATIVITY_PATH . 'sub/library/travel_detail_show.php?detailid=' . $o_table->getDetailId ( $i ) . '">' . $o_table->getEndHour ( $i ) . ' : '.$o_table->getEndMin ( $i ).'&nbsp;</a>
                                </td>
                                <td>
                                	' . $o_region->getTypeName () . '&nbsp;
                                </td>
                                <td>
                                	' . $o_city->getName () . '&nbsp;
                                </td>
                                <td>
                                	' . $o_region->getName () . '&nbsp;
                                </td>                                
                                <td class="operate">
                                	<div title="删除" class="delete" onclick="travelDetailDelete(' . $o_table->getDetailId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'travel_detail_modify.php?detailid=' . $o_table->getDetailId ( $i ) . '\')">
                                    </div>
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>时间段：共' . $n_allcount . '个</div>
                            <div class="subButton" onclick="rightGoTo(\'travel_detail_add.php?itemid=' . $n_termid . '\')">添加时间段</div>
                            <div class="subButton" onclick="location.reload()">刷新</div> 
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    开始时间<img style="margin-left: 5px" src="images/sort_d.png" alt="" />
                                </td>
                                <td>
                                    结束时间
                                </td>
                                <td>
                                    类型
                                </td>
                                <td>
                                    城市
                                </td>                                
                                <td>
                                    目的地
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
	public function Visitor($n_page) {
		$this->S_FileName = 'visitor_list.php?titleid='.$_GET['titleid'].'&';
		$this->N_Page = $n_page;
		$o_table = new View_Travel_Visitor (); 
		if ($_GET['titleid']>0)
		{
			$o_table->PushWhere ( array ('&&', 'TitleId', '=', $_GET['titleid'] ) );
		}
		$o_table->PushOrder ( array ('Name', 'A' ) );
		$o_table->PushOrder ( array ('Email', 'A' ) );		
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
			//查询酒店数
			$s_list .= '
						<tr class="'.$s_class.'">
                                <td>
                                    ' . $o_table->getEmail ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $o_table->getName ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $o_table->getPhone ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $o_table->getDate ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $o_table->getSum ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $o_table->getIp ( $i ) . '&nbsp;
                                </td>
                            </tr>
		';
		}
		$s_city='<option value="0">全部行程</option>';
		//构建城市下拉列表
		$o_title=new Travel_Title();
		$o_title->PushWhere ( array ('&&', 'State', '=',1) );
		$o_title->PushOrder ( array ('Name', 'A' ) );
		$n_count=$o_title->getAllCount();
		for($i=0;$i<$n_count;$i++)
		{
			if ($_GET['titleid']==$o_title->getTitleId($i))
			{
				$s_city.='<option value="'.$o_title->getTitleId($i).'" selected="seclected">'.$o_title->getName($i).'</option>';
			}else{
				$s_city.='<option value="'.$o_title->getTitleId($i).'">'.$o_title->getName($i).'</option>';
			}
		}
		$o_option='';
		$s_html = '
			    		<div class="title">
                            <div>下载人数：共' . $n_allcount . '人</div> 
                            <div style="margin-left:50px">
                            <select id="city" style="width:auto" onchange="selectCity(this)">
                            	'.$s_city.'
                            </select>
                            </div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                                <td>
                                    E-mail<img style="margin-left: 5px" src="images/sort_a.png" alt="" />
                                </td>
                                <td>
                                   下载内容
                                </td>
                                <td>
                                    手机
                                </td>
                                <td>
                                    下载时间
                                </td>
                                <td>
                                    次数
                                </td>
                                <td>
              IP地址
                                </td>
                            </tr>
                            ' . $s_list . '                        
                        </table>
                        ' . $s_pagebutton . '
		';
		return $s_html;
	}		
	public function TravelTypeList($n_page) {
		$this->S_FileName = 'travel_type_list.php?';
		$this->N_Page = $n_page;
		$o_table = new View_Travel_Type();
		$o_table->PushWhere ( array ('&&', 'Delete', '=',0) );
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
			if ($o_table->getPhoto ( $i )=='')
			{
				$s_img='<a style="color:red" href="javascript:;" onclick="rightGoTo(\'travel_type_modify.php?id=' . $o_table->getTypeId ( $i ) . '\')">上传图片</span>';
			}else{
				$s_img='<img style="width:300px;height:130px" src="'.$o_table->getPhoto ( $i ) .'" alt="" />';
			}
			if ($o_table->getTitleName ( $i )=='')
			{
				$s_name='<a style="color:red" href="javascript:;" onclick="rightGoTo(\'travel_type_modify.php?id=' . $o_table->getTypeId ( $i ) . '\')">设置推荐行程</span>';
			}else{
				$s_name= $o_table->getTitleName ( $i );
			}
			if($o_table->getState ( $i )==1)
			{
				$s_open='<span class="green">是</span>';
			}else{
				$s_open='<span class="red">否</span>';
			}
			$s_list .= '
						<tr class="'.$s_class.'">
								<td>
                                    ' . $o_table->getNumber ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    ' . $o_table->getName ( $i ) . '&nbsp;
                                </td>
                                <td>
                                    '.$s_img.'
                                </td>
                                <td>
                                    ' . $s_name . '&nbsp;
                                </td>
                                 <td>
                                    ' . $s_open . '&nbsp;
                                </td>
                                <td class="operate">
                                    <div title="删除" class="delete" onclick="travelTypeDelete(' . $o_table->getTypeId ( $i ) . ')">
                                    </div>
                                    <div title="修改" class="modify" onclick="rightGoTo(\'travel_type_modify.php?id=' . $o_table->getTypeId ( $i ) . '\')">
                                    </div>
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>行程分类：共' . $n_allcount . '个</div>
                        </div>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr class="item">
                            	<td style="width:80px">
                                    顺序<img style="margin-left: 5px" src="images/sort_a.png" alt="" />
                                </td>
                                <td style="width:100px">
                                    分类名称
                                </td>
                                <td style="width:80px">
                                   宣传图
                                </td>
                                <td>
                                  推荐行程名称
                                </td>
                                <td>
                                 是否公开
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
	public function AdvertList($n_page) {
		$this->S_FileName = 'advert_list.php?';
		$this->N_Page = $n_page;
		$o_table = new Travel_Advert(); 
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
                                    <a title="点击后弹出广告相关页" href="' . $o_table->getUrl ( $i ) . '" target="_blank"><img style="width:127px;height:73px" src="' . $o_table->getOnout ( $i ) . '" alt="" /></a>
                                </td>
                                <td>
                                    ' . $o_table->getTitle ( $i ) . '&nbsp;
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
                                    <div title="修改" class="modify" onclick="rightGoTo(\'advert_modify.php?advertid=' . $o_table->getAdvertId ( $i ) . '\')">
                                    </div>
                                    ' . $s_button . '
                                </td>
                            </tr>
		';
		}
		$s_html = '
			    <div class="title">
                            <div>广告列表：共' . $n_allcount . '条</div>                          
                            <div class="subButton" onclick="window.open(\'../../sub/travel/index.php\',\'_blank\')">效果预览</div>
                            <div class="subButton" onclick="rightGoTo(\'advert_add.php\')">添加广告</div>  
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

}

?>
<?php
require_once RELATIVITY_PATH . 'include/bn_basic.class.php';
class It_Basic extends Bn_Basic {
	protected $N_Page;
	protected $N_PageSize;
	protected $S_FileName;
	public function CutStr($string, $length) {
		preg_match_all ( "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $info );
		for($i = 0; $i < count ( $info [0] ); $i ++) {
			$wordscut .= $info [0] [$i];
			$j = ord ( $info [0] [$i] ) > 127 ? $j + 2 : $j + 1;
			if ($j > $length - 3) {
				return $wordscut . "...";
			}
		}
		return join ( '', $info [0] );
	}
	protected function getFilesize($n_filesize) {
		if ($n_filesize >= (1024 * 1024)) {
			$n_filesize = $n_filesize / (1024 * 1024);
			$n_filesize = round ( $n_filesize, 2 );
			return $n_filesize . ' G';
		} else if ($n_filesize > (1024)) {
			$n_filesize = $n_filesize / 1024;
			$n_filesize = round ( $n_filesize, 2 );
			return $n_filesize . ' MB';
		} else {
			return $n_filesize . ' KB';
		}
	
	}
	protected function SearchResultAddRed($s_text, $a_key) {
		$s_text2 = '';
		$n_start = stripos ( $s_text, '<' );
		if ($n_start === false) {
			$s_text = $this->CutStr ( $s_text, 200 );
			for($i = 0; $i < count ( $a_key ); $i ++) {
				$s_text = $this->TextHighLight ( $s_text, $a_key [$i] );
			}
			return $s_text;
		}
		$n_start = 0;
		do {
			$n_count = strlen ( $s_text );
			$n_start = stripos ( $s_text, '<' );
			$n_end = stripos ( $s_text, '>' );
			if (! ($n_start === false)) {
				$s_text2 = $s_text2 . substr ( $s_text, 0, $n_start );
				$n_count = $n_count - $n_end;
				$s_text = substr ( $s_text, $n_end + 1, $n_count );
			}
		} while ( ! ($n_start === false) && strlen ( $s_text2 ) < 200 );
		$s_text = $this->CutStr ( $s_text2, 200 );
		for($i = 0; $i < count ( $a_key ); $i ++) {
			$s_text = $this->TextHighLight ( $s_text, $a_key [$i] );
		}
		return $s_text;
		;
	}
	protected function TextHighLight($s_text, $s_key) {
		$s_text = rawurlencode ( $s_text );
		$s_key = rawurlencode ( $s_key );
		if (isset ( $s_key ) && $s_key != '') {
			$a_text = explode ( $s_key, $s_text );
			$n_start = 0;
			$n_end = 0;
			$s_result = $a_text [0];
			for($i = 1; $i < count ( $a_text ); $i ++) {
				$n_start = stripos ( $a_text [$i], '<' );
				$n_end = stripos ( $a_text [$i], '>' );
				if ($n_end === false || ($n_start < $n_end && $n_start >= 0)) {
					$s_result .= '<span style="color:red">' . $s_key . '</span>' . $a_text [$i];
				} else {
					$s_result .= $s_key . $a_text [$i];
				}
			}
		} else {
			$s_result = $s_text;
		}
		return rawurldecode ( $s_result );
	
		//return rawurldecode($s_result);
	}
	protected function getPageButtom($n_all_count, $n_page_size = 30, $n_page = 1) {
		if (fmod ( $n_all_count, $n_page_size ) == 0) {
			$n_page_count = floor ( $n_all_count / $n_page_size );
		} else {
			$n_page_count = floor ( $n_all_count / $n_page_size ) + 1;
		}
		if ($n_page_count==1)
		{
			return '';
		}
		$s_pagebutton = '<div class="page">';
		//显示向上十页
		$n_temp_page=1;
		if($n_page-10>0)
		{
			$n_temp_page=$n_page-10;
		}
		$s_pagebutton .='<div class="prev10" title="向上10页" onclick="parent.parent.Common_OpenLoading();location=\''.$this->S_FileName.'page='.$n_temp_page.'\'"></div>';
		//显示向上一页
		if($n_page-1>0)
		{
			$n_temp_page=$n_page-1;
		}else{
			$n_temp_page=1;
		}
		$s_pagebutton .='<div class="prev" title="上一页" onclick="parent.parent.Common_OpenLoading();location=\''.$this->S_FileName.'page='.$n_temp_page.'\'"></div>';
		
		//显示1到10页的数字
		$n_temp=floor ( $n_page_count / 10 )+1;
		for ($i=0;$i<$n_temp;$i++)
		{
			if ($n_page>($i*10) && $n_page<=(($i+1)*10))
			{
				//说明在这个区间，然后循环显示页数
				for($j=1;$j<=10;$j++)
				{	
					if ((($i*10)+$j)>$n_page_count)		
					{
						break;
					}
					$s_class='';
					if ((($i*10)+$j)==$n_page)
					{
						$s_class=' on';
					}		
					$s_pagebutton .='<div class="but'.$s_class.'" onclick="parent.parent.Common_OpenLoading();location=\''.$this->S_FileName.'page='.(($i*10)+$j).'\'">'.(($i*10)+$j).'</div>';
				}
			}
		}
		
		
		
		
		//显示向下一页
		if($n_page+1>$n_page_count)
		{
			$n_temp_page=$n_page_count;
		}else{
			$n_temp_page=$n_page+1;
		}
		$s_pagebutton .='<div class="next" title="下一页" onclick="parent.parent.Common_OpenLoading();location=\''.$this->S_FileName.'page='.$n_temp_page.'\'"></div>';
		//显示向下10页
		if($n_page+10>$n_page_count)
		{
			$n_temp_page=$n_page_count;
		}else{
			$n_temp_page=$n_page+10;
		}
		$s_pagebutton .='<div class="next10" title="下10页" onclick="parent.parent.Common_OpenLoading();location=\''.$this->S_FileName.'page='.$n_temp_page.'\'"></div>';
		/*
		$s_pagebutton .= '<div class="pageArea">第<span class="pageNumber"> ' . $n_page . ' / ' . $n_page_count . ' </span>页&nbsp;&nbsp;';
		if ($n_page > 1) {
			$s_pagebutton .= '<a href="' . $this->S_FileName . 'page=1" class="pageFirst" title="首页"></a>';
		} else {
			$s_pagebutton .= '<a class="pageFirstDisable"></a>';
		}
		if ($n_page > 1) {
			$s_pagebutton .= '<a href="' . $this->S_FileName . 'page=' . ($n_page - 1) . '" class="pagePrevious" title="上一页"></a>';
		} else {
			$s_pagebutton .= '<a class="pagePreviousDisable"></a>';
		}
		if ($n_page < $n_page_count) {
			$s_pagebutton .= '<a href="' . $this->S_FileName . 'page=' . ($n_page + 1) . '" class="pageNext" title="下一页"></a>';
		} else {
			$s_pagebutton .= '<a class="pageNextDisable"></a>';
		}
		if ($n_page < $n_page_count) {
			$s_pagebutton .= '<a href="' . $this->S_FileName . 'page=' . ($n_page_count) . '" id="pageLast" class="pageLast" title="末页"></a>';
		} else {
			$s_pagebutton .= '<a class="pageLastDisable"></a>';
		}
		if ($n_page_count > 1) {
			$s_pagebutton .= '转到 第 <input id="gopage" size="2" maxlength="3" class="SmallInput" style="text-align: center;" type="text"> 页 <a href="javascript:goToPage(\'' . $this->S_FileName . '\',\'gopage\');" class="pageGoto" title="转到"></a>';
		}*/
		$s_pagebutton .= '</div>';
		return $s_pagebutton;
	}
	protected function returnNoRecord($s_icon, $s_text) {
		return '
					<table class="small" border="0" cellpadding="3" cellspacing="0" width="100%">
						  <tbody><tr>
						    <td class="Big" style="padding-left:20px">' . $s_icon . '<br>
						    </td>
						  </tr>
						</tbody>
					</table>
					<br/>
					<table class="MessageBox" align="center" width="350">
						   <tbody><tr class="head-no-title">
						      <td class="left"></td>
						      <td class="center">
						      </td>
						      <td class="right"></td>
						   </tr>
						   <tr class="msg">
						      <td class="left"></td>
						      <td class="center info">
						         <div class="msg-content">' . $s_text . '</div>
						      </td>
						      <td class="right"></td>
						   </tr>
						   <tr class="foot">
						      <td class="left"></td>
						      <td class="center"></td>
						      <td class="right"></td>
						   </tr>
						</tbody>
					</table>
		';
	}
	public function fixMobileContent($str)
	{
		$str=str_replace('width', 'widdt', $str);
		$str=str_replace('height', 'heee', $str);
		return $str;
	}
}
?>
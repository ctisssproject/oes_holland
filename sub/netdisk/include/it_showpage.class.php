<?php
require_once RELATIVITY_PATH . 'include/db_view.class.php';
require_once RELATIVITY_PATH . 'include/db_table.class.php';
require_once RELATIVITY_PATH . 'include/bn_user.class.php';
require_once RELATIVITY_PATH . 'include/it_basic.class.php';
class ShowPage extends It_Basic {
	protected $O_SingleUser;
	
	public function __construct($o_singleUser) {
		$this->O_SingleUser = $o_singleUser;
		
		$this->N_PageSize = 20;
	}
	public function getTotalSpace() {
		$o_space = new Netdisk_Space ( 1 );
		return $this->getFilesize ( $o_space->getTotal () );
	}
	public function getFreeSpace() {
		$o_space = new Netdisk_Space ( 1 );
		return $this->getFilesize ( $o_space->getFree () );
	}
	public function getMyDiskRoot() {
		$o_tree = new Netdisk_Folder ();
		$o_tree->PushWhere ( array ('&&', 'Delete', '=', 0 ) );
		$o_tree->PushWhere ( array ('&&', 'ParentId', '=', 0 ) );
		$o_tree->PushOrder ( array ('FolderName', 'A' ) );
		$n_count = $o_tree->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$html .= '                  <li style="margin-top:4px">
                                            <span class="dynatree-node dynatree-folder dynatree-expanded dynatree-has-children dynatree-exp-e dynatree-ico-ef"><img align="absmiddle" src="images/plus.gif" alt="" onclick="openPath(this,' . $o_tree->getFolderId ( $i ) . ')" /><img align="absmiddle" src="images/notify_open.gif" alt=""/><a id="path_' . $o_tree->getFolderId ( $i ) . '" href="javascript:;" title="' . $o_tree->getFolderName ( $i ) . '" style=" font-weight:normal" ondblclick="openPath(this,' . $o_tree->getFolderId ( $i ) . ')" onclick="nameAddBold(this);goTo(\'explorer.php?folderid=' . $o_tree->getFolderId ( $i ) . '\');document.getElementById(\'Vcl_FolderId\').value=' . $o_tree->getFolderId ( $i ) . ';">
                                                    	' . $o_tree->getFolderName ( $i ) . '
                                                </a><img align="absmiddle" src="images/loading.gif" alt="" style="display:none"/></span>                                            
                                        </li>
                                        ';
		
		}
		if ($n_count > 0) {
			$html = '<ul>' . $html . '</ul>';
		}
		return '             <ul class="dynatree-container" style="margin-bottom:10px; padding:0px">
                                <li>
                                    <span class="dynatree-node dynatree-folder dynatree-expanded dynatree-has-children dynatree-exp-e dynatree-ico-ef">
                                        <img src="images/root.png" alt="" align="absmiddle" style="width:32px; height:32px; display:none"/>
                                        <img src="images/root.png" alt="" align="absmiddle" style="width:32px; height:32px"/>
                                        <a href="javascript:;" title="网盘"  id="path_0" style="font-size:14px; margin-top:5px;font-family:微软雅黑;" ondblclick="openPath(this,-1)" onclick="nameAddBold(this);goTo(\'explorer.php?folderid=0\');">网盘
                                        </a>
                                        <img src="images/loading.gif" alt="" align="absmiddle" style="display:none"/>
                                    </span>
                                    ' . $html . '
                                </li>
                            </ul>';
	}
	
	public function getRecycleFileList() {
		$o_tree = new Netdisk_Folder ();
		$o_tree->PushWhere ( array ('&&', 'Delete', '=', 1 ) );
		$o_tree->PushOrder ( array ('FolderName', 'A' ) );
		$n_count = $o_tree->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$html .= '                   <tr onmouseover="showButton(this)" onmouseout="hideButton(this)" onclick="selected(this)" class="off">
								            <td style="width:20px" class="off">
								                <input id="folder_' . ($i + 1) . '" value="' . $o_tree->getFolderId ( $i ) . '" type="checkbox" onclick="selectedForCheck(this)"/>
								            </td>
								            <td style="width:32px" class="icon">
								                <div class="icon"><div class="img folder"></div><div></div></div>
								            </td>
								            <td>
								            ' . $o_tree->getFolderName ( $i ) . '<span style="color:#999999">&nbsp;&nbsp;&nbsp;&nbsp;目录：' . str_replace ( '/', '\\', $o_tree->getOriginalPath ( $i ) ) . '</span>
								            </td>
								            <td style="width:100px">
								               <div><a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);reduction( ' . $o_tree->getFolderId ( $i ) . ',1);">还原</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);realDeleteFolder(' . $o_tree->getFolderId ( $i ) . ');">删除</a></div>
								            </td>
								            <td style="width:90px">
								               
								            </td>
								            <td style="width:90px">
								                ' . $o_tree->getDate ( $i ) . '
								            </td>
								            <td style="width:80px">
								                ' . $o_tree->getDeleteDate ( $i ) . '
								            </td>
								        </tr>';
		
		}
		$o_file = new View_Netdisk_File ();
		$o_file->PushWhere ( array ('&&', 'Delete', '=', 1 ) );
		$o_file->PushOrder ( array ('Filename', 'A' ) );
		$n_count = $o_file->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$s_filesize = $o_file->getFilesize ( $i );
			$s_filesize = $this->getFilesize ( $s_filesize );
			$s_icon = '<div class="img ' . $o_file->getClassName ( $i ) . '"></div>';
			if ($o_file->getClassName ( $i ) == 'image') {
				$s_dbclick = 'ondblclick="window.open(\'' . $o_file->getPath ( $i ) . '/' . $o_file->getOriginalFilename ( $i ) . '\',\'_blank\');selected(this.parentNode.parentNode);"';
				$s_icon = '<div><img src="' . $o_file->getPath ( $i ) . '/' . $o_file->getOriginalFilename ( $i ) . '" alt="" align="absmiddle" style="width:120px; height:50px"/></div>';
				$s_width = ' style="width:120px;height:50px"';
				$html .= '                   <tr onmouseover="showButton(this)" onmouseout="hideButton(this)" onclick="selected(this)" class="off">
								            <td style="width:20px" class="off">
								                <input id="file_' . ($i + 1) . '" value="' . $o_file->getFileId ( $i ) . '" type="checkbox" onclick="selectedForCheck(this)"/>
								            </td>
								            <td colspan="2" ' . $s_dbclick . '>
								                <div class="icon" style="display:none">' . $s_icon . '<div></div></div>
								            <img src="' . $o_file->getPath ( $i ) . '/' . $o_file->getOriginalFilename ( $i ) . '" alt="" align="absmiddle" style="max-width:120px;max-height:90px;margin-top:2px;margin-bottom:2px"/>
								            ' . $o_file->getFilename ( $i ) . '<span style="color:#999999">&nbsp;&nbsp;&nbsp;&nbsp;目录：' . str_replace ( '/', '\\', $o_file->getOriginalPath ( $i ) ) . '</span>
								            </td>
								            <td style="width:100px">
												<div><a href="' . RELATIVITY_PATH . 'sub/service/download.php?fileid=' . $o_file->getFileId ( $i ) . '" onclick="selected(this.parentNode.parentNode.parentNode)" target="_blank">下载</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);reduction( ' . $o_file->getFileId ( $i ) . ',0);">还原</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);realDeleteFile( ' . $o_file->getFileId ( $i ) . ');">删除</a></div>
								            </td>
								            <td style="width:90px">
								               ' . $s_filesize . '
								            </td>
								            <td style="width:90px">
								                ' . $o_file->getDate ( $i ) . '
								            </td>
								            <td style="width:80px">
								                ' . $o_file->getDeleteDate ( $i ) . '
								            </td>
								        </tr>';
			} else {
				$s_dbclick = 'ondblclick="window.open(\'' . RELATIVITY_PATH . 'sub/service/download.php?fileid=' . $o_file->getFileId ( $i ) . '\',\'\',\'_blank\');selected(this.parentNode.parentNode);"';
				$html .= '                   <tr onmouseover="showButton(this)" onmouseout="hideButton(this)" onclick="selected(this)" class="off">
								            <td style="width:20px" class="off">
								                <input id="file_' . ($i + 1) . '" value="' . $o_file->getFileId ( $i ) . '" type="checkbox" onclick="selectedForCheck(this)"/>
								            </td>
								            <td style="widit:32px" ondblclick="window.open(\'' . RELATIVITY_PATH . 'sub/service/download.php?fileid=' . $o_file->getFileId ( $i ) . '\',\'\',\'_blank\');selected(this.parentNode.parentNode);">
								                <div class="icon">' . $s_icon . '<div></div></div>
								            </td>
								            <td>								         
								            ' . $o_file->getFilename ( $i ) . '<span style="color:#999999">&nbsp;&nbsp;&nbsp;&nbsp;目录：' . str_replace ( '/', '\\', $o_file->getOriginalPath ( $i ) ) . '</span>
								            </td>
								            <td style="width:160px">
								            <div><a href="' . RELATIVITY_PATH . 'sub/service/download.php?fileid=' . $o_file->getFileId ( $i ) . '" onclick="selected(this.parentNode.parentNode.parentNode)" target="_blank">下载</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);reduction( ' . $o_file->getFileId ( $i ) . ',0);">还原</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);realDeleteFile( ' . $o_file->getFileId ( $i ) . ');">删除</a></div>   
								            </td>
								            <td style="width:90px">
								               ' . $s_filesize . '
								            </td>
								            <td style="width:90px">
								                ' . $o_file->getDate ( $i ) . '
								            </td>
								            <td style="width:80px">
								                ' . $o_file->getDeleteDate ( $i ) . '
								            </td>
								        </tr>';
			}		
		}
		return $html;
	}
	public function getMyDiskFileList($n_folderid) {
		$o_tree = new Netdisk_Folder ();
		$o_tree->PushWhere ( array ('&&', 'Delete', '=', 0 ) );
		$o_tree->PushWhere ( array ('&&', 'ParentId', '=', $n_folderid ) );
		$o_tree->PushOrder ( array ('FolderName', 'A' ) );
		$n_count = $o_tree->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$s_share = '';
			$html .= '                   <tr onmouseover="showButton(this)" onmouseout="hideButton(this)" onclick="selected(this)" class="off">
								            <td style="width:20px" class="off">
								                <input id="folder_' . ($i + 1) . '" value="' . $o_tree->getFolderId ( $i ) . '" type="checkbox" onclick="selectedForCheck(this)"/>
								            </td>
								            <td class="icon">
								                <div class="icon" style="float:left;" onclick="selected(this.parentNode.parentNode)" ondblclick="goIn(' . $o_tree->getParentId ( $i ) . ',' . $o_tree->getFolderId ( $i ) . ')"><div class="img folder"></div><div class="' . $s_share . '"></div></div>
								            <p style="float:left;margin-top:8px;margin-left:10px">' . $o_tree->getFolderName ( $i ) . '</p><span></span>
								            </td>
								            <td style="width:160px">
								               <div><a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);FolderRename(' . $o_tree->getFolderId ( $i ) . ',' . $o_tree->getParentId ( $i ) . ',\'' . $o_tree->getFolderName ( $i ) . '\');" class="operate">重命名</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);copyFolder(' . $o_tree->getFolderId ( $i ) . ');">复制</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);moveFolder(' . $o_tree->getFolderId ( $i ) . ');">移动</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);deleteFolder(' . $o_tree->getFolderId ( $i ) . ');">删除</a></div>
								            </td>
								            <td style="width:80px">
								               
								            </td>
								            <td style="width:80px">
								                ' . $o_tree->getDate ( $i ) . '
								            </td>
								        </tr>';
		
		}
		$o_file = new View_Netdisk_File ();
		$o_file->PushWhere ( array ('&&', 'Delete', '=', 0 ) );
		$o_file->PushWhere ( array ('&&', 'FolderId', '=', $n_folderid ) );
		$o_file->PushOrder ( array ('Filename', 'A' ) );
		$n_count = $o_file->getAllCount ();
		for($i = 0; $i < $n_count; $i ++) {
			$s_filesize = $o_file->getFilesize ( $i );
			$s_filesize = $this->getFilesize ( $s_filesize );
			$s_icon = '<div class="img ' . $o_file->getClassName ( $i ) . '"></div>';
			if ($o_file->getClassName ( $i ) == 'image') {
				$s_dbclick = 'ondblclick="window.open(\'' . $o_file->getPath ( $i ) . '/' . $o_file->getOriginalFilename ( $i ) . '\',\'_blank\');selected(this.parentNode.parentNode);"';
				$s_icon = '<div><img src="' . $o_file->getPath ( $i ) . '/' . $o_file->getOriginalFilename ( $i ) . '" alt="" align="absmiddle" style="max-height:150px"/></div>';
				$s_width = ' style="width:120px;height:50px"';
				$html .= '                   <tr onmouseover="showButton(this)" onmouseout="hideButton(this)" onclick="selected(this)" class="off">
								            <td style="width:20px" class="off">
								                <input id="file_' . ($i + 1) . '" value="' . $o_file->getFileId ( $i ) . '" type="checkbox" onclick="selectedForCheck(this)"/>
								            </td>
								            <td ' . $s_dbclick . '>
								                <div class="icon" style="display:none">' . $s_icon . '<div></div></div>
								            <img src="' . $o_file->getPath ( $i ) . '/' . $o_file->getOriginalFilename ( $i ) . '" alt="" align="absmiddle" style="max-width:120px;max-height:90px;margin-top:2px;margin-bottom:2px"/>
								           &nbsp;&nbsp;&nbsp;&nbsp;' . $o_file->getFilename ( $i ) . '
								            </td>
								            <td style="width:160px">
								               <div><a href="' . RELATIVITY_PATH . 'sub/service/download.php?fileid=' . $o_file->getFileId ( $i ) . '" onclick="selected(this.parentNode.parentNode.parentNode)" target="_blank">下载</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);fileRename( ' . $o_file->getFileId ( $i ) . ',\'' . $o_file->getFilename ( $i ) . '\');">重命名</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);copyFile(' . $o_file->getFileId ( $i ) . ');">复制</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);moveFile(' . $o_file->getFileId ( $i ) . ');">移动</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);deleteFile( ' . $o_file->getFileId ( $i ) . ');">删除</a></div>
								            </td>
								            <td style="width:80px">
								               ' . $s_filesize . '
								            </td>
								            <td style="width:80px">
								                ' . $o_file->getDate ( $i ) . '
								            </td>
								        </tr>';
			} else {
				$s_dbclick = 'ondblclick="window.open(\'' . RELATIVITY_PATH . 'sub/service/download.php?fileid=' . $o_file->getFileId ( $i ) . '\',\'\',\'_blank\');selected(this.parentNode.parentNode);"';
				$html .= '                   <tr onmouseover="showButton(this)" onmouseout="hideButton(this)" onclick="selected(this)" class="off">
								            <td style="width:20px" class="off">
								                <input id="file_' . ($i + 1) . '" value="' . $o_file->getFileId ( $i ) . '" type="checkbox" onclick="selectedForCheck(this)"/>
								            </td>
								            <td ondblclick="window.open(\'' . RELATIVITY_PATH . 'sub/service/download.php?fileid=' . $o_file->getFileId ( $i ) . '\',\'\',\'_blank\');selected(this.parentNode.parentNode);">
								                <div class="icon" style="float:left;">' . $s_icon . '<div></div></div>								         
								             <p style="float:left;margin-top:8px;margin-left:10px">' . $o_file->getFilename ( $i ) . '</p>
								            </td>
								            <td style="width:160px">
								               <div><a href="' . RELATIVITY_PATH . 'sub/service/download.php?fileid=' . $o_file->getFileId ( $i ) . '" onclick="selected(this.parentNode.parentNode.parentNode)" target="_blank">下载</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);fileRename( ' . $o_file->getFileId ( $i ) . ',\'' . $o_file->getFilename ( $i ) . '\');">重命名</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);copyFile(' . $o_file->getFileId ( $i ) . ');">复制</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);moveFile(' . $o_file->getFileId ( $i ) . ');">移动</a>&nbsp;&nbsp;<a href="javascript:;" onclick="selected(this.parentNode.parentNode.parentNode);deleteFile( ' . $o_file->getFileId ( $i ) . ');">删除</a></div>
								            </td>
								            <td style="width:80px">
								               ' . $s_filesize . '
								            </td>
								            <td style="width:80px">
								                ' . $o_file->getDate ( $i ) . '
								            </td>
								        </tr>';
			}
		
		}
		return $html;
	}

}

?>
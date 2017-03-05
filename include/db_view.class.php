<?php
require_once RELATIVITY_PATH.'include/db_operate.class.php';
require_once RELATIVITY_PATH.'include/db_connect.class.php';
/////////////////////////////////////////////////////用户信息列表
class View_User extends CRUD {
	protected $Uid; 
	protected $Password; 
	protected $Username;
	protected $State;
	protected $RegIp;
	protected $RegTime;
	protected $Type;
	protected $Name;
	protected $Nickname;
	protected $Company;
	protected $Dept;
	protected $Job;
	protected $Province;
	protected $City;
	protected $Street;
	protected $Postcode;
	protected $QQ;
	protected $CompanyPhone;
	protected $Phone;
	protected $Term;
	protected $IsSleep;
	protected $ActivationCode;
	protected $Head;
	protected $Checked;
	protected $Vantage;
	protected $LastTime;
	protected $CredentialId;
	protected $ComeFrom;
	protected function DefineKey() {
		return 'user.uid';
	}
	protected function DefineTableName() {
		return 'user` INNER JOIN `user_login` ON `user`.`uid` = `user_login`.`uid';
	}
	protected function DefineRelationMap() {
		 return (array ('user.uid' => 'Uid', 
						'user.password' => 'Password', 
		 				'user.username' => 'Username',
		 				'user.state' => 'State',
		 				'user.reg_ip' => 'RegIp',
		 				'user.reg_time' => 'RegTime',
		 				'user.type' => 'Type',
		 				'user.name' => 'Name',
		 				'user.nickname' => 'Nickname',
		 				'user.company' => 'Company',
		 				'user.dept' => 'Dept',
		 				'user.job' => 'Job',
		 				'user.province' => 'Province',
		 				'user.city' => 'City',
		 				'user.street' => 'Street',
		 				'user.postcode' => 'Postcode',
		 				'user.qq' => 'QQ',
		 				'user.company_phone' => 'CompanyPhone',
		 				'user.phone' => 'Phone',
		 				'user.term' => 'Term',
		 				'user.is_sleep' => 'IsSleep',
		 				'user.activation_code' => 'ActivationCode',
		 				'user.head' => 'Head',
		 				'user.checked' => 'Checked',
		 				'user.vantage' => 'Vantage',
		 				'user.come_from' => 'ComeFrom',
		 				'user_login.last_time' => 'LastTime',
		 				'user.credential_id' => 'CredentialId'
		));
	}
}
/////////////////////////////////////////////////////网盘文件列表带Css样式
class View_Netdisk_File  extends CRUD
{
   protected $FileId;
   protected $Filename;
   protected $Filesize;
   protected $Date;
   protected $Suffix;
   protected $Path;
   protected $Delete;
   protected $FolderId;
   protected $DeleteDate;
   protected $OriginalPath;
   protected $OriginalFilename;
   protected $ClassName;
	 
   protected function DefineKey()
   {
      return 'netdisk_file.file_id';
   }
   protected function DefineTableName()
   {
      return 'netdisk_file` INNER JOIN `netdisk_type` ON `netdisk_file`.`suffix` = `netdisk_type`.`suffix';
   }
   protected function DefineRelationMap()
   {
      return(array( 'netdisk_file.file_id' => 'FileId',
      				'netdisk_file.filename' => 'Filename',
      				'netdisk_file.filesize' => 'Filesize',
      				'netdisk_file.date' => 'Date',
      				'netdisk_file.suffix' => 'Suffix',
      				'netdisk_file.path' => 'Path',
      				'netdisk_file.delete' => 'Delete',
      				'netdisk_file.folder_id' => 'FolderId',
      				'netdisk_file.delete_date' => 'DeleteDate',
      				'netdisk_file.original_path' => 'OriginalPath',
      				'netdisk_file.original_filename' => 'OriginalFilename',
      				'netdisk_type.classname' => 'ClassName'
                   ));
   }
}
/////////////////////////////////////////////////////网盘文件列表带Css样式
class View_Information_Use  extends CRUD
{
	protected $UseId;
	protected $Uid; 
	protected $Address;
	protected $Name;
	protected $Phone;
	protected $Postcode;
	protected $State;
	protected $Information_id;
	protected $Sum;
	protected $Date;
	protected $SendDate;
	protected $Logistic;
	protected $OrderNumber;
	protected $InfoName; 
	protected $Photo;
	protected $Explain;
	protected function DefineKey() {
		return 'information_use.use_id';
	}
	protected function DefineTableName() {
		return 'information_use` INNER JOIN `information` ON `information`.`information_id` = `information_use`.`information_id';
	}
	protected function DefineRelationMap() {
		 return (array ('information_use.use_id' => 'UseId', 
						'information_use.uid' => 'Uid', 
						'information_use.address' => 'Address',
						'information_use.name' => 'Name',
						'information_use.phone' => 'Phone',
		 				'information_use.postcode' => 'Postcode',
		 				'information_use.state' => 'State',
		 				'information_use.information_id' => 'Information_id',
		 				'information_use.sum' => 'Sum',
		 				'information_use.date' => 'Date',
		 				'information_use.order_number' => 'OrderNumber',
		 				'information_use.send_date' => 'SendDate',
		 				'information_use.logistic' => 'Logistic',
		 				'information.name' => 'InfoName',	
		 				'information.photo' => 'Photo',	
		 				'information.explain' => 'Explain'			 
		));
	}
}
class View_Prize_Exchange  extends CRUD
{
	protected $ExchangeId; 
	protected $Uid;
	protected $Address;
	protected $Name;
	protected $Phone;
	protected $Postcode;	
	protected $State;
	protected $PrizeId;
	protected $Sum;
	protected $Date;
	protected $SendDate;
	protected $Logistic;
	protected $OrderNumber;
	protected $PrizeName; 
	protected $Photo;
	protected $Explain;
	protected function DefineKey() {
		return 'prize_exchange.exchange_id';
	}
	protected function DefineTableName() {
		return 'prize_exchange` INNER JOIN `prize` ON `prize`.`prize_id` = `prize_exchange`.`prize_id';
	}
	protected function DefineRelationMap() {
		 return (array ('prize_exchange.exchange_id' => 'ExchangeId', 
						'prize_exchange.uid' => 'Uid', 
						'prize_exchange.address' => 'Address',
						'prize_exchange.name' => 'Name',
						'prize_exchange.phone' => 'Phone',
		 				'prize_exchange.postcode' => 'Postcode',	
		 				'prize_exchange.state' => 'State',
		 				'prize_exchange.prize_id' => 'PrizeId',
		  				'prize_exchange.sum' => 'Sum',
		  				'prize_exchange.date' => 'Date',
		  				'prize_exchange.send_date' => 'SendDate',
		  				'prize_exchange.logistic' => 'Logistic',
		  				'prize_exchange.order_number' => 'OrderNumber',
		 		 		'prize.name' => 'PrizeName',	
		 				'prize.photo' => 'Photo',	
		 				'prize.explain' => 'Explain'	
		));
	}
}
class View_Goods_Prize  extends CRUD
{
	protected $Id; 
	protected $Uid;
	protected $Address;
	protected $Name;
	protected $Phone;
	protected $Postcode;	
	protected $State;
	protected $GoodsId;
	protected $Sum;
	protected $Date;
	protected $SendDate;
	protected $Logistic;
	protected $OrderNumber;
	protected $PrizeName; 
	protected $Photo;
	protected $Explain;
	protected $UserName;
	protected $Type;
	protected $Company;
	protected $Dept;
	protected $Job;
	protected function DefineKey() {
		return 'goods_send.id';
	}
	protected function DefineTableName() {
		return 'goods_send` INNER JOIN `prize` ON `prize`.`prize_id` = `goods_send`.`goods_id` INNER JOIN `user` ON `user`.`uid` = `goods_send`.`uid';
	}
	protected function DefineRelationMap() {
		 return (array ('goods_send.id' => 'Id', 
						'goods_send.uid' => 'Uid', 
						'goods_send.address' => 'Address',
						'goods_send.name' => 'Name',
						'goods_send.phone' => 'Phone',
		 				'goods_send.postcode' => 'Postcode',	
		 				'goods_send.state' => 'State',
		 				'goods_send.goods_id' => 'GoodsId',
		  				'goods_send.sum' => 'Sum',
		  				'goods_send.date' => 'Date',
		  				'goods_send.send_date' => 'SendDate',
		 				'goods_send.type' => 'Type',
		  				'goods_send.logistic' => 'Logistic',
		  				'goods_send.order_number' => 'OrderNumber',
		 		 		'prize.name' => 'PrizeName',	
		 				'prize.photo' => 'Photo',	
		 				'user.company' => 'Company',
		 				'user.dept' => 'Dept',
		 				'user.username' => 'UserName',
		 				'user.job' => 'Job',
		 				'prize.explain' => 'Explain'	
		));
	}
}
class View_Goods_Information extends CRUD
{
	protected $Id; 
	protected $Uid;
	protected $Address;
	protected $Name;
	protected $Company;
	protected $Dept;
	protected $Job;
	protected $Phone;
	protected $Postcode;	
	protected $State;
	protected $GoodsId;
	protected $Sum;
	protected $Date;
	protected $SendDate;
	protected $Logistic;
	protected $OrderNumber;
	protected $InfoName; 
	protected $UserName;
	protected $Photo;
	protected $Explain;
	protected $Type;
	protected function DefineKey() {
		return 'goods_send.id';
	}
	protected function DefineTableName() {
		return 'goods_send` INNER JOIN `information` ON `information`.`information_id` = `goods_send`.`goods_id` INNER JOIN `user` ON `user`.`uid` = `goods_send`.`uid';
	}
	protected function DefineRelationMap() {
		 return (array ('goods_send.id' => 'Id', 
						'goods_send.uid' => 'Uid', 
						'goods_send.address' => 'Address',
						'goods_send.name' => 'Name',
						'goods_send.phone' => 'Phone',
		 				'goods_send.postcode' => 'Postcode',	
		 				'goods_send.state' => 'State',
		 				'goods_send.goods_id' => 'GoodsId',
		  				'goods_send.sum' => 'Sum',
		  				'goods_send.date' => 'Date',
		  				'goods_send.send_date' => 'SendDate',
		 				'goods_send.type' => 'Type',
		  				'goods_send.logistic' => 'Logistic',
		  				'goods_send.order_number' => 'OrderNumber',
		 		 		'information.name' => 'InfoName',	
		 				'information.photo' => 'Photo',	
		 				'user.company' => 'Company',
		 				'user.dept' => 'Dept',
		 				'user.username' => 'UserName',
		 				'user.job' => 'Job',	
		 				'information.explain' => 'Explain'	
		));
	}
}
/////////////////////////////////////////////////////节的视图
class View_Section  extends CRUD
{
	protected $SectionId;
	protected $ChapterId; 
	protected $SKey;
	protected $Content;
	protected $Title;
	protected $State;
	protected $Chapter;
	protected $Vantage;
	protected $TermId;
	protected $Term;
	protected function DefineKey() {
		return 'bank_section.section_id';
	}
	protected function DefineTableName() {
		return 'bank_section` INNER JOIN `bank_chapter` ON `bank_chapter`.`chapter_id` = `bank_section`.`chapter_id` INNER JOIN `bank_term` ON `bank_term`.`term_id` = `bank_chapter`.`term_id';
	}
	protected function DefineRelationMap() {
		 return (array ('bank_section.section_id' => 'SectionId', 
						'bank_section.chapter_id' => 'ChapterId', 
						'bank_section.key' => 'SKey',
		 				'bank_section.Vantage' => 'Vantage',
						'bank_section.content' => 'Content',
						'bank_section.title' => 'Title',
		 				'bank_section.state' => 'State',
		 				'bank_chapter.name' => 'Chapter',
						'bank_term.term_id' => 'TermId',
		 				'bank_term.name' => 'Term'
		));
	}
}
/////////////////////////////////////////////////////题的视图
class View_Subject  extends CRUD
{
	protected $SubjectId; 
	protected $Content;
	protected $RightOptionId;
	protected $RightOption;
	protected $Section;
	protected $SectionId;
	protected $ChapterId; 
	protected $Chapter;
	protected $TermId;
	protected $Term;
	protected $SKey;
	protected function DefineKey() {
		return 'bank_subject.Subject_id';
	}
	protected function DefineTableName() {
		return 'bank_subject` INNER JOIN `bank_section` ON `bank_section`.`section_id` = `bank_subject`.`section_id` INNER JOIN `bank_chapter` ON `bank_chapter`.`chapter_id` = `bank_section`.`chapter_id` INNER JOIN `bank_term` ON `bank_term`.`term_id` = `bank_chapter`.`term_id';
	}
	protected function DefineRelationMap() {
		 return (array ('bank_subject.subject_id' => 'SubjectId', 
						'bank_subject.content' => 'Content', 
		 				'bank_subject.section_id' => 'SectionId',
		 				'bank_section.title' => 'Section',
		 				'bank_subject.right_option' => 'RightOption',
						'bank_subject.right_option_id' => 'RightOptionId',
						'bank_section.chapter_id' => 'ChapterId', 
		 				'bank_chapter.name' => 'Chapter',
						'bank_term.term_id' => 'TermId',
		 				'bank_section.key' => 'SKey',
		 				'bank_term.name' => 'Term'
		));
	}
}
class View_User_Credential extends CRUD {
	protected $Uid; 
	protected $Password; 
	protected $UserName;
	protected $Sex;
	protected $Birthday;
	protected $State;
	protected $RegIp;
	protected $RegTime;
	protected $Type;
	protected $Name;
	protected $EnName;
	protected $Company;
	protected $EnCompany;
	protected $Dept;
	protected $EnDept;
	protected $Job;
	protected $EnJob;
	protected $Province;
	protected $City;
	protected $Area;
	protected $Postcode;
	protected $AreaNumber;
	protected $QQ;
	protected $CompanyPhone;
	protected $Telephone;
	protected $Extension;
	protected $Phone;
	protected $Fax;
	protected $Skype;
	protected $Address;
	protected $EnAddress;
	protected $Email1;
	protected $Email2;
	protected $Url;
	protected $Term;
	protected $IsSleep;
	protected $ActivationCode;
	protected $Checked;
	protected $Vantage;
	protected $Photo;
	protected $Percent;
	protected $IsSend;
	protected $CredentialName;
	protected $ComeFrom;
	protected function DefineKey() {
		return 'uid';
	}
	protected function DefineTableName() {
		return 'user` INNER JOIN `credential` ON `user`.`credential_id` = `credential`.`credential_id';
	}
	protected function DefineRelationMap() {
		 return (array ('user.uid' => 'Uid', 
						'user.password' => 'Password', 
		 				'user.username' => 'UserName',
		 				'user.sex' => 'Sex',
		 				'user.birthday' => 'Birthday',
		 				'user.state' => 'State',
		 				'user.reg_ip' => 'RegIp',
		 				'user.reg_time' => 'RegTime',
		 				'user.type' => 'Type',
		 				'user.name' => 'Name',
		 				'user.en_name' => 'EnName',
		 				'user.company' => 'Company',
		 				'user.en_company' => 'EnCompany',
		 				'user.dept' => 'Dept',
		 				'user.en_dept' => 'EnDept',
		 				'user.job' => 'Job',
		 				'user.en_job' => 'EnJob',
		 				'user.province' => 'Province',
		 				'user.city' => 'City',
		 				'user.area' => 'Area',
		 				'user.postcode' => 'Postcode',
		 				'user.area_number' => 'AreaNumber',
		 				'user.qq' => 'QQ',
		 				'user.company_phone' => 'CompanyPhone',
		 				'user.telephone' => 'Telephone',
		 				'user.extension' => 'Extension',
		 				'user.phone' => 'Phone',
						'user.fax' => 'Fax',
						'user.skype' => 'Skype',
						'user.address' => 'Address',
						'user.en_address' => 'EnAddress',
						'user.email1' => 'Email1',
						'user.email2' => 'Email2',
						'user.url' => 'Url',
		 				'user.term' => 'Term',
		 				'user.is_sleep' => 'IsSleep',
		 				'user.activation_code' => 'ActivationCode',
		 				'user.checked' => 'Checked',
		 				'user.vantage' => 'Vantage',
		 				'user.photo' => 'Photo',
		 				'user.percent' => 'Percent',
		 				'user.is_send' => 'IsSend',
		 				'user.come_from' => 'ComeFrom',
		 				'credential.name' => 'CredentialName'
		));
	}
}
/////////////////////////////////////////////////////行程网站酒店信息
class View_Library_Hotel extends CRUD {
	protected $HotelId; 
	protected $CityId; 
	protected $Name;
	protected $Content;
	protected $Price;
	protected $CityName;
	protected function DefineKey() {
		return 'library_hotel.hotel_id';
	}
	protected function DefineTableName() {
		return 'library_hotel` INNER JOIN `library_city` ON `library_hotel`.`city_id` = `library_city`.`city_id';
	}
	protected function DefineRelationMap() {
		 return (array ('library_hotel.hotel_id' => 'HotelId', 
						'library_hotel.name' => 'Name', 
						'library_hotel.city_id' => 'CityId',
		 				'library_hotel.content' => 'Content',
		 				'library_city.name' => 'CityName',
		 				'library_hotel.price' => 'Price'
		));
	}
}
/////////////////////////////////////////////////////行程网站景点信息
class View_Library_Region extends CRUD {
	protected $RegionId; 
	protected $CityId; 
	protected $Name;
	protected $Content;
	protected $Price;
	protected $Key;
	protected $CityName;
	protected $TypeId;
	protected $TypeName;
	protected $Street;
	protected $Address;
	protected $Tel;
	protected $Web;
	protected $Zip;
	protected function DefineKey() {
		return 'library_region.region_id';
	}
	protected function DefineTableName() {
		return 'library_region` INNER JOIN `library_city` ON `library_region`.`city_id` = `library_city`.`city_id` INNER JOIN `library_region_type` ON `library_region`.`type_id` = `library_region_type`.`type_id';
	}
	protected function DefineRelationMap() {
		 return (array ('library_region.region_id' => 'RegionId', 
						'library_region.name' => 'Name', 
						'library_region.city_id' => 'CityId',
		 				'library_region.content' => 'Content',
		 				'library_city.name' => 'CityName',
		 				'library_region.key' => 'Key',
		 'library_region.street' => 'Street',
		 'library_region.address' => 'Address',
		 'library_region.tel' => 'Tel',
		 'library_region.zip' => 'Zip',
		 'library_region.web' => 'Web',
		 				'library_region.price' => 'Price',
		 'library_region_type.type_id' => 'TypeId',
		 'library_region_type.name' => 'TypeName'
		));
	}
}
/////////////////////////////////////////////////////访客下载记录
class View_Travel_Visitor extends CRUD {
	protected $Id;
	protected $Email; 
	protected $Phone;
	protected $Date;
	protected $TitleId;
	protected $Ip;
	protected $Sum;
	protected $Name;
	protected function DefineKey() {
		return 'travel_visitor.id';
	}
	protected function DefineTableName() {
		return 'travel_visitor` INNER JOIN `travel_title` ON `travel_title`.`title_id` = `travel_visitor`.`title_id';
	}
	protected function DefineRelationMap() {
		 return (array ('travel_visitor.id' => 'Id', 
						'travel_visitor.email' => 'Email', 
						'travel_visitor.phone' => 'Phone',
		 				'travel_visitor.date' => 'Date',
		 				'travel_visitor.title_id' => 'TitleId',
		 				'travel_visitor.sum' => 'Sum',
		 				'travel_title.name' => 'Name',
						'travel_visitor.ip' => 'Ip'
		));
	}
}
/////////////////////////////////////////////////////行程网站类型
class View_Travel_Type extends CRUD {
	protected $TypeId; 
	protected $Name; 
	protected $State;
	protected $Delete;
	protected $TitleId;
	protected $Number;
	protected $Photo;
	protected $TitleName;
	protected function DefineKey() {
		return 'travel_type.type_id';
	}
	protected function DefineTableName() {
		return 'travel_type` INNER JOIN `travel_title` ON `travel_title`.`title_id` = `travel_type`.`title_id';
	}
	protected function DefineRelationMap() {
		 return (array ('travel_type.type_id' => 'TypeId', 
						'travel_type.name' => 'Name', 
						'travel_type.state' => 'State',
		 				'travel_type.delete' => 'Delete',
		 				'travel_type.title_id' => 'TitleId',
		 				'travel_type.number' => 'Number',
		 				'travel_title.name' => 'TitleName',
						'travel_type.photo' => 'Photo'
		));
	}
}
/////////////////////////////////////////////////////行程网站行程标题
class View_Travel_Title extends CRUD {
	protected $TitleId; 
	protected $Name; 
	protected $Explain;
	protected $Date;
	protected $State;
	protected $Visit;
	protected $Download;
	protected $PhotoOn;
	protected $Photo;
	protected $TypeId;
	protected $TypeName;
	protected function DefineKey() {
		return 'travel_title.title_id';
	}
	protected function DefineTableName() {
		return 'travel_title` INNER JOIN `travel_type` ON `travel_title`.`type_id` = `travel_type`.`type_id';
	}
	protected function DefineRelationMap() {
		 return (array ('travel_title.title_id' => 'TitleId', 
						'travel_title.name' => 'Name', 
						'travel_title.explain' => 'Explain',
		 				'travel_title.date' => 'Date',
		 				'travel_title.visit' => 'Visit',
		 				'travel_title.download' => 'Download',
		 				'travel_title.state' => 'State',
		 'travel_title.photo_on' => 'PhotoOn',
		 'travel_title.type_id' => 'TypeId',
		 'travel_type.name' => 'TypeName',
		 'travel_title.photo' => 'Photo'
		));
	}
}
?>
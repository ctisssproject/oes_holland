<?php
require_once RELATIVITY_PATH . 'include/it_systext.class.php';
abstract class DB_Connect
{
   private $S_DatabaseServer = '127.0.0.1:3306';
   private $S_UserName = 'root';
   private $S_PassWord = 'chutaoIsss';
   private $S_DataBaseName = 'oes_holland';
   protected $O_Result;
   protected $S_Id;
   protected $S_Error_Reason;
   protected function Execute($sql)
   {
      //echo($sql.'<br>');
      $db = @mysql_connect($this->S_DatabaseServer, $this->S_UserName, $this->S_PassWord);
      mysql_select_db($this->S_DataBaseName, $db);
      mysql_query("SET NAMES 'utf8'");
      $this->O_Result = mysql_query($sql, $db);
      if($this->O_Result)
      {
         if(strpos($sql, 'INSERT') > - 1)
         {
            $this->S_Id = mysql_insert_id();
         }
         mysql_close();
      }
      else
      {
         //$o_hint = new Bn_Basic();
         $this->S_Error_Reason = SysText::Index('DATABASE');
      }
   }
   protected function Command($sql)
   {
      $db = mysql_connect($this->S_DatabaseServer, $this->S_UserName, $this->S_PassWord);
      mysql_select_db($this->S_DataBaseName, $db);
      mysql_query("SET NAMES 'utf8'");
      $result = mysql_query($sql, $db);
      if($result)
      {
         mysql_close();
      }
   }

   public function getErrorReason()
   {
      return $this->S_Error_Reason;
   }
   protected function Item($n_row, $s_item)
   {
      try
      {
         $s_temp = mysql_result($this->O_Result, $n_row, $s_item);
         //echo($n_row.'-'.$s_item.'<br>');
         return $s_temp;
      }
      catch(exception $err)
      {
         return null;
      }

   }

}
?>
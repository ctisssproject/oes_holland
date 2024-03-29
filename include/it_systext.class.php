<?php
class SysText
{
  static public function Index($key)
   {
      $a_hint=array('PASSWORD_ERROR' => '错误原因：用户名或密码错误!',
      				'STATE_ERROR' => '对不起,<br/>该用户已被停用!',
                    'ERROR_FULL' => '密码错误次数超限<br/>您的账户被锁定<br/>请过1分钟后再登录 !',
                    'USERNAME_ERROR1' => '对不起用户名不能小于4个字符 !',
                    'USERNAME_ERROR2' => '用户名已经存在,请更换 !',
                    'PASSWORD_ERROR1' => '对不起两次输入的密码不一致 !',
                    'PASSWORD_ERROR2' => '密码不能小于6位 !',
      				'ERROR_020' => '信息填写错误，请重新填写 !',
                    'VALIDCODE_ERROR' => '输入的验证码不符，请重新确认 !',
                    'EMAIL_ERROR' => '填写的 Email 格式有误 !',
                    'USER_AUDIT1' => '注册成功,等待管理员审核 !',
                    'USER_REG' => '注册成功 !',
                    'DATABASE' => '数据库读取错误 !',
                    'PAGE_001' => '添加新导航 !',
                    'PAGE_002' => '删除当前导航 !',
                    'PAGE_003' => '修改当前导航 !',
                    'PAGE_004' => '注册成功 !',
                    'PAGE_005' => '提交',
                    'PAGE_006' => '注册成功 !',
                    'PAGE_007' => '注册成功 !',
                    'PAGE_008' => '注册成功 !',
                    'ERROR_001'=>'对不起, <br/>您输入的位置错误 !',
                    'ERROR_002'=>'对不起, <br/>找不到相应的导航 !',
                    'ERROR_003'=>'对不起, <br/>层级设置失败 !',
                    'ERROR_004'=>'对不起,<br/>操作出现错误 <br/>请与软件提供商联系 !',
                    'ERROR_005'=>'对不起,<br/>名称不能超过6个字符 !',
                    'ERROR_006'=>'对不起,<br/>说明不能超过10个字符 !',
                    'ERROR_007'=>'对不起,<br/>您没有权限进行这个操作 !',
                    'ERROR_008'=>'对不起,图标文件类型错误 !<br/>请选择 JPG PNG GIF BMP 类型的文件 !',
                    'ERROR_009'=>'对不起,图标文件过大 !<br/>请选择1MB以内的文件 !',
                    'ERROR_010'=>'对不起,修改文章出现错误 !<br/>请与软件提供商联系 !',
                    'SERVICE_001'=>'对不起 , [ 标题 ] 不能为空 !',
                    'SERVICE_002'=>'对不起 , 留言内容太少 !',
                    'SERVICE_003'=>'对不起 , 不能连续留言<br/>请在 30 秒后继续 !',
                    'ERROR_011' => '对不起 , <br/>只有注册用户才能上传图片 !',
                    'ERROR_012' => '对不起 , 上传图片不能为空 !',
                    'ERROR_013'=>'对不起,文件类型错误 !<br/>请选择 JPG PNG GIF BMP 类型的文件 !',
                    'ERROR_014'=>'对不起,图片文件过大 !<br/>请选择1MB以内的文件 !',
      				'Ok_001' => '恭喜，您的邀请已发送成功！<br/>当您的好友收到邮件并注册成为荷兰旅游专家学员后，您将获得相应积分奖励！',
      				'Ok_002' => '恭喜您，修改个人信息成功！',
      				'Ok_003' => '恭喜您，修改登陆密码成功！',
      				'Ok_004' => '恭喜您，修改个人头像成功！',
      				'Ok_005' => '恭喜您，密码找回成功！<br/>点击“确定”后，登陆邮箱！<br/>新密码邮件将在3分钟后送达！',
      				'Ok_006' => '恭喜您，好友分享成功！<br/>您的好友将在3分钟后收到分享邮件！',
      				'Ok_007' => '恭喜您已顺利通过本节课程！<br/>点击确认，开始下一课的学习吧！',
      				'Ok_008' => '恭喜您，您已通过所有课程学习，获得了“荷兰旅游专家”证书！特奖励',
      				'Ok_009' => '保存信息成功！',
      				'Ok_010' => '重置用户登录密码成功！',
      				'Ok_011' => '添加新用户成功！',
      				'Ok_012' => '邮件发送成功！',
      				'Ok_013' => '证书寄送申请已提交！<br/>请您进行积分换礼及领取资料！<br/>兑换及申领后，工作人员将安排所有物品的寄送。快递寄出后，将以邮件方式告之。',
      				'Ok_014' => '资讯发布成功！',
      				'Ok_015' => '添加广告成功！',
      				'Ok_016' => '添加合作伙伴成功！',
      				'Ok_017' => '添加焦点图片成功！',
      				'Ok_018' => '添加新学期成功！',
      				'Ok_019' => '添加新章节成功！',
      				'Ok_020' => '添加新节成功！',
      				'Ok_021' => '添加新试题成功！',     				
      				'Ok_022' => '发货成功！<br/>系统会以邮件的方式通知学员！<br/>点击确定开始打印。',
      				'Ok_023' => '资料寄送申请审核成功！',
      				'Ok_024' => '奖品兑换成功！<br/>工作人员将尽快安排礼品的寄送。快递寄出后，将以邮件方式告之。',
      				'Ok_025' => '资料申领成功！<br/>工作人员将尽快安排资料的寄送。快递寄出后，将以邮件方式告之。',
      				'Ok_026' => '添加奖品成功！',
      				'Ok_027' => '添加资料成功！',
      				'Ok_028' => '积分！<br/>点击“确定”填写证书寄送地址！',
      				'Ok_029' => '添加新城市成功！',
      				'Ok_030' => '添加新酒店成功！',
      				'Ok_031' => '添加新景区成功！',
      				'Ok_032' => '添加行程线路成功！',
      				'Ok_036' => '上传图片成功！',
      				'Ok_037' => '添加新行程分类成功！',
      				'Ok_038' => '导入新章节成功！',
      				'Error_001' => '请将*标记的信息填写完整后提交！',
      				'Error_002' => '你的账户还没有通过邮箱验证！<br/>成功验证后才可使用！',
      				'Error_003' => '你的账户需要等待管理员的审核！<br/>审核通过后会邮件通知您！',
      				'Error_004' => '对不起！<br/>请您登陆后再进行此项操作！',
      				'Error_005' => '对不起，您今天的邀请次数已满！<br/>不能再邀请好友了！请您明天再试！',
      				'Error_006' => '请您选择图片文件！',
      				'Error_007' => '请您选择正确的文件格式！<br/>文件格式为：jpg gif png bmp。',
      				'Error_008' => '对不起，文件太大！<br/>上传图片请不要超过 1 MB。',
      				'Error_009' => '对不起，该用户不存在。',
      				'Error_010' => '对不起，[ 真实姓名 ] 填写错误！<br/>请重新填写！',
      				'Error_011' => '对不起，[ 手机 ] 填写错误！<br/>请重新填写！',
      				'Error_012' => '很抱歉，您的测试没有通过！<br/>点击确认，即可回到本节重新学习和答题！',
      				'Error_013' => '对不起，用户名有重名！<br/>请更换用户名！',
      				'Error_014' => '对不起，该奖品现在无货，请您兑换其他奖品！',
      				'Error_015' => '请选择发货项目！',
      				'Error_016' => '请选择<br/>相同收件人和地址的项目！',
      				'Error_017' => '该城市名称已存在，请更换！',
      				'Error_018' => '该分类名称已存在，请更换！',
      				'Ok_033' => '添加新分站成功！',
      				'Ok_034' => '添加新时间段成功！'
                    );
      return $a_hint[$key];
   }

}

?>
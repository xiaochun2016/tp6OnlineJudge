<?php
// 应用公共文件
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/**
 * 发送邮箱验证码
 * @param string $email 邮箱
 * @param string $content 邮件内容
 * @param string $subject 主题
 * @return bool
 */
function sendCode(string $email, string $content, string $subject):bool {
	if (!$email || !$content || !$subject){
		return false;
	}
	$pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
	if (!preg_match($pattern, $email)) {
		return false;
	}
	$mail = new PHPMailer(true);
	try {
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;
		$mail->isSMTP();
		$mail->Host       = env('email.host', 'smtp.163.com');
		$mail->SMTPAuth   = true;
		$mail->Username   = env('email.account', '');
		$mail->Password   = env('email.password', '');
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port       = env('email.port', 465);

		$mail->setFrom(env('email.account', ''), 'Mailer');
		$mail->addAddress($email, '亲爱的:');
		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body    = $content;
		$mail->send();
		return true;
	}catch (Exception $e){
//		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		return false;
	}
}

function zp_page($str) {
	return str_replace('pagination', 'pagination layui-laypage', $str);
}


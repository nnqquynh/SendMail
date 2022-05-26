<?php
require "PHPMailer-master/src/PHPMailer.php";  //nhúng thư viện vào để dùng, sửa lại đường dẫn cho đúng nếu bạn lưu vào chỗ khác
          require "PHPMailer-master/src/SMTP.php"; //nhúng thư viện vào để dùng
          require 'PHPMailer-master/src/Exception.php'; //nhúng thư viện vào để dùng
          $mail = new PHPMailer\PHPMailer\PHPMailer(true);  //true: enables exceptions
            try {
                $mail->SMTPDebug = 2;  // 0,1,2: chế độ debug. khi mọi cấu hình đều tớt thì chỉnh lại 0 nhé
                $mail->isSMTP();  
                $mail->CharSet  = "utf-8";
                $mail->Host = 'smtp.gmail.com';  //SMTP servers
                $mail->SMTPAuth = true; // Enable authentication
		    $nguoigui = 'quynh.nn@citigo.com.vn';
		    $matkhau = 'lmaodbudbrjvdiec';
		    $tennguoigui = 'Nguyễn Như Quỳnh';
                $mail->Username = $nguoigui; // SMTP username
                $mail->Password = $matkhau;   // SMTP password
                $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
                $mail->Port = 465;  // port to connect to                
                $mail->setFrom($nguoigui, $tennguoigui ); 
		
		$toArr = ["quynhmykiot@gmail.com"];
                $to_name = "Mykiot Member";
                
		foreach($toArr as $member) {
			$mail->addAddress($member); //mail và tên người nhận  
		}
                $mail->isHTML(true);  // Set email format to HTML
                $mail->Subject = 'Gửi thư từ PHP';      
         	$mail->AddEmbeddedImage('mykiot-attd-gitlab/Actions/Share/image-comparison/actual/report.png','testImage','report.png');

		$noidungthu = "
		<p> Dear team,<br>
		Em gửi kết quả <b> Automation Test Report ngày ".date("d/m/Y")."</b><br><br> </p>" ;

		$mail->Body = $noidungthu;
         	$mail->Body .= '<img src="cid:testImage"> <br>';
		$mail->Body .= '<img src="cid:testImage2"> <br><br>';
		$mail->Body .= '<p>Thanks and Best Regards, <br> Nguyễn Như Quỳnh </p>';
                
                $mail->smtpConnect( array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                ));
		//$mail->addAttachment('mykiot-attd-gitlab/Actions/Share/image-comparison/actual/abc.png');  
                $mail->send();
                echo 'Đã gửi mail xong';
		
                
            } catch (Exception $e) {
                echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
            }

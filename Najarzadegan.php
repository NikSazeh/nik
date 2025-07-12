<?php
// تنظیم هدر برای پاسخ JSON
header('Content-Type: application/json; charset=utf-8');

// دریافت داده‌های فرم
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';

// اعتبارسنجی داده‌ها
if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'لطفاً نام، ایمیل و پیام را پر کنید']);
    exit;
}

// تنظیمات ایمیل
$to = 'najarzadegansite@gmail.com'; // 
$subject = "پیام جدید از سایت نجارزادگان: $name";
$email_content = "
نام: $name
ایمیل: $email
تلفن: $phone
---
پیام:
$message
";

// هدرهای ایمیل
$headers = "From: najarzadegansite@gmail.con\r\n";
$headers .= "Reply-To: $email\r\n";

// ارسال ایمیل
$mail_sent = mail($to, $subject, $email_content, $headers);

// پاسخ به کاربر
if ($mail_sent) {
    echo json_encode(['success' => true, 'message' => 'پیام شما با موفقیت ارسال شد!']);
} else {
    echo json_encode(['success' => false, 'message' => 'خطا در ارسال پیام. لطفاً بعداً تلاش کنید.']);
}
?>
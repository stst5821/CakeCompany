<?php
$from = 'stst5821@gmail.com';
$to = 'anri0083@gmail.com';
$subject = '件名: テスト送信';
$message = <<< EOF
{$from}より。

こんにちは。
これはテスト送信です。
EOF;

if (mb_send_mail($to, $subject, $message, "From: {$from}")) {
echo '送信成功。';
} else {
echo '送信失敗。<br>エラーログを確認してください。 (xampp\sendmail\error.log)';
}
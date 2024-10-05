<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームからのデータを受け取る
    $name = htmlspecialchars(trim($_POST['name'])); // お名前
    $email = htmlspecialchars(trim($_POST['email'])); // メールアドレス
    $message = htmlspecialchars(trim($_POST['message'])); // メッセージ

    // 入力データの検証
    $errors = [];
    if (empty($name)) {
        $errors[] = "お名前は必須です。";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "正しいメールアドレスを入力してください。";
    }
    if (empty($message)) {
        $errors[] = "メッセージは必須です。";
    }

    // エラーがない場合、メールを送信
    if (empty($errors)) {
        $to = "your_email@example.com"; // 受信先のメールアドレス
        $subject = "ホームページからのお問い合わせ: " . $name; // メールの件名
        $body = "名前: $name\nメール: $email\nメッセージ:\n$message"; // メールの内容
        $headers = "From: $email"; // 送信者の情報

        // メール送信処理
        if (mail($to, $subject, $body, $headers)) {
            echo "お問い合わせを受け付けました。";
        } else {
            echo "送信に失敗しました。";
        }
    } else {
        // エラーがある場合、エラーメッセージを表示
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
} else {
    echo "不正なリクエストです。";
}
?>

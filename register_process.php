<?php

// セッションの設定
// セッションとは、Webサーバー側に一時的にデータを保存する仕組み
// 今回はshopに移動した際に、セッションを引き継ぐために必要
session_start();

// 1.POST送信されたデータを受け取る
$name = $_POST['name'];
$job = $_POST['job'];
$hp = $_POST['hp'];
$mp = $_POST['mp'];


// セッションにデータを保存
// register.phpで入力されたデータをセッションに保存
// $_SESSIONは、サーバー側にデータを保存するためのスーパーグローバル変数
// グローバル変数とは、どこからでもアクセスできる変数のこと
// $_SESSIONは、連想配列で、playerがキーになっている
$_SESSION['player'] = [
    'name' => $name,
    'job' => $job,
    'hp' => $hp,
    'mp' => $mp
];


// 2.データベースに接続
require_once 'functions/db_connect.php';
// データベース接続を関数化したものを使用
$pdo = db_connect();
// PODのインスタンスを定義（returnされたもの）


// 3.SQL文を作成して実行
        // 1．プレースホルダーの使い方：SQL文の中の変動箇所をプレースホルダー（；で始まる代替文字列）として指定する
        // 2．bindValue()メソッドを使って、プレースホルダーに値をバインド（割り当て）する
$sql = 'INSERT INTO players (name, job, hp, mp) VALUES (:name, :job, :hp, :mp)';
// INSERT INTO テーブル名 (カラム1, カラム2, カラム3, ...) VALUES (値1, 値2, 値3, ...);
// SQL文とは、データベースに対して行う操作のこと(Structured Query Language)
// SQL文を使って、crad(create:作成)、read(読み取り)、update(更新)、delete(削除))の操作を行う

$stmt = $pdo->prepare($sql);
// データベースに、SQL文を送信して実行準備をさせる
// この段階では、SQL文の文法チェックや最適化がデータベース側で行われるが、値はまだ送られていない。

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':job', $job, PDO::PARAM_STR);
$stmt->bindValue(':hp', $hp, PDO::PARAM_INT);
$stmt->bindValue(':mp', $mp, PDO::PARAM_INT);
// bindValue()は、1つのプレースホルダー（例: :name）に1つの値（例: $name）を紐づけるメソッド
// 値はバインドされるだけで、まだデータベースに送られていない。
// このバインドにより、SQL文のプレースホルダー部分に値が安全に設定される。

$status = $stmt->execute();
// 実際にデータベースに接続し、SQL文を実行する。
// プレースホルダーにバインドされた値がSQL文に埋め込まれた状態でデータベースに送られる。
// SQL実行結果が$statusに代入される（成功時はtrue、失敗時はfalse）。


// 4.データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合
    $error = $stmt->errorInfo();
    exit('sqlError:' . $error[2]);
    // errorInfo()は、エラーに関する情報を取得するメソッド
    // errorInfoは、PDOクラス特有のメソッド
    // $error[2]は、エラーメッセージを取得する（人間が読めるエラーメッセージ）
    // $error[0],[1]は、システムやデータベース管理者向けの情報
} else {
    // SQL実行が成功した場合
    // 登録ページへ移動
    // SQL実行が成功した場合
    header('Location: register_confirm.php'); 
    // 登録内容確認ページへ遷移
    exit();
    // exit()は、プログラムを終了する関数
}
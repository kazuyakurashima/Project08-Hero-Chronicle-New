<?php

// XSS(Cross-Site Scripting)対策のため、htmlspecialchars()関数を使用
require_once 'functions/security.php'; 
    // セキュリティ用の関数(htmlspecialchars)が定義されたファイルを読み込む

// データベースに接続
require_once 'functions/db_connect.php'; 
// データベース接続用の関数(PODのインスタンスを生成）が定義されたファイルを読み込む
$pdo = db_connect(); // db_connect()関数を呼び出してデータベースに接続し、その接続情報を$pdoに代入


// 直近（最後）に登録されたデータを1件取得する
// ORDER BY id DESC：idが大きい順（新しい順）に並べ、LIMIT 1で1件だけ取得します。
$stmt_latest = $pdo->prepare('SELECT * FROM players ORDER BY id DESC LIMIT 1'); // 最新のデータを取得するSQL文を準備
$status_latest = $stmt_latest->execute(); // SQL文を実行し、成功したかどうかを$status_latestに代入
$latest_player = $stmt_latest->fetch(PDO::FETCH_ASSOC); // 実行結果から1件のデータを連想配列形式で取得し、$latest_playerに代入

// 全てのデータを登録日時（created_at）の新しい順に取得する
// ORDER BY created_at DESC：登録日時が新しい順に並べます。
$stmt_all = $pdo->prepare('SELECT * FROM players ORDER BY created_at DESC'); // 全データを取得するSQL文を準備
$status_all = $stmt_all->execute(); // SQL文を実行し、成功したかどうかを$status_allに代入
$all_players = $stmt_all->fetchAll(PDO::FETCH_ASSOC); // 実行結果から全データを連想配列形式で取得し、$all_playersに代入
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>登録内容確認</title> <!-- ページのタイトル -->
    <link rel="icon" href="img/project8.png"> <!-- ファビコンの設定 -->
</head>
<body>
    <!-- 直近に登録されたデータの表示 -->
    <h1>登録内容確認</h1>
    <?php if ($latest_player): ?>
        <!-- データが存在する場合に直近のデータを表示 -->
        <p>名前: <?php echo h($latest_player['name']); ?></p> <!-- htmlspecialchars()でデータを無害化して表示 -->
        <p>職業: <?php echo h($latest_player['job']); ?></p>
        <p>HP: <?php echo h($latest_player['hp']); ?></p>
        <p>MP: <?php echo h($latest_player['mp']); ?></p>
        <p>登録日時: <?php echo h($latest_player['created_at']); ?></p>
    <?php else: ?>
        <!-- データが存在しない場合のメッセージを表示 -->
        <p>データが見つかりませんでした。</p>
    <?php endif; ?>

    <!-- 全てのデータを一覧表示する -->
        <!-- tr:Table Row           テーブルを作るよ -->
        <!-- th:Table Header        項目（ヘッダー）を定義 -->
        <!-- td:Table Table Data    実際のデータを入れるよ -->

    <h2>登録済みデータ一覧</h2>
    <table border="1"> <!-- 表を作成します（border="1"で枠線を付ける） -->
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>職業</th>
            <th>HP</th>
            <th>MP</th>
            <th>登録日時</th>
        </tr>
        <!-- foreach文を使って、データベースから取得した全てのデータを1行ずつ表示 -->
        <?php foreach ($all_players as $player): ?>
            <tr>
                <!-- htmlspecialchars()関数で表示する内容を無害化します（セキュリティ対策） -->
                <td><?php echo h($player['id']); ?></td> <!-- IDを表示 -->
                <td><?php echo h($player['name']); ?></td> <!-- 名前を表示 -->
                <td><?php echo h($player['job']); ?></td> <!-- 職業を表示 -->
                <td><?php echo h($player['hp']); ?></td> <!-- HPを表示 -->
                <td><?php echo h($player['mp']); ?></td> <!-- MPを表示 -->
                <td><?php echo h($player['created_at']); ?></td> <!-- 登録日時を表示 -->
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- shopフォルダにあるindex.htmlに飛ぶリンク -->
    <a href="./shop/index.php">ギークマーケットへ</a><!-- ギークマーケットページに飛ぶリンク -->

    <!-- 登録画面に戻るリンク -->
    <a href="register.php">キャラ登録画面へ戻る</a> <!-- 登録ページに戻るリンク -->

</body>
</html>

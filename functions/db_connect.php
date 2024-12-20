<?php

// データベース接続用の関数を定義
        // PDO（PHP Data Objects）を使ってデータベースに接続します。
        // 'mysql:dbname=データベース名; charset=文字コード; host=ホスト名'が接続情報です。
        // 'root'はユーザー名、''はパスワード（今回は空欄）。
 function db_connect() {
    try {
        return new PDO('mysql:dbname=game_db; charset=utf8; host=localhost', 'root', '');
        // PDOクラスのインスタンスを作成し、データベースに接続します。
        // return文でPDOクラスのインスタンスを返すことで、関数を呼び出した箇所でPDOクラスのインスタンスを使用できるようにします。
        // ここで$podを定義してもページを遷移するとリセットされてしまうので無駄になる
    } catch (PDOException $e) {
        // PDOExceptionが発生した場合、接続に失敗したことを意味します。
        // error_log()関数でエラー内容をログに記録します（開発者用）。

        // ユーザー向けの簡易的なエラーメッセージを表示してプログラムを終了します。
        // 実際のエラー内容はユーザーには表示しないようにしています（セキュリティ対策）。
        exit('接続エラーが発生しました。管理者にご連絡ください。');
    }
}

?>




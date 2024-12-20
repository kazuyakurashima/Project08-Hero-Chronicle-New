<?php

// htmlspecialchars()関数は、特殊文字をHTMLエンティティに変換します（エスケープする）。
// ENT_QUOTESは、シングルクォートとダブルクォートを共に変換します。
// ENT(entities)は、HTMLエンティティ(HTMLにおける特殊文字）を意味します。
// QUOTESは、シングルクォートとダブルクォートを意味します。
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES);
};

?>

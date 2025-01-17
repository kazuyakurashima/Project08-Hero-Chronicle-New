# ①課題番号 - プロダクト名

**08 - Hero Chronicle**

---

## ②課題内容（どんな作品か）

キャラクターを作成し登録するアプリです。その後、ショップでアイテムを購入し、購入したアイテムをキャラクターに表示させることができます。

---

## ③DEMO

現在準備中です。

---

## ④アプリケーション用のIDまたはPassword（必要な場合）

- ID: 今回はなし
- PW: 今回はなし

---

## ⑤工夫した点・こだわった点

### **学んだこと**
- PHPは、POSTで受け取ったデータをすべて文字列として処理する。
- MySQL以外にも様々なデータベースが存在することを理解。

### **工夫したポイント**
1. **関数をフォルダで整理**  
    - データベース接続処理を関数化し、別ファイルとして作成。再利用性を高めました。
    - XSS対策用のエスケープ関数を作成し、これも独立したファイルにまとめました。
    - 各ファイルを `functions` フォルダに配置し、管理しやすくしました。

2. **セッション機能の活用**  
    - 前回の課題と今回の課題を結合し、セッションを利用してデータの受け渡しを実現しました。

---

## ⑥難しかった点・次回トライしたいこと

### **苦労した点**
1. **SQLインジェクションへの対策**  
    - SQLインジェクションの仕組みの理解に時間がかかりました。
    - 型を指定して変数をバインドする方法（`bindValue`）を学び、実践しました。
    - プレースホルダの利用により、安全なSQL文の作成を行いました。

2. **表示処理の複雑化**  
    - データベース操作とHTML表示のコードが混在し、可読性が低下しました。
    - ChatGPTに相談し、MVCモデルの導入を提案されました。

3. **前回課題との統合エラー**  
    - 前回の課題と結合する際に、ファイル間の依存関係やデータ受け渡しでエラーが多発しました。

---

### **次回トライしたいこと**
1. **データベース管理の拡張**  
    - 前回の課題で登録した項目もデータベースで管理するように変更。

2. **ファイル構造の整理**  
    - ファイルが多くなってきたため、MVCモデルに基づいてフォルダを整理し、可読性と保守性を向上させる。

---

## ⑦質問・感想

### **質問**
- ファイルが増えたときにエラーが増えないようにする管理方法を教えてください。
    - MVCモデルの導入方法や実践的なファイル構成例が知りたいです。

### **感想**
- ProgateでSQLの基礎を学び、実際にアプリに活用することで理解が深まりました。
- シンプルな操作でも意外と奥が深いと感じています。

**[参考記事]**
- [Progate](https://prog-8.com/dashboard)  
    - SQL（初級）コースで基本操作を学びました。

# Craft_Map

【　タイトル　】

　工芸品マップ

【　概要　】
　静岡市の工芸品を扱っているお店を検索できるアプリ。
　お店：随時更新中
　エリア：今後拡大予定
  
【　使用言語・開発環境　】
　・言語
　PHP  javascript（非同期通信で使用）
　・OS
 　Windows
　・DB
 　MySQL
　・フレームワーク
 　Laravel
  画像はs3で管理
  AWS Cloud9使用
 
【　機能一覧　】
 ・ログイン機能
 ・口コミ機能（投稿・編集・削除）
 ・店舗登録機能（投稿・編集・削除）→管理者のみ
 ・管理者権限
 ・いいね機能
 ・google map api
 ・google map上での店舗検索機能
 ・緯度経度変換（Geocording api）
 ・非同期通信
 ・認証・認可
 
 口コミ投稿・いいね機能はログイン後に利用可
 
【　工夫した点　】
　・店舗登録時に住所を緯度経度に変換しgoogle map上に表示させることで、新規店舗登録の簡易化を図った。
  ・他ユーザーの投稿の編集・削除や管理者以外が店舗登録・編集できないようにするためのセキュリティ対策（LaravelのGateを利用）。
  ・トップページでは登録店舗すべてのピンをマップ上に表示し、見やすくするため店舗詳細ページではそれぞれの店舗ピン一つだけを表示した。
  
【　テストアカウント　】
　メールアドレス：taro@example.com
　パスワード：aaa

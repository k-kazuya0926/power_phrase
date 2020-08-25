## Power Phrase

心に残った言葉(パワーフレーズ)とそのエピソードを共有するサイトです。  

<img width="800px" alt="トップページ" src="https://user-images.githubusercontent.com/61341861/83208323-557f7380-a190-11ea-9142-68e2f1700921.png">

## URL　※停止

https://www.power-phrase.com/

ヘッダーにある「おためしログイン」をクリックするとゲストユーザーとしてログインできます。

## 使用技術

- PHP 7.1.33
- Laravel 5.8.38
- Bootstrap 4.1.3
- JQuery 3.5.1
- nginx 1.16.1
- Composer 1.10.1
- AWS
    - EC2(Amazon Linux 2)
    - RDS(MySQL 5.7)
    - Route53
    - ALB
    - ACM
- Docker Desktop for Mac 2.3.0.3(nginx+PHP-FPM+MySQLの開発環境構築)
    - Docker 19.03.8
    - Docker Compose 1.25.5
- Deployer 6.7.1
- PHPUnit 7.5.20
- X-debug

## インフラ構成図

<img width="500" alt="インフラ構成図" src="https://user-images.githubusercontent.com/61341861/81751795-180dbb80-94eb-11ea-8e9c-37bdb2c36da8.png">

## 機能一覧

- 投稿機能(ログイン後のみ可能)
- 投稿一覧機能
- ページネーション機能
- 投稿検索機能
- 投稿詳細・コメント一覧表示機能
- 投稿へのコメント登録機能(ログイン後のみ可能)
- コメント削除機能(自分が登録したものについてのみ可能)
- いいね！機能(ログイン後のみ可能)
- 投稿編集機能(自分が登録したものについてのみ可能)
- 投稿削除機能(自分が登録したものについてのみ可能)
- ユーザー登録機能
- ユーザー詳細表示機能
    - 該当ユーザーによる投稿一覧機能
    - 該当ユーザーによるいいね！一覧機能
    - ユーザー更新機能(プロフィール画像アップロード含む)
- ログイン機能
- おためしログイン機能(ゲストユーザーとしてログイン)
- 機能テスト

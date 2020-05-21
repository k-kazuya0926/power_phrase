## Power Phrase

心に残った言葉(パワーフレーズ)とそのエピソードを共有するサイトです。  

<img width="1965" alt="トップページ" src="https://user-images.githubusercontent.com/61341861/80930901-78b53e00-8df1-11ea-8872-fcded95ca332.png">

## URL

https://www.power-phrase.com/

ヘッダーにある「おためしログイン」をクリックするとゲストユーザーとしてログインできます。

## 使用技術

- PHP 7.1.33
- Laravel 5.8.38
- Bootstrap 4.1.3
- nginx 1.16.1
- Composer 1.10.1
- AWS
    - EC2(Amazon Linux 2)
    - RDS(MySQL 5.7)
    - Route53
    - ALB
    - ACM
- Deployer 6.7.1
- Docker Desktop for Mac 2.2.0.3(nginx+PHP-FPM+MySQLの開発環境構築)
    - Docker 19.03.5
    - Docker Compose 1.25.4
- PHPUnit 7.5.20
- Larastan 0.4.3(静的解析)

## インフラ構成図

<img width="500" alt="インフラ構成図" src="https://user-images.githubusercontent.com/61341861/81751795-180dbb80-94eb-11ea-8e9c-37bdb2c36da8.png">

## 機能一覧

- 投稿機能(ログイン後のみ可能)
- 投稿一覧機能
- ページネーション機能
- 投稿検索機能
- 投稿詳細・コメント一覧表示機能
- 投稿へのコメント登録機能
- いいね！機能(ログイン後のみ可能)
- 投稿編集機能(自分が投稿したものについてのみ可能)
- 投稿削除機能(自分が投稿したものについてのみ可能)
- ユーザー登録機能
- ログイン機能
- おためしログイン機能(ゲストユーザーとしてログイン)
- 機能テスト

v## Power Phrase

心に残った言葉(パワーフレーズ)とそのエピソードを共有するサイトです。  

<img width="1965" alt="スクリーンショット 2020-05-04 10 23 41" src="https://user-images.githubusercontent.com/61341861/80930901-78b53e00-8df1-11ea-8872-fcded95ca332.png">

## URL

https://www.power-phrase.com/

ヘッダーにある「おためしログイン」をクリックするとゲストユーザーとしてログインできます。

## 使用技術

- PHP 7.1.33
- Laravel 5.8.38
- Apache 2.4.41
- Composer 1.10.1
- UIKit 3.1.6
- AWS
    - EC2(Amazon Linux 2)
    - RDS(MySQL 5.7)
    - Route53
    - ALB
    - ACM
- Deployer 6.7.1
- Docker Desktop for Mac 2.2.0.3(Apache+PHP+MySQLの開発環境構築)
    - Docker 19.03.5
    - Docker Compose 1.25.4
- Larastan 0.4.3(静的解析)
- PHPUnit 7.5.20

## 機能一覧

- 投稿機能(ログイン後のみ可能)
- 投稿一覧機能
- ページネーション機能
- 投稿詳細・コメント一覧表示機能
- 投稿へのコメント登録機能
- 投稿編集機能(自分が投稿したものについてのみ可能)
- 投稿削除機能(自分が投稿したものについてのみ可能)
- ユーザー登録機能
- ログイン機能
- おためしログイン機能(ゲストユーザーとしてログイン)
- ユニットテスト

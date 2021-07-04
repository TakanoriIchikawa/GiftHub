## Gift Hub
感謝の気持ちをポイントを贈ることで伝えるWebアプリケーションです。  
貰ったポイントは好きな景品と交換できます。  
http://54.238.172.200/login 
| メールアドレス | パスワード |
| ---- | ---- |
| `chiaki0223@test.com` | `chiaki0223` |

![screencapture-gift-hub-dashboard-2021-06-30-05_04_28](https://user-images.githubusercontent.com/53390190/123860582-0c848a80-d961-11eb-98ee-eacc04a30cd6.png)

## システム概要
フロントは**Vue.js**、バックエンドは**Laravel**のSPA構築です。  
インフラは**AWS**を利用しています。  
レスポンシブ対応。テストコードも書いてます。  

## 使用技術
- PHP 7.4.19
- Laravel 6.20.23
- Vue.js 2.5.17
- Bootstrap 4.6.0
- MySQL 8.0.20
- AWS
    - EC2
        - Amazon Linux 2
        - nginx
        - php-fpm
    - RDS
        - MySQL
    - S3
    - Route53
    - VPC
    - SNS

## 機能
- 認証系
    - ユーザー登録
    - ログイン
- 友達登録系
    - 名前検索機能
    - 友達追加機能
- チャット系
    - メッセージ送信機能
- ポイント系
    - ポイント（贈る用）チャージ機能
    - ポイント贈与機能
- 景品系
    - 景品交換機能
- その他
    - ダッシュボード
    - プロフィール編集機能
    - レスポンシブデザイン

## テスト
PHPUnitl
- フィーチャーテスト
    - API単位
- ユニットテスト
    - 関数単位


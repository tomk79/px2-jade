tomk79/px2-jade
======================

Pickles 2 用のプラグインです。
Jade文法でコンテンツをコーディングできる機能を追加します。

Jadeパーサーとして ["ronan-gloo/jade-php"](https://github.com/ronan-gloo/jade-php) をラップしたものです。


## 導入手順 - Setup

### 1. composer.json に tomk79/px2-jade を追加

require の項目に、"tomk79/px2-jade" を追加します。

```
{
	〜 中略 〜
    "require": {
        "php": ">=5.3.0" ,
        "tomk79/px-fw-2.x": "2.0.*",
        "tomk79/px2-jade": "2.0.*"
    },
	〜 中略 〜
}
```


追加したら、`composer update` を実行して変更を反映することを忘れずに。

```
$ composer update
```


### 2. config.php に、機能を追加

設定ファイル config.php (通常は `./px-files/config.php`) を編集します。
`$conf->funcs->processor` に、プロパティ `jade` を追加します。これは、コンテンツの拡張子が jade の場合(例：index.html.jade など)にコールされることを意味します。
`tomk79\pickles2\jade\jade::exec_ext` を処理した後、標準的な HTML の処理を行うように設定します。

下記は設定サンプルです。通常、コピー&ペーストで動作するはずです。

```
	$conf->funcs->processor->jade = [
		// Jade文法を処理する
		'tomk79\pickles2\jade\jade::exec_ext' ,

		// html の処理を追加
		$conf->funcs->processor->html ,
	];
```

Pickles2 の設定をJSON形式で編集している方は、config.json の該当箇所に追加してください。



## ライセンス - License

MIT License


## 作者 - Author

- (C)Tomoya Koyanagi <tomk79@gmail.com>
- website: <http://www.pxt.jp/>
- Twitter: @tomk79 <http://twitter.com/tomk79/>


## for Developer

### Test

```
$ ./vendor/phpunit/phpunit/phpunit tests/px2-jadeTest.php px2Jade
```

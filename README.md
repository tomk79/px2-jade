tomk79/px2-jade
======================

[Pickles 2](http://pickles2.pxt.jp/) 用のプラグインです。
Pug(Jade)文法でコンテンツをコーディングできる機能を追加します。

Pug(Jade)パーサー ["kylekatarnls/jade-php"](https://github.com/kylekatarnls/jade-php) をラップしたものです。


## 導入手順 - Setup

### 1. `composer.json` に `tomk79/px2-jade` を設定する

`require` の項目に、`tomk79/px2-jade` を追加します。

```
{
	〜 中略 〜
    "require": {
        "php": ">=5.3.0" ,
        "pickles2/px-fw-2.x": "^2.0",
        "tomk79/px2-jade": "^2.0"
    },
	〜 中略 〜
}
```


### 2. composer update を実行する

追加したら、`composer update` を実行して変更を反映することを忘れずに。

```
$ composer update
```


### 3. `config.php` に、設定を追加する

設定ファイル `config.php` (通常は `./px-files/config.php`) を編集します。
`$conf->funcs->processor` に、プロパティ `jade` を追加します。これは、コンテンツの拡張子が `jade` の場合(例：`index.html.jade` など)にコールされることを意味します。
`tomk79\pickles2\jade\jade::exec_ext` を処理した後、標準的な HTML の処理を行うように設定します。

下記は設定サンプルです。

```php
	$conf->funcs->processor->jade = [
		// Jade文法を処理する
		'tomk79\pickles2\jade\jade::exec_ext' ,

		// html の処理を追加
		$conf->funcs->processor->html ,
	];
```

拡張子 `.pug` に適用したい場合は、 `$conf->funcs->processor->pug` に設定してください。

### 4. Pug(Jade)コンテンツを記述する

ファイル名の後ろに `.jade` を付加したコンテンツが、Jade文法として処理されます。(例： `index.html` の場合、 `index.html.jade` にリネームする)

```jade
div
	p sample text
```


## 更新履歴 - Change log

### tomk79/px2-jade 2.0.1 (2017年8月3日)

- パーサーライブラリを `ronan-gloo/jadephp` から `pug-php/pug` に変更。

### tomk79/px2-jade 2.0.0 (2015年1月27日)

- Initial Release.


## ライセンス - License

MIT License


## 作者 - Author

- (C)Tomoya Koyanagi <tomk79@gmail.com>
- website: <http://www.pxt.jp/>
- Twitter: @tomk79 <http://twitter.com/tomk79/>


## for Developer

### Test

```
$ ./vendor/phpunit/phpunit/phpunit
```

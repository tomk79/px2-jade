<?php
/**
 * px2-jade.php
 */
namespace tomk79\pickles2\jade;

/**
 * px2-jade.php
 */
class jade{

	/**
	 * 変換処理の実行
	 * @param object $px Picklesオブジェクト
	 */
	public static function exec_ext( $px ){

		$data = $px->site()->get_current_page_info();

		foreach( $px->bowl()->get_keys() as $key ){
			$src = $px->bowl()->pull( $key );

			// Using Library "pug-php/pug" ==> see https://packagist.org/packages/pug-php/pug
			$pug = new \Pug\Pug(array(
				'prettyprint' => true,
				// 'extension' => '.pug',
				// 'cache' => 'pathto/writable/cachefolder/'
			));
			$src = $pug->render($src, $data);
			// var_dump($src);

			$src = $px->bowl()->replace( $src, $key );
		}

		return true;
	}

}

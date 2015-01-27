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

			// Using Library "ronan-gloo/jade-php" ==> see https://github.com/ronan-gloo/jade-php
			$jade = new \Jade\Jade([
				'prettyprint' => true,
				// 'extension' => '.jade',
				// 'cache' => $px->realpath_plugin_private_cache('jade_caches/'),
			]);
			ob_start();
			$results = $jade->render($src, $data);
			$src = ob_get_clean();

			$src = $px->bowl()->replace( $src, $key );
		}

		return true;
	}

}
<?php
/**
 * Test for tomk79\px2-jade
 * 
 * $ cd (project dir)
 * $ ./vendor/phpunit/phpunit/phpunit tests/px2-jadeTest.php px2Jade
 */

class px2JadeTest extends PHPUnit_Framework_TestCase{

	/**
	 * ファイルシステムユーティリティ
	 */
	// private $fs;

	/**
	 * setup
	 */
	public function setup(){
		// $this->fs = new \tomk79\filesystem();
	}

	/**
	 * 標準的JADE文法解釈テスト
	 */
	public function testStandardJade(){

		// とってもシンプルなJADEを実行してみる
		$output = $this->passthru( [
			'php',
			__DIR__.'/testData/standard/.px_execute.php' ,
			'/sample_pages/sample1.html' ,
		] );

		$this->assertEquals( 1, preg_match('/'.preg_quote('<p class=\'center\'>','/').'(?:\r\n|\r|\n)\s*'.preg_quote('sample text','/').'(?:\r\n|\r|\n)\s*'.preg_quote('</p>','/').'/s', $output) );

		// 後始末
		$output = $this->passthru( [
			'php',
			__DIR__.'/testData/standard/.px_execute.php' ,
			'/?PX=clearcache' ,
		] );

	}//testStandardJade()

	/**
	 * インライン(style要素)で書いたCSSが出力されてるかテスト
	 */
	public function testJadeWithInlineStyleSheet(){

		// とってもシンプルなJADEを実行してみる
		$output = $this->passthru( [
			'php',
			__DIR__.'/testData/standard/.px_execute.php' ,
			'/sample_pages/sample2.html' ,
		] );

		$this->assertEquals( 1, preg_match('/'.preg_quote('<style type=\'text/css\'>','/').'/s', $output) );
		$this->assertEquals( 1, preg_match('/'.preg_quote('.cont_exam{','/').'/s', $output) );
		$this->assertEquals( 1, preg_match('/'.preg_quote('font-size:120%;','/').'/s', $output) );
		$this->assertEquals( 1, preg_match('/'.preg_quote('<p class=\'cont_exam\'>','/').'/s', $output) );
		$this->assertEquals( 1, preg_match('/'.preg_quote('スタイルが効いていれば、文字が赤くなっているはずです。','/').'/s', $output) );

		// 後始末
		$output = $this->passthru( [
			'php',
			__DIR__.'/testData/standard/.px_execute.php' ,
			'/?PX=clearcache' ,
		] );

	}//testStandardJade()




	/**
	 * コマンドを実行し、標準出力値を返す
	 * @param array $ary_command コマンドのパラメータを要素として持つ配列
	 * @return string コマンドの標準出力値
	 */
	private function passthru( $ary_command ){
		$cmd = array();
		foreach( $ary_command as $row ){
			$param = '"'.addslashes($row).'"';
			array_push( $cmd, $param );
		}
		$cmd = implode( ' ', $cmd );
		ob_start();
		passthru( $cmd );
		$bin = ob_get_clean();
		return $bin;
	}// passthru()

}

<?php
/**
 * 安装界面
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */

error_reporting(E_ERROR | E_WARNING | E_PARSE);
@set_time_limit(1000);
@set_magic_quotes_runtime(0);

define('IN_WOC', TRUE);
define('IN_YJZZJ', TRUE);
define('ROOT_PATH', dirname(__FILE__).'/../');

require ROOT_PATH.'./install/include/install_var.php';
require ROOT_PATH.'./install/include/install_mysql.php';
require ROOT_PATH.'./install/include/install_function.php';
require ROOT_PATH.'./install/include/install_lang.php';

$view_off = getgpc('view_off');

define('VIEW_OFF', $view_off ? TRUE : FALSE);

$allow_method = array('show_license', 'env_check', 'app_reg', 'db_init', 'ext_info', 'install_check', 'tablepre_check');

$step = intval(getgpc('step', 'R')) ? intval(getgpc('step', 'R')) : 0;
$method = getgpc('method');

if(empty($method) || !in_array($method, $allow_method)) {
	$method = isset($allow_method[$step]) ? $allow_method[$step] : '';
}

if(empty($method)) {
	show_msg('method_undefined', $method, 0);
}

if(file_exists($lockfile) && $method != 'ext_info') {
	show_msg('install_locked', '', 0);
} elseif(!class_exists('dbstuff')) {
	show_msg('database_nonexistence', '', 0);
}

timezone_set();

$wochidden = getgpc('wochidden');

if(in_array($method, array('app_reg', 'ext_info'))) {
	$PHP_SELF = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	$bbserver = 'http://'.preg_replace("/\:\d+/", '', $_SERVER['HTTP_HOST']).($_SERVER['SERVER_PORT'] && $_SERVER['SERVER_PORT'] != 80 ? ':'.$_SERVER['SERVER_PORT'] : '');
	$default_ucapi = $bbserver.'/ucenter';
	$default_appurl = $bbserver.substr($PHP_SELF, 0, strpos($PHP_SELF, 'install/') - 1);
}

if($method == 'show_license') {

	show_license();

} elseif($method == 'env_check') {

	VIEW_OFF && function_check($func_items);

	env_check($env_items);

	dirfile_check($dirfile_items);

	show_env_result($env_items, $dirfile_items, $func_items);

} elseif($method == 'app_reg') {

	if(getgpc('install_woc') == 'yes') {
		header("Location: index.php?step=3&install_woc=yes");
		die;
	}

	if(VIEW_OFF) {

		show_msg('missing_parameter', '', 0);

	} else {

		show_form($form_app_reg_items, $error_msg);

	}

} elseif($method == 'db_init') {

	if(getgpc('install_woc') == 'yes') {
		define('WOCFULL', true);
	} else {
		define('WOCFULL', false);
	}

	$submit = true;

	$default_config = $_config = array();
	$default_configfile = './protected/config/main.php';

	if(!file_exists(ROOT_PATH.$default_configfile)) {
		exit('protected/config/main.php was lost, please reupload this  file.');
	} else {
		include ROOT_PATH.$default_configfile;
		$default_config = $_config;
	}

	if(file_exists(ROOT_PATH.CONFIG)) {
		include ROOT_PATH.CONFIG;
	} else {
		$_config = $default_config;
	}

	$dbhost = $_config['db'][1]['dbhost'];
	$dbname = $_config['db'][1]['dbname'];
	$dbpw = $_config['db'][1]['dbpw'];
	$dbuser = $_config['db'][1]['dbuser'];
	$tablepre = $_config['db'][1]['tablepre'];

	$error_msg = array();
	if(isset($form_db_init_items) && is_array($form_db_init_items)) {
		foreach($form_db_init_items as $key => $items) {
			$$key = getgpc($key, 'p');
			if(!isset($$key) || !is_array($$key)) {
				$submit = false;
				break;
			}
			foreach($items as $k => $v) {
				$tmp = $$key;
				$$k = $tmp[$k];
				if(empty($$k) || !preg_match($v['reg'], $$k)) {
					if(empty($$k) && !$v['required']) {
						continue;
					}
					$submit = false;
					VIEW_OFF or $error_msg[$key][$k] = 1;
				}
			}
		}
	} else {
		$submit = false;
	}

	if($submit && !VIEW_OFF && $_SERVER['REQUEST_METHOD'] == 'POST') {
		if($password != $password2) {
			$error_msg['admininfo']['password2'] = 1;
			$submit = false;
		}
		$forceinstall = isset($_POST['dbinfo']['forceinstall']) ? $_POST['dbinfo']['forceinstall'] : '';
		$dbname_not_exists = true;
		if(!empty($dbhost) && empty($forceinstall)) {
			$dbname_not_exists = check_db($dbhost, $dbuser, $dbpw, $dbname, $tablepre);
			if(!$dbname_not_exists) {
				$form_db_init_items['dbinfo']['forceinstall'] = array('type' => 'checkbox', 'required' => 0, 'reg' => '/^.*+/');
				$error_msg['dbinfo']['forceinstall'] = 1;
				$submit = false;
				$dbname_not_exists = false;
			}
		}
	}

	if($submit) {

		$step = $step + 1;
		if(empty($dbname)) {
			show_msg('dbname_invalid', $dbname, 0);
		} else {
			$link = @mysql_connect($dbhost, $dbuser, $dbpw);
			if(!$link) {
				$errno = mysql_errno($link);
				$error = mysql_error($link);
				if($errno == 1045) {
					show_msg('database_errno_1045', $error, 0);
				} elseif($errno == 2003) {
					show_msg('database_errno_2003', $error, 0);
				} else {
					show_msg('database_connect_error', $error, 0);
				}
			}

			if(mysql_get_server_info() > '4.1') {
				mysql_query("CREATE DATABASE IF NOT EXISTS `$dbname` DEFAULT CHARACTER SET ".DBCHARSET, $link);
			} else {
				mysql_query("CREATE DATABASE IF NOT EXISTS `$dbname`", $link);
			}

			if(mysql_errno()) {
				show_msg('database_errno_1044', mysql_error(), 0);
			}
			mysql_close($link);
		}

		if(strpos($tablepre, '.') !== false || intval($tablepre{0})) {
			show_msg('tablepre_invalid', $tablepre, 0);
		}

		$_config['connectionString'] = "mysql:host=$dbhost;dbname=$dbname";
		$_config['emulatePrepare'] = true;
		$_config['username'] = $dbuser;
		$_config['password'] = $dbpw;
		$_config['charset'] = 'utf8';
		$_config['tablePrefix'] = $tablepre;

		save_config_file(ROOT_PATH.CONFIG, $_config, $default_config);

		$db = new dbstuff;

		$db->connect($dbhost, $dbuser, $dbpw, $dbname, DBCHARSET);

		if(!VIEW_OFF) {
			show_header();
			show_install();
		}

		$sql = file_get_contents($sqlfile);
		$sql = str_replace("\r\n", "\n", $sql);

		runquery($sql);
		runquery($extrasql);

		touch($lockfile);
		VIEW_OFF && show_msg('initdbresult_succ');

		if(!VIEW_OFF) {
			echo '<script type="text/javascript">function setlaststep() {document.getElementById("laststep").disabled=false;window.location=\'index.php?method=ext_info\';}</script><script type="text/javascript">setTimeout(function(){window.location=\'index.php?method=ext_info\'}, 30000);</script><iframe src="../misc.php?mod=initsys" style="display:none;" onload="setlaststep()"></iframe>'."\r\n";
			show_footer();
		}

	}
	if(VIEW_OFF) {

		show_msg('missing_parameter', '', 0);

	} else {
		show_form($form_db_init_items, $error_msg);

	}

} elseif($method == 'ext_info') {
	@touch($lockfile);
	if(VIEW_OFF) {
		show_msg('ext_info_succ');
	} else {
		show_header();
		echo '</div><div class="main" style="margin-top: -123px;"><ul style="line-height: 200%; margin-left: 30px;">';
		echo '<p>'.lang('ext_info_succ').'</p>';
		echo '</ul></div>';
		echo '<p></p>';
		show_footer();
	}

} elseif($method == 'install_check') {

	if(file_exists($lockfile)) {
		show_msg('installstate_succ');
	} else {
		show_msg('lock_file_not_touch', $lockfile, 0);
	}

} elseif($method == 'tablepre_check') {

	$dbinfo = getgpc('dbinfo');
	extract($dbinfo);
	if(check_db($dbhost, $dbuser, $dbpw, $dbname, $tablepre)) {
		show_msg('tablepre_not_exists', 0);
	} else {
		show_msg('tablepre_exists', $tablepre, 0);
	}
}
<?
// the entry point
function autoload(string $className) {
	require $className . '.php';
}
spl_autoload_register('autoload');
$page = 'Home';
if (isset($_GET['page'])){
	$page = ucfirst($_GET['page']);
}
$Presenter = $page.'Presenter';
new $Presenter($page);
<? 
require_once('classes.php');

$db = new db($dbhost,$dbuser,$dbpass,$dbdata);  
$monsterID = (int)$_GET['monsterID'];
$getMonsterName = $db->getMonsterName($monsterID);

if ($getMonsterName == null) {
	echo "false";
} else {
	echo "true";
}
?>

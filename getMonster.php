<? 
require_once('classes.php');

$db = new db($dbhost,$dbuser,$dbpass,$dbdata);  
$v_monsterID = (int)$_GET['monsterID'];
$v_cLevel = ((int)$_GET['cLevel'] == 0) ? 1 : (int)$_GET['cLevel'];
$v_nextTo = (int)$_GET['nextTo'];

$getMax = $db->getMaxLevel($v_monsterID);
$maxXPval = $getMax['lowerLimit'];

$getCurrent = $db->getCurrentLevel($v_monsterID,$v_cLevel);
$currentLowerLimit = $getCurrent['lowerLimit'];
$currentNextTo = $getCurrent['toNextLevel'];

if ($getMax['maxLevel'] - $v_cLevel == 1 && $v_nextTo != 0) {
	$XPReq = $v_nextTo;
} else if ($v_nextTo == 0) {
	$XPReq = $maxXPval - $currentLowerLimit;
} else {
	$XPReq = $maxXPval - ($currentLowerLimit + $currentNextTo) + $v_nextTo;
}

$return = array("monsterTier" => $getMax['monsterTier'], "XPReq" => $XPReq, "nextLevel" => $getCurrent['toNextLevel']);

//var_dump($return);

echo json_encode($return);

?>

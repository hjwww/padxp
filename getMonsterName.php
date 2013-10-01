<? 
require_once('classes.php');

$db = new db($dbhost,$dbuser,$dbpass,$dbdata);  
$v_monsterID = (int)$_GET['monsterID'];
$getMonsterName = $db->getMonsterName($v_monsterID);

//$monsterIcon = createIcon($v_monsterID,100,$getMonsterName["monsterName"]);
//echo $monsterIcon;
//$andOne = array("monsterIcon" => $monsterIcon);
//$return = array_merge($getMonsterName, $andOne);

//return output
//var_dump($getMonsterName);
echo json_encode($getMonsterName);
?>

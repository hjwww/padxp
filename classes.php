<?php  
require_once('config.php');

class db  {  
    public $mysqli;  


    function __construct($dbhost, $dbuser, $dbpass, $dbname) {  
		$this->mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    }  
  
    function getMonsterName($monsterID) {  
		$query = "
			SELECT mt.monsterID, mt.maxLevel, mt.monsterTier, ml.lowerLimit xpLimit, monsterName
			FROM Monsters mt
			LEFT JOIN MonsterLevels ml ON mt.monsterTier = ml.tier
				AND mt.maxLevel = ml.level
			WHERE mt.monsterID =" . $monsterID;
		$result = $this->mysqli->query($query);  
		$return = $result->fetch_assoc();
		return $return;  
    }  
	
	function getMaxLevel($monsterID) {  
		$query = "
			SELECT mt.monsterID, mt.maxLevel, mt.monsterTier, ml.lowerLimit, monsterName
			FROM Monsters mt
			LEFT JOIN MonsterLevels ml ON mt.monsterTier = ml.tier
				AND mt.maxLevel = ml.level
			WHERE mt.monsterID = " . $monsterID;
		$result = $this->mysqli->query($query);  
		$return = $result->fetch_assoc();
		return $return;  
	} 

	function getCurrentLevel($monsterID,$level) {  
		$query = "
			SELECT mt.monsterID, ml.level curLevel, mt.monsterTier, ml.lowerLimit, toNextLevel
			FROM Monsters mt join MonsterLevels ml 
			on mt.monsterTier = ml.tier 
			WHERE mt.monsterID = " . $monsterID . "
			and ml.level = " . ($level + 0);
		$result = $this->mysqli->query($query);  
		$return = $result->fetch_assoc();
		return $return;  
	} 
	
	function getLevels($monsterID) {  
		$query = "
			select * 
			from MonsterLevels
			where tier = (select monsterTier from Monsters where monsterID = " . $monsterID . ")
				and level <= (select maxLevel from Monsters where monsterID = " . $monsterID . ")";
		$result = $this->mysqli->query($query);  
		$return = $result->fetch_assoc();
		return $return;  
    }
	
	/* SELECT * 
		, (select sum(toNextLevel) from MonsterLevels where tier = ml.tier and level <= ml.level) xp
		FROM MonsterLevels ml WHERE tier = 150 */
}  

/*
function createIcon($id,$size = "100",$alt = NULL) {
	$paddedNumber = str_pad($id, 3, '0', STR_PAD_LEFT);
	return "<img src=\"/images/$paddedNumber.png\" height=\"$size\" weight=\"$size\" title=\"$alt\"  alt=\"$alt\">";
}
*/
?> 

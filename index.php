<html>
<head>
	<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
	<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=UTF-8">

	<title>PAD XP Calculator</title>
	<link href="css/style.css" media="screen" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="/padxpicon.png" type="image/x-icon" />
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/jquery.validate.min.js" type="text/javascript"></script>
	<script src="js/padxp.js" type="text/javascript"></script>
</head>
<body>
<h1 class="title">PAD XP Calculator</h1>

<iframe name="statusFrame" src="" width="100%" height="200" style="position: absolute; left: -10000px;" ></iframe> <!-- -->

<table>
<tr><td valign="top">
	<div id="form_section">
		<form id="PADform" name="padForm" method="post" autocomplete="off" target="statusFrame">   <!-- action="getMonster.php" -->
			<input type="hidden" id="hMonsterID" name="hMaxLevel" value="">
			<input type="hidden" id="hMaxLevel" name="hMaxLevel" value="">
			<input type="hidden" id="hLevelUp" name="hLevelUp" value="">
			<fieldset>
				<table>
					<tr><td class="label"><label for="monsterID" class="req">Monster No.</label></td> 
						<td><input type="text" id="monsterID" name="monsterID" class="textInput" maxlength="3" />
							</td></tr>
					<tr><td></td> 
						<td class="hint"><span id="mHint">Enter # between 1 - 683.</span></td></tr>

					<tr><td class="label"><label for="cLevel" class="req">Current Level</label></td>
						<td><input type="text" id="cLevel" name="cLevel" class="textInput" maxlength="2" />
							</td></tr>
					<tr><td></td> 
						<td class="hint"><span id="cHint">&nbsp;</span></td></tr>

					<tr><td class="label"><label for="nextTo" class="req">Next Level In</label></td>
						<td><input type="text" id="nextTo" name="nextTo" class="textInput" />
							</td></tr>
					<tr><td></td> 
						<td class="hint"><span id="lHint">&nbsp;</span></td></tr>
					<!-- 
					<tr><td colspan="2" class="button" align="right"><button type="submit">Calculate</button></td></tr>
					-->
				</table>
			</fieldset>
		</form>
	</div>
	
	</td>
	
	<td valign="top" id="monsterDisplay">
		<div id="selectedMonster" class="">
			<span id="monsterIcon"><img src="/images/000.png" height="100" weight="100"></span>
			<span id="monsterName"></span>
		
		</div>
		<div id="maxDiv" class="">
			<span id="maxLevel"></span>
		</div>
		<div id="toNextLevel" class="">
		
		</div>
		<div id="xpReqDiv" class="">
			<span id="xpReq"></span>
		</div>
	</td>
	
</tr>
</table>

</body>
</html>

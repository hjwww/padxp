function createIcon(id,size,alt) {
	size = (typeof size === 'undefined') ? '100' : size;
	alt = (typeof alt === 'undefined') ? '' : alt;
	paddedNumber = pad(id, 3, '0');
	return "<img src=\"/images/" + paddedNumber + ".png\" height=\"" + size + "\" weight=\"" + size + "\" title=\"" + alt + "\"  alt=\"" + alt + "\">";
}

function pad(n, width, z) {
  z = z || '0';
  n = n + '';
  return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

function getMonster(fromWhere){
	var monsterIDval = $("#monsterID").val().trim();
	var cLevelVal = $("#cLevel").val().trim();
	var nextToVal = $("#nextTo").val().trim();

	var maxLevelVal = $("#hMaxLevel").val().trim();
	var levelUpVal = $("#hLevelUp").val().trim();

	if (monsterIDval != '' && $("#monsterID").hasClass('error') == false && $("#cLevel").hasClass('error') == false && $("#nextTo").hasClass('error') == false) {
		 var urlGo = 'http://padxp.raphands.com/getMonster.php?monsterID='+monsterIDval+'&cLevel='+cLevelVal+'&nextTo='+nextToVal;
		// window.frames["statusFrame"].location = urlGo; #FOR TESTING
			$.get('getMonster.php?monsterID='+monsterIDval+'&cLevel='+cLevelVal+'&nextTo='+nextToVal, function(returnData) {
				if (!returnData) {
					// $("#selectedMonster").html('OOPS!');
				} else {
				
					var display = jQuery.parseJSON(returnData);
					//$("#selectedMonster").html(display[1] + "<br />No." + display[0] + " " + display[2]);

					if (display.monsterTier == "MAX") {
					
						$("#maxLevel").html("Monster is at MAX level.");
						$("#xpReq").html("");
						$("#cLevel").val('');
						$("#nextTo").val(''); 
						
					} else {
						//$("#maxLevel").html("Max Level = " + display[4]);
						$("#xpReq").html("XP Req = <b>" + display.XPReq +"</b>");
						$("#hLevelUp").val(display.nextLevel);
						$("#lHint").html("Enter # between 1 - " + display.nextLevel +".");
						//getMonster();
					}
				}
			});
	}
}

function clearFields() {
	$("#cLevel").val('');
	$("#nextTo").val('');
	$("#lHint").html("");
}


/* FORM VALIDATION */
$(document).ready(function() { 

    var validator = $("#PADform").validate({ 
        rules: { 
            monsterID: {
			  required: true,
			  digits: true,
			  //range: [1, 683], 
			  remote: "checkMonsterID.php"
			}, 
            cLevel: { 
                digits: true 
            }, 
            nextTo: { 
                digits: true 
            }
        }, 
        messages: { 
			cLevel: "Numbers only.",
			nextTo: "Numbers only.",
			monsterID: { 
                required: "Required.", 
				digits: "Numbers only.",
                remote: "Invalid ID." 
			}
        }, 
		
        // the errorPlacement has to take the table layout into account 
        errorPlacement: function(error, element) { 
            if (element.attr('name') == 'monsterID')
				error.appendTo($("#mHint"))
            else if (element.attr('name') == 'cLevel')
				error.appendTo($("#cHint"))
            else if (element.attr('name') == 'nextTo')
				error.appendTo($("#lHint"))
            
        }, 
        // prevent submit
		submitHandler: function(form) {
			form.action = "getMonster.php";
			//form.submit();
			//form.reset();
		},
        /* set this class to error-labels to indicate valid fields 
        success: function(label) { 
            // set   as text for IE 
            label.html(" "); //.addClass("checked");  &#8730;
        }//, */
		//onfocusout: true
    }); 


	// GET MONSTER NAME, CHECK MAX LEVEL
	$("#monsterID").blur(function(){
		//$("#PADform").validate();
		var monsterIDval = $(this).val().trim();
		if(monsterIDval != '' && $(this).hasClass('error') == false) {
			$.get('getMonsterName.php?monsterID='+monsterIDval, function(returnData) {
				if (!returnData) {
					// $("#selectedMonster").html('OOPS!');
				} else {
					var display = jQuery.parseJSON(returnData);
					
					//alert();
					$("#monsterIcon").html(createIcon(display.monsterID,100,display.monsterName));
					$("#monsterName").html("<br />No." + display.monsterID + " " + display.monsterName);
					
					if (display.monsterTier == "MAX") {
						$("#maxLevel").html("Monster is at MAX level.");
						$("#cHint").html("");
						$("#xpReq").html("");
						$("#cLevel").val('');
						$("#nextTo").val('');
						$("#hMaxLevel").val('');
						$("#hLevelUp").val('');
					} else {
						$("#maxLevel").html("Max Level = " + display.maxLevel);
						$("#xpReq").html("XP Req = <b>" + display.xpLimit + "</b>");
						$("#hMaxLevel").val(display.maxLevel);
						
						$("#cHint").html("Enter # between 1 - " + display.maxLevel +".");
						
						if (monsterIDval != $("#hMonsterID").val()) {
							clearFields();
							$("#hMonsterID").val(display.monsterID);
						} else {
						
						}
					}
				}
			});
		}
		
	});


	// CURRENT LEVEL INPUT BLUR
	$("#cLevel").blur(function(){
		var cLevelVal = $(this).val().trim();
		var maxLevelVal = parseInt($("#hMaxLevel").val().trim());

		if(cLevelVal != '' && maxLevelVal != '') {
			if (cLevelVal > maxLevelVal) {
				$("#cLevel").addClass('error');
				$("#maxLevel").addClass('error');
			} else if (cLevelVal == maxLevelVal) {
				$("#maxLevel").html("Monster is at MAX level.");
				$("#xpReq").html("");
			} else if ($("#hMaxLevel").val != 1) {
			//	$("#cLevel").addClass('error');
				$("#maxLevel").removeClass('error');
				getMonster("cLevel");
				
			}
			
		}
	});
	
		
	// NEXT TO INPUT BLUR
	$("#nextTo").blur(function(){
		var nextToVal = $(this).val().trim();
		var levelUpVal = parseInt($("#hLevelUp").val().trim());
		
		if(nextToVal != '' && levelUpVal != '') {
			if (nextToVal > levelUpVal) {
				$("#nextTo").addClass('error');
			//	$("#toNextLevel").addClass('error');
			} else if ($("#hMaxLevel").val != 1) {
			//	$("#cLevel").addClass('error');
			//	$("#toNextLevel").removeClass('error');
				getMonster("nextTo");
			}
		}
	});
	
	

	
}); 


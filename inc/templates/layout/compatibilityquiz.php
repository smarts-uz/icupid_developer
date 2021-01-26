<?
## block direct page access
defined( 'KEY_ID' ) or die( 'Restricted access' );
?>
<style type="text/css">
#featured_members{ display: none; }
</style>

<div id="main" class="compatibility_main">
    <div id="main_content_wrapper">     
    	<? if(isset($ERROR_MESSAGE) && strlen($ERROR_MESSAGE) > 3){ ?>
			<div id="messages">
				  <div style="" class="message-<?=$ERROR_TYPE ?>" id="main-message-<?=$ERROR_TYPE ?>">
				  <a class="dismiss-message" href="#" onclick="Effect.Fade('main-message-<?=$ERROR_TYPE ?>', { duration : 0.5 });; return false;"><img src="images/DEFAULT/_icons/16/menu.gif"></a>
				  <?=$ERROR_MESSAGE ?>
				</div>
				<script type="text/javascript" language="javascript">Effect.Pulsate('main-message-<?=$ERROR_TYPE ?>', { pulses : 2, duration : 1, from : 0.7 });</script>
			</div>
			<br/>
		<? } ?>
    	<form class="bills-form" id="msform" name="msform" method="post" action="<?=DB_DOMAIN?>index.php">
    		<input type="hidden" name="do" value="update">
    		<input type="hidden" name="do_page" value="compatibilityquiz">
    		<input type="hidden" name="uid" value="<?=$_SESSION['uid']?>">
			<div class="pagehead-title"><?=$LANG_COMPATIBILITY['content_heading'] ?></div>
			<?php echo getCompatibilityQuestions(); ?>
		</form>
	</div>
</div>


<script type="text/javascript">
	
	// checked question increment on this click event
	function checkedRadio(totalQuestions, groupid){
		
	  var radios = document.getElementsByClassName("blisslogictm_"+groupid);
		nbchecked = 0;
		
	    for (i = 0; i < radios.length; i++) {
	        if (radios[i].type == 'radio' && radios[i].checked) {
	            nbchecked++;
	        }
	    }
	   document.getElementById("total_questions_"+groupid).innerHTML = nbchecked+"/"+(totalQuestions);
	   document.getElementById("menu_total_questions_"+groupid).innerHTML = nbchecked+"/"+(totalQuestions);
	   
	   var priceEls = document.getElementsByClassName("menuCheckedTotal");
	  
	   var checkdata = 0;
	   var totaldata = 0;
		
		for (var i = 0; i < priceEls.length; i++) {
		  var price = priceEls[i].innerText;
		  var data = price.split('/');
		  checkdata += parseInt(data[0]);
		  totaldata += parseInt(data[1]);
		  
		}
	   document.getElementById("menuTotalQuestions").innerHTML = checkdata+"/"+(totaldata);
	   //var x = document.getElementById("percentageComplete").getAttribute("data-percent");
	   
	   var percentdata = Math.round((checkdata * 100) / totaldata);
	   document.getElementById("percentageComplete").removeAttribute('style');
	   document.getElementById("percentageComplete").style.width = percentdata+'%';
	   document.getElementById("completed").innerHTML = percentdata+"% Completed";
	   
	   return nbchecked;
	}
	// get next question click from bottom
	function getNextQuestions(key, groupid, totalQuestions){
		
		/*if(checkedRadio(totalQuestions, groupid) != totalQuestions){
			document.getElementById("errorTxt"+groupid).innerHTML = "Please fill all fields.";
		}else{*/
			document.getElementById("errorTxt"+groupid).innerHTML = "";
			var elements = document.getElementsByClassName("groupFieldset");
			for(var i=0; i<elements.length; i++) {
				if(i==(key+1)){
					elements[i].style.display = "block";
					document.getElementById("list_"+i).setAttribute("class", "active");
					document.body.scrollTop = document.documentElement.scrollTop = 0;			
				}else{
					elements[i].style.display = "none";
					document.getElementById("list_"+i).setAttribute("class", "");
				}
			    
			}
		//}
	}
	
	
	// get previous question click from bottom
	function getPreviousQuestions(key){
		var elements = document.getElementsByClassName("groupFieldset");
		for(var i=0; i<elements.length; i++) {
			if(i==parseInt(key - 1)){
				elements[i].style.display = "block";
				document.getElementById("list_"+i).setAttribute("class", "active");
			}else{
				elements[i].style.display = "none";
				document.getElementById("list_"+i).setAttribute("class", "");
			}
		    
		}
	}
	// get currect question click from menu
	function getCurrentQuestions(key){
		
		var elements = document.getElementsByClassName("groupFieldset");
	
		for(var i=0; i<elements.length; i++) {
			
			if(i == key){
				elements[i].style.display = "block";
				document.getElementById("list_"+i).setAttribute("class", "active");
			}else{
				elements[i].style.display = "none";
				document.getElementById("list_"+i).setAttribute("class", "");
			}
			  
		}
	}
</script>
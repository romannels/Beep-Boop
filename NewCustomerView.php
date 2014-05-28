<!DOCTYPE HTML>

<html>
<head>

   <title>Create Account</title>

       <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
       <link href="bootstrap.css" rel="stylesheet" media="screen">
       <script src="jquery.js" type="text/javascript"></script>
       <script src="bootstrap.js" type="text/javascript"></script> 
       <script>
           $(function() {
               $("#acc_template").change(function(){
                   var selected_template = $("#acc_template option:selected").val();
                   if (selected_template === "WEB"){
                       $("#custno, #custno_title").show();
                       $("#shipto, #shipto_title").hide();
                   } else if (selected_template === "SHIP") {
                       $("#custno, #custno_title, #shipto, #shipto_title").show();
                   } else {
                       $("#custno, #shipto, #custno_title, #shipto_title").hide();
                   }
               });
           });
       </script>
       <link rel="icon" type="image/ico" href="favicon.ico">
</head>
<body>
   

    <div class="navbar">
        <div class="navbar-inner">
           <a class="brand" href="WebAccountHome.php">Voss Web Accounts</a>
           <ul class="nav">
               <li><a href="WebAccountHome.php">Home</a></li>
               <li class="active"><a href="NewCustomer.php">New Account</a></li>
               <li><a href="http://reports.vosslighting.com/website_tools/accounts.asp">Current Accounts</a></li>
               <li><a href="http://reports.vosslighting.com/website_tools/shopping_lists.asp">Shopping Lists</a></li>
           </ul>
       </div>
    </div>
   
<div class="container">


<form name="frm" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table  class="table table-hover">
<tr>
<td>
<b>User Template</b>:<br />
<select name="acc_template" id="acc_template" selected="">
                               <!--  <option value="NULL">Please Select an Option</option> -->
<option value="WEB" <?php if (isset($_POST['acc_template'])) echo ($_POST['acc_template']== "WEB") ? "selected='selected'": ''; ?>>User</option>
                               <option value="SHIP"<?php if (isset($_POST['acc_template'])) echo ($_POST['acc_template']== "SHIP") ? "selected='selected'": ''; ?>>Ship To</option>
</select>        
</td>
<td>
                   <b id="custno_title" >Customer Number:</b><br />
                       <input type="text" id="custno" name="custno" value="<?php if(isset($_POST['custno'])) echo $_POST['custno']; ?>" size="8" placeholder="Customer Number"/> 
</td>
               <td >
                       <b id="shipto_title" <?php if (isset($_POST['acc_template'])) {if($_POST['acc_template'] == "SHIP") {echo ('style="display: inline;"');} else {echo ('style="display: none;"');}} else {echo ('style="display: none;"');}?>>Ship To:</b><br />
                       <input type="text" id="shipto" name="shipto" <?php if (isset($_POST['acc_template'])) {if($_POST['acc_template'] == "SHIP") {echo ('style="display: inline;"');} else {echo ('style="display: none;"');}} else {echo ('style="display: none;"');}?> value="<?php if(isset($_POST['shipto'])) echo $_POST['shipto']; ?>" size="8" placeholder="Ship To"/>
</td>
</tr>
<tr>
<td>
<b>Username</b>:<br />
<input type="text" name="acc_usr_name" value="<?php if(isset($_POST['acc_usr_name'])) echo $_POST['acc_usr_name']; ?>" size="30" placeholder="Username"/>
</td>
<td>
<b>Email Address</b>:<br />
<input class="span3" type="email" name="ctt_email" value="<?php if(isset($_POST['ctt_email'])) echo $_POST['ctt_email']; ?>" size="30" placeholder="example@yourdomain.com"/>
</td>
<td>
<b>Contact Name</b>:<br />
<input type="text" name="ctt_name" value="<?php if(isset($_POST['ctt_name'])) echo $_POST['ctt_name']; ?>" size="30" placeholder="Contact Name"/>
</td>
</tr>
<tr>
<td>
<b>Password</b>:<br />
<input type="password" name="acc_usr_password" value="<?php if(isset($_POST['acc_usr_password'])) echo $_POST['acc_usr_password']; ?>" size="30" placeholder="Password"/>
</td>
<td>
Password Reminder Question:<br />
                       <input type="text" name="acc_usr_pw_question" value="<?php if(isset($_POST['acc_usr_pw_question'])) {echo $_POST['acc_usr_pw_question'];} else {echo "Type the letter 'A' into the blank";} ?>" size="30"/>
</td>
<td>
Password Reminder Answer:<br />
                       <input type="text" name="acc_usr_pw_answer" value="<?php if(isset($_POST['acc_usr_pw_answer'])) {echo $_POST['acc_usr_pw_answer'];} else{echo "A";} ?>" size="30"/>
</td>
</tr>
</table>	
<table>        
       <tr>
<td>
<b>Phone Number</b>:<br />
<input class="span1" type="text" name="ctt_phone_num1" value="<?php if(isset($_POST['ctt_phone_num1'])) echo $_POST['ctt_phone_num1']; ?>"   maxlength="3"/> &ndash;
<input class="span1" type="text" name="ctt_phone_num2" value="<?php if(isset($_POST['ctt_phone_num2'])) echo $_POST['ctt_phone_num2']; ?>"  maxlength="3"/> &ndash;
<input class="span1" type="text" name="ctt_phone_num3" value="<?php if(isset($_POST['ctt_phone_num3'])) echo $_POST['ctt_phone_num3']; ?>"  maxlength="4"/>&nbsp;&nbsp;
Extension: <input class="span1" type="text" name="ctt_phone_xt" value="<?php if(isset($_POST['ctt_phone_xt'])) echo $_POST['ctt_phone_xt']; ?>"  maxlength="5"/>
</td>
</tr>
</table>
   <table>
<tr>
<td colspan="3">
<input class="btn btn-primary" type="submit" name="cmdSubmit" value="Create">
<input type="hidden" name="submitted" value="true">
             <td> 
             <td>                  
               <input type="checkbox" name="Esales" value="1">Email Salesman<br>
             <!--  <input type="checkbox" name="Ecust" value="1">Email customer -->
             </td>
       </tr>
<tr>
             <td colspan="3">
                 

                <!--  <button onclick="window.location.href='http://www.vosslighting.com/storefrontB2BWEB/login.do?action=prepare_login&login=T'" class="btn btn-info" type="button">VossLighting.com</button> -->
                <!--<input onclick="window.location.href='http://www.vosslighting.com/storefrontB2BWEB/index.do?action=i'" class="btn btn-info" type="submit" value="VossLighting.com"> -->
</td>
               </tr>
</table>
</form>
</div>
   <!-- THIS SEEMS TO MAKE IT MAD IF YOU DON'T REFRESH            
<div class="container">                 
   <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Vosslighting.com</button>
   <div class="modal fade" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
           <object data='http://www.vosslighting.com/storefrontB2BWEB/login.do?action=prepare_login&login=T' width="700" height="400"> <embed src='http://www.vosslighting.com/storefrontB2BWEB/login.do?action=prepare_login&login=T' width="600" height="400"> </embed> Error: Embedded data could not be displayed. </object>
       </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>  
     </div>
   </div>
</div>
-->

<div class="container">
   <object id="vosspage"data='http://www.vosslighting.com/storefrontB2BWEB/login.do?action=prepare_login&login=T' width="700" height="400"> <embed src='http://www.vosslighting.com/storefrontB2BWEB/login.do?action=prepare_login&login=T' width="600" height="400"> </embed> Error: Embedded data could not be displayed. </object>
</div>
   
<div class="container">
   <div class="row-fluid">
       <div class="span4">
<?php
require_once 'testertest.php';
//require_once 'NewCustomerBackend.php';
if(isset($_POST['submitted'])){
   switch($_POST['acc_template']){
       case 'WEB':
       $Newguy = new NewCustomer($_POST['submitted'],$_POST['acc_template'], $_POST['custno'], $_POST['acc_usr_name'],
           $_POST['ctt_email'], $_POST['ctt_name'], $_POST['acc_usr_password'], 
           $_POST['acc_usr_pw_question'], $_POST['acc_usr_pw_answer'], $_POST['ctt_phone_num1'],
           $_POST['ctt_phone_num2'], $_POST['ctt_phone_num3'], $_POST['ctt_phone_xt']);
           break;
       case 'SHIP':
       $Newguy = new NewShipTo($_POST['submitted'],$_POST['shipto'], $_POST['acc_template'], $_POST['custno'], $_POST['acc_usr_name'],
           $_POST['ctt_email'], $_POST['ctt_name'], $_POST['acc_usr_password'], 
           $_POST['acc_usr_pw_question'], $_POST['acc_usr_pw_answer'], $_POST['ctt_phone_num1'],
           $_POST['ctt_phone_num2'], $_POST['ctt_phone_num3'], $_POST['ctt_phone_xt']);        
           break;
       case 'GROUP': //Doesn't work due to forms issue
       $Newguy = new NewShipTo($_POST['submitted'], $_POST['SOMETHING'], $_POST['acc_template'], $_POST['custno'], $_POST['acc_usr_name'],
           $_POST['ctt_email'], $_POST['ctt_name'], $_POST['acc_usr_password'], 
           $_POST['acc_usr_pw_question'], $_POST['acc_usr_pw_answer'], $_POST['ctt_phone_num1'],
           $_POST['ctt_phone_num2'], $_POST['ctt_phone_num3'], $_POST['ctt_phone_xt']);         
           break;
       case 'NULL' : // No User Template selected (deactivated)
       $Newguy = new NewCustomer($_POST['submitted'],$_POST['acc_template'], NULL, $_POST['acc_usr_name'],
           $_POST['ctt_email'], $_POST['ctt_name'], $_POST['acc_usr_password'], 
           $_POST['acc_usr_pw_question'], $_POST['acc_usr_pw_answer'], $_POST['ctt_phone_num1'],
           $_POST['ctt_phone_num2'], $_POST['ctt_phone_num3'], $_POST['ctt_phone_xt']);
           echo"Something is wrong.";
           break;
       default:
           echo "You shouldn't be seeing this.";
           break;
   }

   $Newguy->FilterInput(); //checks for bad inputs
   $Interact = new DBInteract($Newguy); //instantiates a DBInteract object
   $Interact->DoppleGanger($Interact->DBcheck()); // alerts user to pre-exisiting account
   $Interact->DBUpdate(); // plugs info into database
  if(isset($_POST["Esales"])) {
      $email = new Email($_POST['ctt_email'],"sc@vosslighting.com",NULL, 
              $_POST['ctt_email'], $_POST['acc_usr_password'], 
              "sc@vosslighting.com", $_POST["Esales"], $_POST["Ecust"] = NULL,
              $_POST['acc_usr_name']);
   $email->sendit();// for sending canned response email to salesman
  }
}
?>
           </div> 
           </div>
       
</div>
   
</body>
</html>

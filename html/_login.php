<?php
/// Logout
////////////////////////////////////////////////////////
if(isset($_GET['logout']) || isset($_POST['logout']))
{
	// remove all session variables
	session_unset();

	// destroy the session
	session_destroy(); 
	echo '<!doctype html><html><head><meta http-equiv="Refresh" content="0; URL=index.php" /></head></html>';
                
} 

/// Login
////////////////////////////////////////////////////////
if(isset($_POST['login'])) 
{
	$messages = [];
	// Eingaben überprüfen:
	//if(!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $HelferName)) {
	//  $messages[] = 'Bitte prüfen Sie die eingegebenen Namen';
	//}

        //if (isset ($_POST['helfer-name'])) {	
	//  $HelferName = $_POST['helfer-name'];
        //} // delete - login shouldnt provide this 
	$HelferEmail = $_POST['helfer-email'];
	$HelferPasswort = $_POST['helfer-passwort']; 

	if(empty($messages)) 
	{
		HelferLogin($db_link,$HelferEmail,$HelferPasswort, 0 );
	} 
	else 
	{
		// Fehlermeldungen ausgeben:
		echo '<div class="error"><ul>';
		foreach($messages as $message) {
		echo '<li>'.htmlspecialchars($message).'</li>';
		}
		echo '</ul></div>';
	}
	
}

if(!isset($_SESSION["HelferID"]))
{

?>
<form method="post" action="#Info">

  <fieldset>
    <legend>Login</legend>
    
    <table border="0" style="border: 0px solid black;">
            <tr> 	
              <td style="border: 0px solid black;">Email</td></tr><tr><td style="border: 0px solid black;">
              <input name="helfer-email" type="text" size=35 value="<?=htmlspecialchars($HelferEmail??'')?>" required>
              </td>
            <tr>
            <tr> 	
              <td style="border: 0px solid black;">Passwort</td></tr>
              <tr><td style="border: 0px solid black;">
              <input name="helfer-passwort" id="helfer-passwort" type="password" size=35 value="<?=htmlspecialchars($HelferHandy??'')?>" required>
              </td><td style="border: 0px solid black;">
              <input type="button" value="Passwort zeigen" style="width:180px !important" onclick="showPassword('helfer-passwort')">
              </td>
            <tr>
	</table>
    
    
  </fieldset>
  
  <p><button style="width: 100px" name="login" value="1">Login</button></p>


 </form> 
<?php
 exit;	
}


$HelferID = $_SESSION["HelferID"];
$HelferName = $_SESSION["HelferName"];
$AdminID = $_SESSION["AdminID"];
//TODO vereinheitlichen. index.php verwendet HelferIsAdmin 
$HelferIsAdmin=$AdminStatus = $_SESSION["AdminStatus"];
$HelferLevel= $_SESSION["HelferLevel"];
?>
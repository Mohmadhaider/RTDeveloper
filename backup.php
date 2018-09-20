<?php
session_start();
error_reporting(0);
include_once 'src1/Google_Client.php';
include_once 'src1/contrib/Google_Oauth2Service.php';
require_once 'src1/contrib/Google_DriveService.php';

$client = new Google_Client();
$client->setClientId('534209108294-ndcesbksb7k8rv571dcsnfnhir2bhim3.apps.googleusercontent.com');
$client->setClientSecret('hMpLy9PvCEqeHOsmYL5zJKOq');
$client->setRedirectUri('https://rtdeveloper.herokuapp.com/backup.php');
$client->setScopes(array('https://www.googleapis.com/auth/drive.file'));
$path="upload_img/Albums/";

if (isset($_GET['code']) || (isset($_SESSION['access_token_google']))) {
	
	$service = new Google_DriveService($client);
	if (isset($_GET['code'])) {
		$client->authenticate($_GET['code']);
		$_SESSION['access_token_google'] = $client->getAccessToken();		
    } else
        $client->setAccessToken($_SESSION['access_token_google']);
    $sel=explode(";",$_SESSION["folder_name"]);
	//insert folder
	$fileName=$sel[0];
	$file = new Google_DriveFile();
    $file->setTitle($fileName);
    $file->setMimeType('application/vnd.google-apps.folder');
    $files = $service->files->insert($file, array());
    $par=$files["id"];
    for($i=1;$i<=sizeof($sel)-1;$i++){
    $fileName=$sel[$i];
	$file = new Google_DriveFile();
    $file->setTitle($fileName);
    $file->setMimeType('application/vnd.google-apps.folder');
    $parents=array();
    $parent = new Google_ParentReference();
    $parent->setId($par);
    array_push($parents, $parent);
    $file->setParents($parents);
    $files2 = $service->files->insert($file, array());
    $subper=$files2["id"];
    $arrr=explode(";",$_SESSION[$sel[$i]]);
    for($j=0;$j<=sizeof($arrr)-1;$j++)
    {
        $datas="";
       $datas=file_get_contents($arrr[$j]);
        $fileName=getDate()[0].microtime().'.jpeg';
    	$file = new Google_DriveFile();
    $file->setTitle($fileName);
    $file->setMimeType('image/jpeg');
    $parents2=array();
    $parent2 = new Google_ParentReference();
    $parent2->setId($subper);
    array_push($parents2, $parent2);
    $file->setParents($parents2);
    $files2 = $service->files->insert($file, array(
        'data' => $datas,
        'mimeType' => 'image/jpeg',
        'uploadType' => 'multipart',
    ));
    }
    }
    
    
	header('location:home.php');
	
} else {
    $authUrl = $client->createAuthUrl();
    header('Location: ' . $authUrl);
    exit();
}

?>

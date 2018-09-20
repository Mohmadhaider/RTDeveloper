<?php
	require_once "config.php";

	try {
		$accessToken = $helper->getAccessToken();
	} catch (\Facebook\Exceptions\FacebookResponseException $e) {
		echo "Response Exception: " . $e->getMessage();
		exit();
	} catch (\Facebook\Exceptions\FacebookSDKException $e) {
		echo "SDK Exception: " . $e->getMessage();
		exit();
	}

	
    $_SESSION["demo"]="Data to display";
	$oAuth2Client = $FB->getOAuth2Client();
	if (!$accessToken->isLongLived())
		$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
	$user_name = $FB->get("/me?fields=name", $accessToken);
	$userData = $user_name->getGraphNode()->asArray();
	$_SESSION['user_name']=$userData["name"];
	$get_name = $FB->get("/me?fields=albums{name,picture{url}}", $accessToken);
	$userData = $get_name->getGraphNode()->asArray();
	$url="https://graph.facebook.com/v3.1/me?fields=id%2Cname%2Calbums%7Bphotos%7Bimages%7D%7D&access_token=$accessToken";
    $st=file_get_contents($url);
	$image_data=json_decode($st,TRUE);
	$_SESSION['userData']="";
	$_SESSION['thumb']="";
	$_SESSION["img_data"]="";
	$_SESSION['access_token'] = (string) $accessToken;
	$_SESSION["flag"]=1;
	$_SESSION["flag2"]=1;
	display($userData);
	display($image_data);
	function display($data)
	{
		foreach($data as $k=>$v)
		{
			if($k==="photos" and $_SESSION["flag"]==1)
			{
			   
				$_SESSION["img_data"]=$_SESSION["img_data"]."Next albums;";
				$_SESSION["flag"]=0;
			}
			
			if($k=="images")
				{
					$_SESSION["flag2"]=0;
				}
			if(is_array($v))
			{
				display($v);
			}
			else
			{
			    if($k=="next")
			{
			    get_imgs_page($v);
			}
				if($k=="name" || $_SESSION["flag2"]==0)
				{
				    if($k=="url")
				    {
				        $_SESSION["thumb"]=$_SESSION["thumb"].$v.";";
				    }
					if($k=="name")
						$_SESSION["userData"]=$_SESSION["userData"].$v.";";
					if($k=="source"){
						$_SESSION["img_data"]=$_SESSION["img_data"].$v.";";
						$_SESSION["flag"]=1;
						$_SESSION["flag2"]=1;
					}
				}
			}
		}
		
	}
	function get_imgs_page($link)
	{
	    
	    if(!is_array($link)){
	    $url=$link;
        $st=file_get_contents($url);
	    $image_data_page=json_decode($st,TRUE);
	    }
	    else
	    {
	        $image_data_page=$link;
	    }
	    foreach($image_data_page as $k=>$v)
	    {
	        if($k=="images")
	        {
	            $_SESSION["flg"]=0;
	        }
	        if(is_array($v))
	        {
	            get_imgs_page($v);
	        }
	        if(!is_array($v))
	        {
	            if($k=="source" && $_SESSION["flg"]==0)
	            {
	                $_SESSION["img_data"]=$_SESSION["img_data"].$v.";";
	                $_SESSION["flg"]=1;
	            }
	            if($k=="next")
	            {
	                get_imgs_page($v);
	            }
	            
	        }
	    }
	}
	$arr=explode(";",$_SESSION["userData"]);
	$cn=-1;
	$imgs=explode(";",$_SESSION["img_data"]);
	foreach($imgs as $img)
	{
	    if($img=="Next albums")
	    {
	        $cn++;
	        $_SESSION[$arr[$cn]]="";
	        }
	    else
	    {
	        $_SESSION[$arr[$cn]]=$_SESSION[$arr[$cn]].$img.";";
	    }
	}
	header("location:home.php");
	exit();
?>
<?php 	@session_start();

    ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Profile</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<style>#myProgress {
  width: 100%;
  background-color: #ddd;
}
  .center-fit {
   max-width: 100%;
   max-height: 100vh;
   margin: auto;
  }
#myBar {
  width: 10%;
  height: 30px;
  background-color: #4CAF50;
  text-align: center;
  line-height: 30px;
  color: white;
}
body {
  font-family: Verdana, sans-serif;
  margin: 0;
}

* {
  box-sizing: border-box;
  margin: 0;
   padding: 0;
}

.row > .column {
  padding: 0 8px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column {
  float: left;
  width: 25%;
}

/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
  display: grid;
   height: 100%;
}

.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

</style>

</head>
<body style='background-color:royalblue'><center><div style='margin-right:25%; margin-left:25%; margin-top:10%;margin-bottom:15%; background-color:white;'><br><br><form>
    <br>
    <h2>RT Developer</h2>
    <hr>
	<ul>
		<?php
			$imgarr=explode(";",$_SESSION["thumb"]);
			$arr=explode(";",$_SESSION["userData"]);
			$i=0;
			for($i=0;$i<count($arr)-1;$i++)
			{
				echo "<li>-<b>".$arr[$i]."</b><br><img src=".$imgarr[$i]." style='height:auto; width:20%;' onclick='slide($i);openModal();currentSlide(1)' class='hover-shadow cursor'/><br><br><input type='checkbox' value=$i name='checkbox$i'/>  <button name='download' value=$i>Download</button><button name='upload' value=$i>Upload</button></li><br><hr><br>";
			}
			
			?>
			</ul>
			
			<div id="myModal" class="modal" >
			    <span class="close cursor" onclick="closeModal()" >&times;</span>
                <div class="modal-content" id="div_main">
                    <div id="main_div">
                        
                    </div>
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>

                    <div class="caption-container">
                    <p id="caption"></p>
                     </div>
                 </div>
            </div>
<script>
var no;
			    function slide(num)
			    {
			        
			        no=num;
			        var cnt=-1;
var img='<?php echo $_SESSION["img_data"]; ?>';
var imgs=img.split(";");
var ele=document.getElementById("main_div");
ele.parentNode.removeChild(ele);
var divmain=document.getElementById("div_main");
var divnew=document.createElement("div");
divnew.setAttribute("id","main_div");
divmain.appendChild(divnew);
for(var i=0;i<imgs.length;i++)
{
    
	if(imgs[i]=="Next albums")
	{
		cnt++;
		i++;
	}
	if(cnt==no)
	{
	    var id=document.getElementById("main_div");
		var div=document.createElement("div");
		div.setAttribute("class","mySlides");
		var img=document.createElement("img");
		img.setAttribute("class","center-fit");
		img.setAttribute("src",imgs[i]);
		div.appendChild(img);
		id.appendChild(div);
	}

}

			    }
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
			<?php echo "<button name='download_select' >Download Selected</button><button name='download_all' value=".($i-1).">Download All</button><br><button name='upload_select' >Upload Selected</button><button name='upload_all' value=".($i-1).">Upload All</button>";
			
			if(isset($_REQUEST["upload"]))
			{
			    $_SESSION["folder_name"]="";
			    $number=$_REQUEST["upload"]+1;
				$_SESSION['alb_name']=$arr[$number-1];
				$_SESSION["folder_name"]="facebook_".$_SESSION["user_name"]."_album;".$arr[$number-1];
				echo "<script>alert('The link is generated bellow');</script>";
				echo "<br>Click <a href='backup.php' name='download_link'>here</a> to Upload<br>";
				//create_zip_for_upload('upload_img/Albums');
				

			}
			if(isset($_REQUEST["upload_all"]))
			{
			    $_SESSION["folder_name"]="";
			    $_SESSION["folder_name"]="facebook_".$_SESSION["user_name"]."_album;".$_SESSION["userData"];

set_error_handler("customError");
echo "<script>alert('The link is generated bellow');</script>";
echo "<br>Click <a href='backup.php' name='download_link'>here</a> to Upload<br>";
//create_zip_for_upload('upload_img/Albums');


			}
			if(isset($_REQUEST["upload_select"]))
			{
			    $_SESSION["folder_name"]="";
			    $_SESSION["folder_name"]="facebook_".$_SESSION["user_name"]."_album;";
				for($j=0;$j<$i;$j++)
				{
					if(isset($_REQUEST['checkbox'.$j]))
					{
					$_SESSION["folder_name"]=$_SESSION["folder_name"].$arr[$j].";";
						
					}
				
				}
				set_error_handler("customError");
				echo "<script>alert('The link is generated bellow');</script>";
				echo "<br>Click <a href='backup.php' name='download_link'>here</a> to Upload<br>";
				//create_zip_for_upload('upload_img/Albums/Selected');
				
			
			}
			
			if(isset($_REQUEST["download_select"]))
			{
			     
			     
				for($j=0;$j<$i;$j++)
				{
					if(isset($_REQUEST['checkbox'.$j]))
					{
						$number=$j;
				$_SESSION['alb_name']=$arr[$number];
				if(!is_dir('New Folder/Albums/Selected/'.$_SESSION['user_name'].'/'.$arr[$number]))
					mkdir('New Folder/Albums/Selected/'.$_SESSION['user_name'].'/'.$arr[$number],0777,true);
				$imgs=explode(";",$_SESSION["img_data"]);
				$cnt=0;
				foreach($imgs as $img)
				{
					if($img=="Next albums")
					{ 
						$cnt++;
						echo "Aulbm no ".$cnt;
						continue;
					}
					if($cnt==$number+1)
					{
						$url=$img;
						$image='New Folder/Albums/Selected/'.$_SESSION['user_name'].'/'.$arr[$number].'/'.getDate()[0].microtime().'.jpg';
						file_put_contents($image, file_get_contents($url));
					}
				}
					}
				
				}
				set_error_handler("customError");
				create_zip('New Folder/Albums/Selected');
				delete_files('New Folder/Albums/Selected/');
			}
			if(isset($_REQUEST["download"]))
			{
				
				$number=$_REQUEST["download"]+1;
				$_SESSION['alb_name']=$arr[$number-1];
				if(!is_dir('New Folder/Albums/'.$_SESSION['user_name'].'/'.$number.'/'.$arr[$number-1]))
					mkdir('New Folder/Albums/'.$_SESSION['user_name'].'/'.$number.'/'.$arr[$number-1],0777,true);
				$imgs=explode(";",$_SESSION["img_data"]);
				$cnt=0;
				set_error_handler("customError");
				foreach($imgs as $img)
				{
					if($img=="Next albums")
					{ 
						$cnt++;
						continue;
					}
					if($cnt==$number)
					{
						$url=$img;
						$image='New Folder/Albums/'.$_SESSION['user_name'].'/'.$number.'/'.$arr[$number-1].'/'.getDate()[0].microtime().'.jpg';
						file_put_contents($image, file_get_contents($url));
					}
				}
				set_error_handler("customError");
				create_zip('New Folder/Albums/'.$_SESSION['user_name'].'/'.$number);
				delete_files('New Folder/Albums/'.$_SESSION['user_name']);
}
function create_zip($url)
				{
				if(!is_dir('Zips/users/'.$_SESSION['user_name']))
					mkdir('Zips/users/'.$_SESSION['user_name'],0777,true);
				$_SESSION['zips']='Zips/users/'.$_SESSION['user_name'].'/';
				delete_files($_SESSION['zips']);
				$rootPath = realpath($url);
				$zip = new ZipArchive();
				if(!is_dir('Zips/users/'.$_SESSION['user_name']))
					mkdir('Zips/users/'.$_SESSION['user_name'],0777,true);
				$name='Zips/users/'.$_SESSION['user_name'].'/'.$_SESSION['user_name']."_".getDate()[0].'.zip';
				$_SESSION['zip_file']='Zips/users/'.$_SESSION['user_name'].'/'.$_SESSION['user_name']."_".getDate()[0].'.zip';
				$zip->open($name, ZipArchive::CREATE | ZipArchive::OVERWRITE);
				$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath),RecursiveIteratorIterator::LEAVES_ONLY);
				foreach ($files as $name => $file)
				{
					if (!$file->isDir())
					{
						$filePath = $file->getRealPath();
						$relativePath = substr($filePath, strlen($rootPath) + 1);
						$zip->addFile($filePath, $relativePath);
					}
				}
				$zip->close();
				echo "<script>alert('The link is generated bellow');</script>";
				echo "<br>Click <a href='download.php?zip_file=".$_SESSION["zip_file"]."' name='download_link'>here</a> to download<br>";
				}


/* 
 * php delete function that deals with directories recursively
 */
 
				
				


function delete_files($target) {
try{
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file ){
            delete_files( $file );      
        }

        rmdir( $target );
set_error_handler("customError");
    } elseif(is_file($target)) {
        unlink( $target );  
    }
set_error_handler("customError");
}
catch(Exception $e)
{
 echo "Success";
}
}
				
if(isset($_REQUEST["download_all"]))
{
    
	$number=$_REQUEST["download_all"];
	echo $number;
	$imgs=explode(";",$_SESSION["img_data"]);
				$cnt=-1;
				foreach($imgs as $img)
				{
					if($img=="Next albums")
					{ 
						$cnt++;
						continue;
					}
					if(true)
					{
						if(!is_dir('New Folder/Albums/'.$_SESSION['user_name'].'/'.$arr[$cnt]))
							mkdir('New Folder/Albums/'.$_SESSION['user_name'].'/'.$arr[$cnt],0777,true);
						$url=$img;
						$image='New Folder/Albums/'.$_SESSION['user_name'].'/'.$arr[$cnt].'/'.getDate()[0].microtime().'.jpg';
						file_put_contents($image, file_get_contents($url));
					}
				}
		
set_error_handler("customError");
create_zip('New Folder');
delete_files('New Folder/Albums/'.$_SESSION['user_name']);
}
function customError($errno, $errstr) {
   echo "";
}

//set error handler
set_error_handler("customError");

		
function progress()
{?>
    <div id="myProgress">
  <div id="myBar">10%</div>
</div>

<br>

<script>
  var elem = document.getElementById("myBar");   
  var width = 10;
  var id = setInterval(frame, 100);
  function frame() {
    if (width >= 50) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
      elem.innerHTML = width * 1  + '%';
    }
  }
</script>
<?php }
		?>
	</form><br><br></div>
	</center>
</body>
</html>
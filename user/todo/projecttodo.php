<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/todo.css">
	<link rel="stylesheet" type="text/css" href="./css/projecttodo.css">
	<link rel="stylesheet" type="text/css" href="./css/yahei.css">
	<script type="text/javascript" src="./js/todo.js"></script>
	<script type="text/javascript" src="./js/protodo.js"></script>
</head>
<body>
	<div id="maindiv">
		<?php 
			session_start();
			if(isset($_SESSION['user'])){
				$name=$_SESSION['user'];
			}
			if(isset($_GET['protitle'])){
				$protitle=$_GET['protitle'];
			}else{
				$protitle=" ";
			}
			$mysqlipro = new mysqli('127.0.0.1', 'root', '', 'my_db');
			if(mysqli_connect_errno()){
				echo mysqli_connect_error();
			}
			$mysqlipro = mysqli_init();
			$mysqlipro->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);//设置超时时
			$mysqlipro->real_connect('127.0.0.1', 'root', '', 'my_db');
			$mysqlipro->query("set names 'utf8'");
			$querypro="SELECT * FROM `todoproject` WHERE `userid` = '$name' and `todoprojectname` = '$protitle' ";
			$resultspro=$mysqlipro->query($querypro);
			$rowpro = $resultspro->fetch_array();
		?>
		<script type="text/javascript"> var protitle="<?php echo $protitle; ?>";</script>
		<div class="projectdiv">
			<div class="projecttitle">
				<input class="inputprotitle" id="inputprotitle" type="text" placeholder="标题" value="<?php if($protitle!="new"){echo $protitle;} ?>" />
			</div>
			<div class="projectcontent">
				<textarea class="inputprojectdesc" id="inputprojectdesc" placeholder="描述"><?php echo $rowpro[3] ?></textarea>
			</div>
			<div class="projecttools">
				<input class="protool" id="newpro" type="button" onclick="newproject()" value="确认" />
				<input class="protool" onclick="delproject()"  type="button" value="删除" />
			</div>
		</div>
		<div id="contentdiv" class="cont">
			
			<?php 
				
				$mysqli = new mysqli('127.0.0.1', 'root', '', 'my_db');
				if(mysqli_connect_errno()){
					echo mysqli_connect_error();
				}
				$mysqli = mysqli_init();
				$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);//设置超时时
				$mysqli->real_connect('127.0.0.1', 'root', '', 'my_db');
				$mysqli->query("set names 'utf8'");
				$query="SELECT * FROM `todo` WHERE `userid` = '$name' and `isdone` = '0' and `isdel` = '0' and `project` = '$protitle'";
				$results=$mysqli->query($query);
				$contactount=0;
				while ($row = $results->fetch_array()) {
					$time=$row[4];
					$pos=strpos($time,"0000");
					if($pos===false){
						
					}else{
						$time="";
					}
					echo "<div class='singletodo' id='singleallold".$contactount."'>
						<div class='isdone' onclick=\"done('singleallold".$contactount."','doneoldimgage".$contactount."','title".$contactount."')\">
							<img src='./img/done.jpg' class='doneimage' id='doneoldimgage".$contactount."'/>
						</div>
						<div class='todoall' onclick=\"replacedivpro('./todo/edittodopro.php?title=".$row[2]."&protitle=".$protitle."')\">
							<div class='title' id='title".$contactount."'>".$row[2]."</div>
							<div class='content'>".$row[3]."</div>
							<div class='project'>".$row[5]."</div>
							<div class='date'>".$time."</div>
						</div>
					</div>";
					$contactount+=1;
				}
			
			?>
			<!-- <div class="singletodo" id="singles">
				<div class="isdone" onclick="done('singles','doneimage')">
					<img src="./img/done.jpg" class="doneimage" id="doneimage"/>
				</div>
				<div class="todoall" id="todos" title="./todo/edittodo.php" onclick="replacediv()">
					<div class="title">完成网站2333</div>
					<div class="content">添加少许效果1</div>
					<div class="project">工程导论1</div>
					<div class="date">4010/5/25</div>
				</div>
			</div> -->
		</div>
	</div>
</body>
</html>
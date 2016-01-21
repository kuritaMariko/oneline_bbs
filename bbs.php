<?php
  //POST送信が行われたら、下記の処理を実行
  //テストコメント
    //データベースに接続
    //SQL文作成(INSERT文)
    //INSERT文実行
    //データベースから切断
$dsn='mysql:dbname=oneline_bbs;host=localhost';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

if(isset($_POST) && !empty($_POST)){

  $nickname=$_POST['nickname'];
  $comment=$_POST['comment']; 
  //$created=$_POST['created'];

    $sql = "INSERT INTO `posts`(`nickname`, `comment`, `created`) ";
    $sql .="VALUES ('".$_POST['nickname']."','".$_POST['comment']."',now())";
$stmt = $dbh->prepare($sql);
$stmt->execute();

}

$sql = 'SELECT * FROM `posts`';
  
  //SQL文実行
  $stmt = $dbh->prepare($sql);
  $stmt->execute();
  $posts = array();
  //var_dump($stmt);
  while(1){

    
    //実行結果として得られたデータを表示
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec == false){
      break;
    }
    $posts[]=$rec;
    // echo $rec['id'];
    // echo $rec['nickname'];
    // echo $rec['comment'];
    // echo $rec['created'];
  }
    //データベースから切断
    $dbh=null;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示板</title>

</head>
<body>
    <form action="bbs.php" method="post">
      <input type="text" name="nickname" placeholder="nickname" required>
      <textarea type="text" name="comment" placeholder="comment" required></textarea>
      <button type="submit" >つぶやく</button>
    </form>

    <h2><a href="#">nickname Eriko</a> <span>2015-12-02 10:10:20</span></h2>
    <p>つぶやきコメント</p>

    <h2><a href="#">nickname Eriko</a> <span>2015-12-02 10:10:10</span></h2>
    <p>つぶやきコメント2</p>

<?php
foreach ($posts as $post) { ?>
    <h2><a href="#"><?php echo $post['nickname'];?></a> <span><?php echo $post['created'];?></span></h2>
    <p><?php echo $post['comment'];?></p>
<?php

//$dsn='mysql:dbname=oneline_bbs;host=localhost';
//$user='root';
//$password='';
//$dbh=new PDO($dsn,$user,$password);
//$dbh->query('SET NAMES utf8');

//$sql='SELECT * FROM posts WHERE 1';
//$stmt=$dbh->prepare($sql);
//$stmt->execute();

}
?>

</body>
</html>
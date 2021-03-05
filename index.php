<?php 
//$conn=mysqli_connect('localhost','Shaun','Bena1999#','library');
//if(!$conn){
    //check connection
  //  echo 'Connection error:'. mysqli_connect_error();
   //}
   //write query for all books
   include('config/db_connect.php');
   $sql='SELECT title,author,id FROM books ORDER BY created_at';
   //make query and get result
   $result = mysqli_query($conn, $sql);
   //fetching the resulting rows as an array
   $books=mysqli_fetch_all($result, MYSQLI_ASSOC);
   //free result from memmory
   mysqli_free_result($result);
   //close connection
   mysqli_close($conn);
   //print_r($books);
   
 ?>
<!DOCTYPE html>
<html>
<?php include('templates/header.php')?>
<h4 class="center black-text"> Available Books</h4>
<div class="container">
<div class="row">
<?php foreach($books as $book):?>
<div class="col s6  md3">
<div class="card z-depth-0">
<img src="img\books.png" class="bookimage">
<div class="card-content center">
<h6><?php echo htmlspecialchars($book['title']);?></h6>
<div><?php echo htmlspecialchars($book['author']);?></div>
</div>
<div class="card-action right-align">
<a href="details.php?id=<?php echo $book['id']?>" class="brand-text">more info</a>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
</div>
<h6 style="text-align:center;"><?php echo ' Total Books are: '.count($books)?></h6>
<?php include('templates/footer.php')?>
</html>
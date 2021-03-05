<?php 

include('config/db_connect.php');

$title=$email=$author='';
 $errors=array('email'=>'','title'=>'','author'=>'');

if(isset($_POST['submit'])){
    if(empty($_POST['email'])){
        $errors['email']= 'An email is required <br />';
    }
    else{
        $email=$_POST['email'];
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
          $errors['email']= 'email must be a valid email address <br />';
        }
    }
    //check title
    if(empty($_POST['title'])){
        $errors['title']= 'Title is required <br />';
    }
    else{
     $title =$_POST['title'];
     if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
         $errors['title']= 'Title must be letters and spaces only <br />';
     }
    }
    //check author
    if(empty($_POST['author'])){
        $errors['author']= 'Author is required <br />';
    }
    else{
        $author =$_POST['author'];
     if(!preg_match('/^[a-zA-Z\s]+$/',$author)){
         $errors['author']='Author must be letters and spaces only <br />';
     }
    }
    if(array_filter($errors)){
        //echo 'errors in the form';
    }else{
        $email=mysqli_real_escape_string($conn, $_POST['email']);
        $title=mysqli_real_escape_string($conn, $_POST['title']);
        $author=mysqli_real_escape_string($conn, $_POST['author']);
        //echo 'form is valid';
        $sql="INSERT INTO books(title,email,author) VALUES('$title','$email','$author')";
        //save to db and check
        if(mysqli_query($conn,$sql)){
        //success
        header('Location:index.php');
        }else{
            //error
            echo 'query error:'.  mysqli_error($conn);
          }
        //header('Location:index.php');
    }
  }
 ?>
<!DOCTYPE html>
<html>
<?php include('templates/header.php')?>
<section class="container">
<h4 class="center">Add a Book</h4>
<form action="add.php" method="POST" class="white">
<label>Your Email:</label>
<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
<div class="red-text"><?php echo $errors['email'];?></div>
<label>Book title:</label>
<input type="text" name="title" value="<?php echo htmlspecialchars($title)?>">
<div class="red-text"><?php echo $errors['title'];?></div>
<label>Author</label>
<input type="text" name="author" value="<?php echo htmlspecialchars($author)?>">
<div class="red-text"><?php echo $errors['author'];?></div>
<div class="center">
<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
</div>
</form>
</section>
<?php include('templates/footer.php')?>
</html>
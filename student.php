<?php

$conn = mysqli_connect("localhost","root","","student");

if(!$conn){
die("Connection failed: " . mysqli_connect_error());
}

/* ADD STUDENT */
if(isset($_POST['add'])){
$name=$_POST['name'];
$email=$_POST['email'];
$course=$_POST['course'];
$phone=$_POST['phone'];

mysqli_query($conn,"INSERT INTO students(name,email,course,phone)
VALUES('$name','$email','$course','$phone')");
}

/* DELETE STUDENT */
if(isset($_GET['delete'])){
$id=$_GET['delete'];
mysqli_query($conn,"DELETE FROM students WHERE id=$id");
header("Location: student.php");
}

/* UPDATE STUDENT */
if(isset($_POST['update'])){
$id=$_POST['id'];
$name=$_POST['name'];
$email=$_POST['email'];
$course=$_POST['course'];
$phone=$_POST['phone'];

mysqli_query($conn,"UPDATE students SET
name='$name',
email='$email',
course='$course',
phone='$phone'
WHERE id=$id");

header("Location: student.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Student Database</title>

<style>

body{
font-family:Arial;
background:#f2f2f2;
}

.container{
width:800px;
margin:auto;
background:white;
padding:20px;
margin-top:40px;
border-radius:5px;
}

h2{
text-align:center;
}

input{
width:100%;
padding:10px;
margin:8px 0;
}

button{
padding:10px;
background:green;
color:white;
border:none;
width:100%;
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

th,td{
border:1px solid #ddd;
padding:10px;
text-align:center;
}

th{
background:#333;
color:white;
}

.edit{
background:blue;
color:white;
padding:5px 10px;
text-decoration:none;
}

.delete{
background:red;
color:white;
padding:5px 10px;
text-decoration:none;
}

</style>

</head>
<body>

<div class="container">

<h2>Student Database System</h2>

<?php

/* EDIT MODE */
if(isset($_GET['edit'])){

$id=$_GET['edit'];
$result=mysqli_query($conn,"SELECT * FROM students WHERE id=$id");
$row=mysqli_fetch_assoc($result);

?>

<h3>Edit Student</h3>

<form method="POST">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<input type="text" name="name" value="<?php echo $row['name']; ?>" required>

<input type="email" name="email" value="<?php echo $row['email']; ?>" required>

<input type="text" name="course" value="<?php echo $row['course']; ?>" required>

<input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>

<button name="update">Update Student</button>

</form>

<?php } else { ?>

<h3>Add Student</h3>

<form method="POST">

<input type="text" name="name" placeholder="Student Name" required>

<input type="email" name="email" placeholder="Email" required>

<input type="text" name="course" placeholder="Course" required>

<input type="text" name="phone" placeholder="Phone" required>

<button name="add">Add Student</button>

</form>

<?php } ?>

<h3>Student List</h3>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Course</th>
<th>Phone</th>
<th>Action</th>
</tr>

<?php

$result=mysqli_query($conn,"SELECT * FROM students");

while($row=mysqli_fetch_assoc($result)){

?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['course']; ?></td>
<td><?php echo $row['phone']; ?></td>

<td>
<a class="edit" href="?edit=<?php echo $row['id']; ?>">Edit</a>
<a class="delete" href="?delete=<?php echo $row['id']; ?>">Delete</a>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>
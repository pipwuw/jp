<?php
session_start();
require 'connections1.php';

if(isset($_POST['save_exam']))
{
    $name = $_POST['name'];
    $category = $_POST['category'];
    $subject = $_POST['subject'];
    $duration = $_POST['duration'];
    $marks = $_POST['marks'];



    $query = "INSERT INTO exams (name,category,subject,duration,marks) VALUES
        ('$name','$category','$subject','$duration','$marks')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Create Examination Succesfully!";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Exam Not Created!";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['checking_viewbtn'])) {
    $e_id = $_POST['exam_id'];

    $query = "SELECT * FROM exams WHERE id='$e_id' ";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $exam)
        {
            echo $return = '
            <h4> ID: '.$exam['id'].'</h4>
            <h4> NAME: '.$exam['name'].'</h4>
            <h4> CATEGORY: '.$exam['category'].'</h4>
            <h4> SUBJECT: '.$exam['subject'].'</h4>
            <h4> DURATION: '.$exam['duration'].'</h4>
            <h4> TOTAL MARKS: '.$exam['marks'].'</h4>
            
            
            ';
        }
    }
    else
    {
    echo $return = "<h4> No Record Found </h4>";
    }    
}

if(isset($_POST['checking_update_btn'])) {
    $e_id = $_POST['exam_id'];
    $result_array = [];

    $query = "SELECT * FROM exams WHERE id='$e_id' ";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $exam)
        {
            array_push($result_array, $exam);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
    }
    else
    {
    echo $return = "<h4> No Record Found </h4>";
    }    
}

if(isset($_POST['update_exam'])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $subject = $_POST['subject'];
    $duration = $_POST['duration'];
    $marks = $_POST['marks'];

    $query = "UPDATE exams SET name='$name',category='$category',subject='$subject',duration='$duration',marks='$marks' 
    WHERE id='$id' "; 
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Exam Updated Succesfully!";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Exam Not Updated!";
        header("Location: index.php");
        exit(0);
    }

}

if(isset($_POST['delete_exam'])) {
    $id = $_POST['exam_id'];

    $query = "DELETE FROM exams WHERE id='$id' ";
    $query_run = mysqli_query($con, $query); 

    if($query_run)
    {
        $_SESSION['message'] = "Exam Deleted Succesfully!";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Exam Not Deleted!";
        header("Location: index.php");
        exit(0);
    }
}
?>
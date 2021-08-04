<?php 
if(@$_GET['page'] && $_GET['page'] == 'Employee')
{

}
else
{
    header('Location:../login.php');
}
?>
<div>
    <button class="btn btn-success">
        <a style="color: white; text-decoration: none" href="?page=Employee&action=add">add new Employee</a>
    </button>
</div>

<table class="table" >
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">username</th>
        
      <th scope="col">email</th>
      <th scope="col">address</th>
      <th scope="col">qulification</th>
      <th scope="col">rate</th> 
      <th scope="col">UPDATE</th>
      <th scope="col">DELETE</th>

    </tr>
  </thead>
  <tbody>
    
      <?php foreach($employee_data as $data){
        echo '<tr>';
          
            echo '<td>'.$data['id'] .'</td>' ;
            echo '<td>'.$data['username'] .'</td>' ;         

            echo '<td>'.$data['email'] .'</td>' ;
            echo '<td>'.$data['address'] .'</td>' ;         
            echo '<td>'.$data['qulification'] .'</td>' ;        
            echo '<td>'.$data['rate'] .'</td>' ;

            //update button
            echo '<td>';
            echo'<button class="btn btn-success">'
            . ' <a style="color: white; text-decoration: none" href="?page=Employee&action=update&id='.$data['id'].'">Update</a>'
            . '</button>';
            echo '</td>';

            //delete button
            echo '<td>' ;
            echo'<button class="btn btn-success">'
            . ' <a style="color: white; text-decoration: none" href="?page=Employee&action=delete&id='.$data['id'].'">Delete</a>'
            . '</button>';
            echo '</td>';
          
        echo '</tr>';
      } ?>  

      
  </tbody>
</table>
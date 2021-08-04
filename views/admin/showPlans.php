<?php 
if(@$_GET['page'] && $_GET['page'] == 'Plan')
{

}
else
{
    header('Location:../login.php');
}
?>
<div>
    <button class="btn btn-success">
        <a style="color: white; text-decoration: none" href="?page=Plan&action=add">add new Plan</a>
    </button>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">duration</th>
      <th scope="col">cost</th>     
      <th scope="col">count</th>
      <th scope="col">UPDATE</th>
      <th scope="col">DELETE</th>
    </tr>
  </thead>
  <tbody>
    
      <?php foreach($plan_data as $data){
          echo '<tr>';
          echo '<td>'.$data['id'] .'</td>' ;
          echo '<td>'.$data['name'] .'</td>' ;         
                   
          echo '<td>'.$data['duration'] .'</td>' ;
          echo '<td>'.$data['cost'] .'</td>' ;     
          echo '<td>'.$data['count'] .'</td>' ;  
          
          //update button
          echo '<td>';
            echo'<button class="btn btn-success">'
                . ' <a style="color: white; text-decoration: none" href="?page=Plan&action=update&id='.$data['id'].'">Update</a>'
                . '</button>';
          echo '</td>';
  
          //delete button
          echo '<td>' ;
               echo'<button class="btn btn-success">'
                . ' <a style="color: white; text-decoration: none" href="?page=Plan&action=delete&id='.$data['id'].'">Delete</a>'
                . '</button>';
          echo '</td>';
          
          echo '</tr>';
          

      } ?>  
      
  </tbody>
</table>
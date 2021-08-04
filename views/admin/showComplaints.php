<?php 
if(@$_GET['page'] && $_GET['page'] == 'showComplaints')
{

}
else
{
    header('Location:../login.php');
}
?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">user_id</th>
      <th scope="col">date</th>
      <th scope="col">description</th>
      <th scope="col">solution</th>
      <th scope="col">is_solve</th>
      <th scope="col">employee_id</th>
      <th scope="col">DELETE</th>
    </tr>
  </thead>
  <tbody>
    
      <?php foreach($comps_data as $data){
          echo '<tr>';
          
          echo '<td>'.$data['id'] .'</td>' ;
          echo '<td>'.$data['user_id'] .'</td>' ;         
          echo '<td>'.$data['date'] .'</td>' ;          
          echo '<td>'.$data['description'] .'</td>' ;
          echo '<td>'.$data['solution'] .'</td>' ;         
          echo '<td>'.$data['is_solve'] .'</td>' ;        
          echo '<td>'.$data['employee_id'] .'</td>' ; 
          
          //delete button
          echo '<td>' ;
               echo'<button class="btn btn-success">'
                . ' <a style="color: white; text-decoration: none" href="?page=showComplaints&action=delete&id='.$data['id'].'">Delete</a>'
                . '</button>';
          echo '</td>';

          echo '</tr>';

      } ?>  
      
  </tbody>
</table>
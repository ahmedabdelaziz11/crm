<?php 
if(@$_GET['page'] && $_GET['page'] == 'Complaint')
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
      <th scope="col">user_id</th>
      <th scope="col">date</th>
      <th scope="col">description</th>
      <th scope="col">SOLVE</th>
    </tr>
  </thead>
  <tbody>
    
      <?php foreach($comps_data as $data){
          echo '<tr>';
          
          echo '<td>'.$data['user_id'] .'</td>' ;         
          echo '<td>'.$data['date'] .'</td>' ;          
          echo '<td>'.$data['description'] .'</td>' ;      

          //SOLVE button
          echo '<td>' ;
               echo'<button class="btn btn-success">'
                . ' <a style="color: white; text-decoration: none" href="?page=Complaint&action=solve&id='.$data['id'].'&user_id='.$data['user_id'].'">SOLVE</a>'
                . '</button>';
          echo '</td>';
          
          echo '</tr>';

      } ?>  
      
  </tbody>
</table>
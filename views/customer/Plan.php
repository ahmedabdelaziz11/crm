<?php 
if(@$_GET['page'] && $_GET['page'] == 'Plan')
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
      <th scope="col">name</th>
      <th scope="col">duration</th>
      <th scope="col">cost</th>     
      <th scope="col">subscribers</th>
      <th scope="col">subscribe</th>
      
    </tr>
  </thead>
  <tbody>
    
      <?php foreach($plan_data as $data){
          echo '<tr>';
          echo '<td>'.$data['name'] .'</td>' ;               
          echo '<td>'.$data['duration'] .'</td>' ;
          echo '<td>'.$data['cost'] .'</td>' ;     
          echo '<td>'.$data['count'] .'</td>' ;  
          
  
          echo '<td>' ;
          echo '<form action="" method="post" >';
          echo '<input type="hidden" name="id" value="' .$data['id'].  '"> ' ;  
          echo '<input type="hidden" name="duration" value="' .$data['duration'].  '"> ' ;
          echo '<input class="btn btn-success"  type="submit" name ="subscribe" value="subscribe"/> ';
          echo '  </form>' ;
          echo '</td>';
          
          echo '</tr>';
          

      } ?>  
      
  </tbody>
</table>
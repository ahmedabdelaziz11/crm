<?php 
if(@$_GET['page'] && $_GET['page'] == 'showCustomers')
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
      <th scope="col">username</th>
      
      <th scope="col">email</th>
      <th scope="col">address</th>
      <th scope="col">DELETE</th>
    </tr>
  </thead>
  <tbody>
    
      <?php foreach($customers_data as $data){
          echo '<tr>';
          
          
          echo '<td>'.$data['id'] .'</td>' ;
          echo '<td>'.$data['username'] .'</td>' ;         
                   
          echo '<td>'.$data['email'] .'</td>' ;
          echo '<td>'.$data['address'] .'</td>' ;  

          //delete button
          echo '<td>' ;
               echo'<button class="btn btn-success">'
                . ' <a style="color: white; text-decoration: none" href="?page=showCustomers&action=delete&id='.$data['id'].'">Delete</a>'
                . '</button>';
          echo '</td>';
          
          echo '</tr>';

      } ?>  
      
  </tbody>
</table>
<?php 
if(@$_GET['page'] && $_GET['page'] == 'Complaint')
{

}
else
{
    header('Location:../login.php');
}
?>
<div>
    <button class="btn btn-success">
        <a style="color: white; text-decoration: none" href="?page=Complaint&MakeComplaint=add">Make new complaint</a>
    </button>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">date</th>
      <th scope="col">description</th>
      <th scope="col">solution</th>      
      <th scope="col">rate</th>
      <th scope="col">DELETE</th>
    </tr>
  </thead>
  <tbody>
    
      <?php foreach($comps_data as $data){
          echo '<tr>';
          echo '<td>'.$data['date'] .'</td>' ;          
          echo '<td>'.$data['description'] .'</td>' ;
          echo '<td>'.$data['solution'] .'</td>' ;

          if($data['is_solve'] == 1)
          {
          echo '<td>' ;
          echo '<form action="" method="post" >';
          echo '<input type="hidden" name="id" value="' .$data['id'].  '"> ' ;          
          echo '<input type="hidden" name="old_rate" value="' .$data['rate'].  '"> ' ;    
          echo '<input type="hidden" name="employee_id" value="' .$data['employee_id'].  '"> ' ;

          echo '<input class="btn btn-success"  type="submit" name ="rate" value="rate"/> ';
          echo '</td>';
          }
          else
          {
              echo '<td></td>';
          }
 
          //delete button
          echo '<td>' ;
               echo'<button class="btn btn-success">'
                . ' <a style="color: white; text-decoration: none" href="?page=Complaint&action=delete&id='.$data['id'].'">Delete</a>'
                . '</button>';
          echo '</td>';
          
          echo '</tr>';

      } ?>  
      
  </tbody>
</table>
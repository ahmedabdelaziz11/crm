<?php
require_once '../../config.php';
require_once app_path.'/models/complaint.php';

if(isset($_GET['action'])  && $_GET['action'] == 'delete')
{
    $complaint_id = $_GET['id'] ;
    $complaint = new complaint();
    $complaint->delete($complaint_id);
}
$complaint = new complaint();
$comps_data = $complaint->get_all();
require_once app_path.'/views/admin/showComplaints.php';


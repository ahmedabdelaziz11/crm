<?php
require_once '../../config.php';
require_once app_path.'/models/customer.php';

if(isset($_GET['action'])  && $_GET['action'] == 'delete')
{
    $customer_id = $_GET['id'] ;
    $customer = new customer();
    $customer->get_by_id($customer_id);
    $customer->delete($customer_id);
}

$customer = new customer();
$customers_data = $customer->get_all();
require_once app_path.'/views/admin/showCustomers.php';



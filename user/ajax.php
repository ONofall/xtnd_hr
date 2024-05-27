<?php
$user = new User();
$role = new Role();
$job = new Job();
$roles = $role->all();
$jobs = $job->all();
$search_query_name = $_GET['search_name'] ?? '';
$search_query_email = $_GET['search_email'] ?? '';
$search_query_phone = $_GET['search_phone'] ?? '';
$search_query_role = $_GET['search_role'] ?? '';
$search_query_job = $_GET['search_job'] ?? '';

$search_conditions = [
    'name' => $search_query_name,
    'email' => $search_query_email,
    'phone' => $search_query_phone,
    'role_id' => $search_query_role,
    'job_id' => $search_query_job,
];

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 4;

$search_results = $user->search($search_conditions, $page, $records_per_page);
$getdata = $search_results['data'];
$total_records = $search_results['total'];
$total_pages = ceil($total_records / $records_per_page);






<?php
use Illuminate\Support\Facades\DB;

require __DIR__ . '/../vendor/autoload.php';
$result = DB::table('test')->get();
var_dump($result);

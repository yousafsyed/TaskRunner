<?php
require 'TaskRunner.php';

$task = new TaskRunner();
$task->config(array(
		'syncInterval'=>1,
		'taskName'=>'MyTask'
));

$task->run(function(){
	#Your Task Here;
	echo "Task Ran";
});

$task2 = new TaskRunner();
$task2->config(array(
		'syncInterval'=>1,
		'taskName'=>'MyTask2'
));
$task2->run(function(){
	#Your Task Here;
	echo "Task2 Ran";
});
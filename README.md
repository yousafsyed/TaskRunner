### TaskRunner
The TaskRunner is an opensourse PHP class which helps you to run your scheduled tasks with your existing functionality without requiring you to setup a cronjob. Alot of the times we encounter the problems where we dont want to set a cronjob or we just cant setup a cronjob due to some wiered situation. 

### Usage
```
require 'TaskRunner.php';
$task = new TaskRunner();
$task->config(array(
		'syncInterval'=>1, // Interval in hours. (e.g run my job every x Hour.)
		'taskName'=>'MyTask' //Unique name of your job.
));

$task->run(function(){
	//Your Task Here;
	echo "Task Ran";
});
```

### Authors
Yousaf Syed, Yasir Ali

### License
(The MIT License)
Algorithms and Containers project is Copyright (c) 2015 

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the 'Software'), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

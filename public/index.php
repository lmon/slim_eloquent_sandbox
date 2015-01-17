<?php
    ini_set('error_reporting', E_ALL);
    ini_set("display_errors", 1); 

require_once '../app/bootstrap.php';


// Create Slim app
$app = new \Slim\Slim();

$app->get('/selecttests', function () use ($capsule){
	
	echo "<h2> titles 1 where('title_id', '>', 1)->where('title_id', '<', 11) </h2>";
    $titles = $capsule::table('titles')->where('title_id', '>', 1)->where('title_id', '<', 11)->get();
    echo "count: ". count($titles);

    foreach ($titles as $title)
    {
        var_dump($title);
    }
    

    /*
    requires where clause
    echo "<h2> titles 3 find</h2>";
    $title = $capsule::table('titles')->find(1);

    var_dump($title->name);
    */

    echo "<h2> titles 4  where('title_id', '>', 100)->take(5)</h2>";
    $titles = $capsule::table('titles')->where('title_id', '>', 100)->take(5)->get();
    echo "count: ". count($titles);
    foreach ($titles as $title)
    {
        var_dump($title);
        print "<hr>";
    }

    echo "<h2> titles 5: orderBy('num_likes')->take(5)</h2>";
    $titles = $capsule::table('titles')->orderBy('num_likes', 'desc')->take(5)->select(array('titles.num_likes', 'titles.name', 'titles.description'))->get();

    echo "count: ". count($titles);
    foreach ($titles as $title)
    {
        var_dump($title);
        print "<hr>";
    }
 

})->name('selecttests');

$app->get('/deletetests', function () use ($capsule){
 
    echo "<h2> title delete </h2>";
    $title1 = $capsule::table('titles')->where('name', 'LIKE', '%Lawly%')->delete();


})->name('deletetests');

$app->get('/inserttests', function () use ($capsule){
 
    $time = date('Y-m-d h:i:s');

    echo "<h2> title create </h2>";
    $title1 = $capsule::table('titles')->insert(array(
            'name'         => 'Lawly '.$time,
            'description'         => 'this is the description',
    ));

    $title1 = $capsule::table('titles')->insert(
        array(
            array('name' => 'Lawly 1'.$time, 'description' => 'i am but a cog'),
            array('name' => 'Lawly 2'.$time, 'description' => 'i am but a cog'),
        )
    );

    $titles = $capsule::table('titles')->select(array('titles.num_likes', 'titles.name', 'titles.description'))->where('name', 'LIKE', '%Lawly%')->get();
    echo "count: ". count($titles);

    foreach ($titles as $title)
    {
        var_dump($title);
    }

})->name('inserttests');

$app->get('/tablecreate', function () use ($capsule){

    $capsule::schema()->create('slim-users', function($table)
    {
        $table->increments('id');
        $table->string('email')->unique();
        $table->timestamps();
    });

})->name('tablecreate');

$app->get('/select-with-relations', function () use ($capsule){

    // $users = User::all(); // fails when there are too many records
    $users = User::where('user_id', '>', 0)->take(5)->get((['user_id','first_name']));
    // $users = $capsule::table('users')->where('user_id', '>', 0)->where('user_id', '<', 11)->get();

    echo "<h2> users with proposals count: ". count($users)."</h2>";
    foreach ($users as $user)
    {
        echo $user->user_id ." // ".$user->first_name ."<br>";
        $has = (( count($user->proposals)>0) ?"has":"doesnt have") ;
        echo $has."<br>";
        if($has == "has"){
            print "<hr>proposals ".count($user->proposals)."<br/>";
            print "<blockquote>";
            foreach ($user->proposals as $proposal){
              echo "--->".$proposal->proposal_id."<br>";//  echo $proposal->proposal_id ."\n<br>";
            }
            print "</blockquote>";
        }
        print "<hr>";
    }
        
    $users = User::with( array('proposals'=>function($query){
        $query->select('user_id', 'num_likes', 'proposal_id','proposal_type', 'date_posted')->orderBy('num_likes', 'DESC');
    }) )->take(5)->get( ['user_id','first_name', 'last_name'] );

    echo "<h2> users with proposals alt count: ". count($users)."</h2>";
    foreach ($users as $user)
    {
        echo $user->user_id ." // ".$user->first_name ." ".$user->last_name."<br>";
        $has = (( count($user->proposals)>0) ?"has":"doesnt have") ;
        echo $has."<br>";
        if($has == "has"){
            print "<hr>proposals ".count($user->proposals)."<br/>";
            print "<blockquote>";
            foreach ($user->proposals as $proposal){
              echo "--->".$proposal->num_likes.', '.$proposal->proposal_id.', '.$proposal->proposal_type.', '.$proposal->date_posted."<br>";
            }
            print "</blockquote>";
        }
        print "<hr>";
    }
 
 

})->name('select-with-relations');

get_routes();

$app->run();


function get_routes(){
    global $app;
    $router   = $app->router();
    $routes   = $router->getNamedRoutes();
      
    foreach($routes as $route){ 
        echo "<a href='".$_SERVER['SCRIPT_NAME']."{$route->getPattern()}'>{$route->getName()}</a> | "; 
    } 
}


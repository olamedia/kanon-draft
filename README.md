
# Controller
## Return http code
```php
class myController{
    public function actionA(){
   		return 404;
    }
}
```
## Redirect
```php
class myController{
    public function actionA(){
   		return response::redirect($uri);
    }
}
```

# Router
## Base URL, nesting
```php
$router->setBasePath('/app/');
$router->get('hello', function(){
    // $router->setBasePath($router->arel());
    $router->get('world', function(){
        return 'Hello, world!';
    });
    return 404;
});
```
```php
\zero\router::create([
    'base' => '/app/'
],[
    'account' => function(){
        // $this refers to router instance
        $this->post([
            'logout' => function(){
            }
        ]);
        $this->route([
            'login' => function(){
            },
            'settings' => function(){
            }
        ]);
    }
]);
```
## Loose binding for Controller
rough draft
```php
route(from_controller, pattern, action)
```


## Action, init/show
```php
$router->action('action', function(){
    return 'Action';
});
$router->action('init, show', 
function(){
    // init
}, function(){ // close session
    // show
});
```
## Controller interaction
```php
$router->action('a', ['myController', 'actionA']);
$router->action('a', ['myController', 'initA'], ['myController', 'showA']);
```



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



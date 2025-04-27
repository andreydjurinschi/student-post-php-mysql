# Лабораторная работа номер 5
## Задание: Работа с базой данных

## Рабочий процесс и описание работы

### докер структура проекта

> apache.conf

файл, который является конфигурационным для апаче сервера в контейнере. Был создан для использования чис тых ссылок
`(/posts/view)` к примеру

> .htaccess

файл, который включил механизм перезаписи URL + файл `index.php` стал точкой входа в приложение

> docker-compose.yml

сборка контейнеров для моего проекта
- `php` - контейнер с кодом и самим апаче сервером
- `db`- контейнер с бд
- `phpmyadmin` - браузерный интерфейс для работы с БД

> Dockerfile

на основе данного файла и строится `php` контейнер. В нем устанавливаются расширения для работы с БД, копирование проекта и открытие порта

### Сценарий работы

> 1) Касс подключения к БД

```php
<?php

namespace config;
use PDOException;

/***
 * class that provides connection to db
 */
class DatabaseConnector
{
    private $serverName;
    private $username;
    private $password;
    private $connection;

    /***
     * Constructor that initialize an oblect of class DatabaseConnector
     *
     * @param $serverName - host name
     * @param $username - user name
     * @param $password - user pass
     */
    public function __construct($serverName, $username, $password){
        $this->serverName = $serverName;
        $this->username = $username;
        $this->password = $password;
    }

    /***
     * A function that provides an connection to db
     *
     */
    public function createConnection(): void
    {
        try{
            $this->connection = new \PDO("mysql:host=$this->serverName;dbname=school_db", $this->username, $this->password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function getConnection(){
        return$this->connection;
    }
```

Тут коструктор инициализирует все необходимые поля для подключения к БД, а в методе `createConnection` -> создается новое подлкючение к Mysql через PDO

> 2) класс Router и его инициализация

```php
<?php

namespace app\Core;

class Router{
    private $routes = [];

    public function addRoute($method, $path, $handler){
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch($path){
        $method = $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes as $route){
            if($method === $route['method'] && $path === $route['path']){
                return call_user_func($route['handler']);
            }
        }
        return http_response_code(404);
    }
}
```

метод `addRoute` добавляет новый маршрут, а `dispach` - занимается поисков и выполнением маршрута


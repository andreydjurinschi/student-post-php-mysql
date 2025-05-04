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

> Какие преимущества даёт использование единой точки входа в веб-приложении?

- единая точка входа позволяет проще упралять маршрутизацией благодаря единой точке запросов
- гибкость - можно перенаправлять запросы в разные контроллеры в зависимости от `URL`
- ограничение прямого доступа к другим php файлам

> Какие преимущества даёт использование шаблонов?

- oтделение логики от представления — код становится более читаемым и поддерживаемым.
- можно создавать общие шаблоны (например, layout.html) и вставлять в них разные части.
- экранирование данных по умолчанию (например, защита от XSS).

> Какие преимущества даёт хранение данных в базе по сравнению с хранением в файлах?

- mасштабируемость — БД справляется с большими объёмами данных.
- cтруктурированность — связи между таблицами, валидация, ограничения.

> Что такое SQL-инъекция?

SQL-инъекция — это уязвимость, при которой злоумышленник внедряет вредоносный SQL-код в запрос, чтобы получить несанкционированный доступ к данным или повлиять на базу данных.

Пример уязвимого кода:
```php
$username = $_GET['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
```

Если пользователь передаст в URL:
`?username=' OR 1=1 -- `

Ответ:
`SELECT * FROM users WHERE username = '' OR 1=1 --'`

Результат: вернутся все пользователи, или произойдёт вход без пароля.

> для предотвращения SQL инъекций используются подготовленные выражения

```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
```

> ORM
> Фильтрация и валоидация данных
> Минимальные права у обычных пользователей

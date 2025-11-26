<?php
    require_once 'useragent.php';
    $autoloader = __DIR__ . '/../vendor/autoload.php';
    $dotenvPath = __DIR__ . '/..';
    $dotenvFile = $dotenvPath . '/.env';

    if (file_exists($autoloader)) {
        require_once $autoloader;

        if (file_exists($dotenvFile)) {
            $dotenv = Dotenv\Dotenv::createImmutable($dotenvPath);
            $dotenv->load();

            $host = $_ENV['DB_HOST'];
            $user = $_ENV['DB_USER'];
            $pass = $_ENV['DB_PASS'];
            $name = $_ENV['DB_NAME'];
        } else {
            die(json_encode(['error' => '[DOTENV] .env file not found']));
        }
    } else {
        $host = getenv('DB_HOST');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');
        $name = getenv('DB_NAME');
    }

    if (!$host || !$user || !$pass || !$name) {
        die(json_encode(['error' => '[SERVER] Database environment variables are missing']));
    }

    $conn = new mysqli($host, $user, $pass, $name);

    if ($conn->connect_error) {
        http_response_code(500);
        die(json_encode(['error' => 'Database connection failed: ' . $conn->connect_error]));
    }

    require_once 'query.php';
?>
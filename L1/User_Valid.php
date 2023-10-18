<?php
require_once __DIR__.'/vendor/autoload.php';
use Symfony\Component\Validator\Validation;

require 'User.php';

// Создаем объект класса Validation
// reateValidatorBuilder() - Создает настраиваемый построитель для объектов валидатора.
// Имя метода настраивается с помощью метода addMethodMapping()
// метаданные проверки извлекаются при выполнении createRules() метода класса
$validator = Validation::createValidatorBuilder()->addMethodMapping('createRules')->getValidator();

function showValidity(User $user): void {
    //global - все существующие ссылки на любую из этих статических переменных стали указывать уже на их глобальную версию
    global $validator;
    // А теперь получим доступ к методу класса
    $errors = $validator->validate($user);

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo $error->getMessage()."\n";
        }
    }
    else {
        echo "Validation was successful!\n";
    }
}

echo "----------- User 1 ----------- \n";
$User1 = new User(1,  "User1", "user1@gmail.com", "password");
showValidity($User1);

echo "\n----------- User 2 ----------- \n";
$User2 = new User(-1, "User2User2User2", "user2@gmail.com", "password");
showValidity($User2);

echo "\n----------- User 3----------- \n";
$User3 = new User(-1, "Us",  "Usgmail.com", "US");
showValidity($User3);
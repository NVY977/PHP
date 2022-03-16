<?php 
require_once __DIR__.'/vendor/autoload.php' ;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class User
{
    public int $id;
    public string $name, $email, $password;
    public DateTime $created_at;

    public function __construct(int $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdTime = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
    }

    public static function createRules(ClassMetadata $metadata)
    {
        // addPropertyConstraint - Добавляет ограничение к данному свойству.
        // Проверяет, является ли значение положительным числом. Ноль не является ни положительным, ни отрицательным, 
        // поэтому вы должны использовать PositiveOrZero , если хотите разрешить ноль в качестве значения.
        $metadata->addPropertyConstraint('id', new Assert\Positive(array(
            'message' => 'ID < 0'
        )));
        // Assert\Email Проверяет, является ли значение действительным адресом электронной почты. Базовое значение преобразуется в строку перед проверкой.
        $metadata->addPropertyConstraint('email', new Assert\Email(array(
            'message' => 'Email {{ value }} is incorrect.'
        )));
        // Assert\Length Проверяет, что заданная длина строки находится между некоторым минимальным и максимальным значением.
        $metadata->addPropertyConstraint('name', new Assert\Length(array( 
            'min'        =>  4,
            'max'        =>  10,
            'minMessage' => 'Name length < 4',
            'maxMessage' => 'Name length > 10',
        )));
        $metadata->addPropertyConstraint('password', new Assert\Length(array(
            'min'        => 5,
            'minMessage' => 'Password length > 5',
        )));
    }
    // Добавьте метод, который возвращает дату и время создания текущего объекта
    public function getCreatedAtString(): string
    {
        return $this->createdTime->format('Y-m-d H:i:s');
    }
}
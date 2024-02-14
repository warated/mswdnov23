<?php
namespace com\icemalta\jobapp\api\model;

use \JsonSerializable;
use \PDO;
use com\icemalta\jobapp\api\model\{DBConnect, Application};

class User implements JsonSerializable
{
    private static $db;
    private int $id;
    private ?string $email;
    private ?string $password;
    private $accessLevel = 'user';

    public function __construct(?string $email = null, ?string $password = null, ?string $accessLevel = 'user', ?int $id = 0)
    {
        $this->email = $email;
        $this->password = $password;
        $this->accessLevel = $accessLevel;
        $this->id = $id;
        self::$db = DBConnect::getInstance()->getConnection();
    }

    public static function save(User $user): User
    {
        $hashed = password_hash($user->password, PASSWORD_DEFAULT);
        if ($user->getId() === 0) {
            // Insert
            $sql = 'INSERT INTO User(email, password, accessLevel) VALUES (:email, :password, :accessLevel)';
            $sth = self::$db->prepare($sql);
        } else {
            // Update
            $sql = 'UPDATE User SET email = :email, password = :password, accessLevel = :accessLevel WHERE id = :id';
            $sth = self::$db->prepare($sql);
            $sth->bindValue('id', $user->getId());
        }
        $sth->bindValue('email', $user->getEmail());
        $sth->bindValue('password', $hashed);
        $sth->bindValue('accessLevel', $user->accessLevel);
        $sth->execute();

        if ($sth->rowCount() > 0 && $user->getId() === 0) {
            $user->setId(self::$db->lastInsertId());
        }
        return $user;
    }

    public static function authenticate(User $user): ?User
    {
        $sql = 'SELECT * FROM User WHERE email = :email';
        $sth = self::$db->prepare($sql);
        $sth->bindValue('email', $user->email);
        $sth->execute();

        $result = $sth->fetch(PDO::FETCH_OBJ);
        if ($result && password_verify($user->password, $result->password)) {
            return new User(
                email: $result->email,
                password: $result->password,
                accessLevel: $result->accessLevel,
                id: $result->id
            );
        }
        return null;
    }

    public static function delete(User $user): bool
    {
        $sql = 'DELETE FROM User WHERE id = :id';
        $sth = self::$db->prepare($sql);
        $sth->bindValue('id', $user->getId());
        $sth->execute();
        return $sth->rowCount() > 0;
    }

    public static function getApplications(User $user): array
    {
        self::$db = DBConnect::getInstance()->getConnection();
        $sql = 'SELECT userId, listingId, appDate, id FROM Application WHERE userId = :userId ORDER BY appDate DESC';
        $sth = self::$db->prepare($sql);
        $sth->bindValue('userId', $user->getId());
        $sth->execute();
        $applications = $sth->fetchAll(PDO::FETCH_FUNC, fn(...$fields) => new Application(...$fields));
        return $applications;
    }

    public static function getInfo(User $user): object
    {
        self::$db = DBConnect::getInstance()->getConnection();
        $sql = <<<'SQL'
            SELECT 
            User.email,
            User.accessLevel,
            COALESCE(COUNT(Application.id), 0) AS applications
        FROM
            User
            LEFT JOIN Application ON Application.userId = :userId
        GROUP BY
            User.email, User.accessLevel
        SQL;
        $sth = self::$db->prepare($sql);
        $sth->bindValue('userId', $user->getId());
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'accessLevel' => $this->accessLevel
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getAccessLevel(): string
    {
        return $this->accessLevel;
    }

    public function setAccessLevel(string $accessLevel): self
    {
        $this->accessLevel = $accessLevel;
        return $this;
    }
}
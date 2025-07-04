<?php

namespace App\Helpers;

class AuthUtils
{
    private static $path = WRITEPATH . 'data/users.json';

    public static function readUsers(): array
    {
        if (!file_exists(self::$path)) {
            file_put_contents(self::$path, json_encode([]));
        }

        $raw = file_get_contents(self::$path);
        return json_decode($raw, true) ?? [];
    }

    public static function writeUsers(array $users): void
    {
        file_put_contents(self::$path, json_encode($users, JSON_PRETTY_PRINT));
    }

    public static function userExists(string $email): bool
    {
        $users = self::readUsers();
        return !!array_filter($users, fn ($u) => $u['email'] === $email);
    }

    public static function findUserByEmail(string $email): ?array
    {
        $users = self::readUsers();
        log_message('error', 'Something went wrong!',$users);
        // dd($users); 
        foreach ($users as $u) {
            if ($u['email'] === $email) return $u;
        }
        return null;
    }
}

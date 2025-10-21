<?php

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserRoleTest extends TestCase
{
    /**
     * Testa se o campo 'role' está presente em $fillable do modelo User.
     */
    public function test_fillable_contains_role()
    {
        $fillable = (new User())->getFillable();
        $this->assertContains('role', $fillable);
    }

    /**
     * Testa os métodos isSuperAdmin, isAdmin e isUser.
     */
    public function test_role_helpers()
    {
        $user = new User();

        $user->role = User::ROLE_USER;
        $this->assertTrue($user->isUser());
        $this->assertFalse($user->isAdmin());
        $this->assertFalse($user->isSuperAdmin());

        $user->role = User::ROLE_ADMIN;
        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isSuperAdmin());

        $user->role = User::ROLE_SUPER_ADMIN;
        $this->assertTrue($user->isSuperAdmin());
        $this->assertTrue($user->isAdmin());
    }
}

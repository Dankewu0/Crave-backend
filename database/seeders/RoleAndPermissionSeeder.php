<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Очищаем кэш Spatie, чтобы новые права подтянулись сразу
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // --- 1. ОПРЕДЕЛЯЕМ ВСЕ ПРАВА (PERMISSIONS) ---

        // Права для Клиента
        Permission::create(["name" => "view products"]);
        Permission::create(["name" => "create orders"]);
        Permission::create(["name" => "manage own profile"]);

        // Права для Модератора (управление контентом и фидбеком)
        Permission::create(["name" => "manage products"]);
        Permission::create(["name" => "manage users"]); // забанить/разбанить
        Permission::create(["name" => "manage reviews"]);

        // Права для Админа (управление процессами)
        Permission::create(["name" => "manage moderators"]);
        Permission::create(["name" => "manage orders"]);
        Permission::create(["name" => "view analytics"]);

        // Права для Владельца (управление структурой и командой)
        Permission::create(["name" => "manage categories"]);
        Permission::create(["name" => "manage admins"]);
        Permission::create(["name" => "full system access"]);

        // --- 2. СОЗДАЕМ РОЛИ И НАЗНАЧАЕМ ПРАВА ---

        // USER (Клиент)
        $user = Role::create(["name" => "user"]);
        $user->givePermissionTo([
            "view products",
            "create orders",
            "manage own profile",
        ]);

        // MODERATOR
        $moderator = Role::create(["name" => "moderator"]);
        $moderator->givePermissionTo([
            "view products",
            "manage products",
            "manage users",
            "manage reviews",
        ]);

        // ADMIN
        $admin = Role::create(["name" => "admin"]);
        // Админ получает всё, что может модератор + свои права
        $admin->givePermissionTo([
            "view products",
            "manage products",
            "manage users",
            "manage reviews",
            "manage moderators",
            "manage orders",
            "view analytics",
        ]);

        // OWNER
        $owner = Role::create(["name" => "owner"]);
        // Владельцу даем вообще всё через встроенный метод Spatie
        $owner->givePermissionTo(Permission::all());
    }
}

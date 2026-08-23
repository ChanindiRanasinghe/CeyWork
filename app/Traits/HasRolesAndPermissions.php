<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;

trait HasRolesAndPermissions
{
    public function roles()
    {
        return $this->morphToMany(Role::class, 'model', 'model_has_roles');
    }

    public function permissions()
    {
        return $this->morphToMany(Permission::class, 'model', 'model_has_permissions');
    }

    public function assignRole(string ...$roles): self
    {
        $roleIds = Role::whereIn('name', $roles)->pluck('id');
        $this->roles()->syncWithoutDetaching($roleIds);
        return $this;
    }

    public function syncRoles(array $roles): self
    {
        $roleIds = Role::whereIn('name', $roles)->pluck('id');
        $this->roles()->sync($roleIds);
        return $this;
    }

    public function hasRole(string|array $roles): bool
    {
        if (is_array($roles)) {
            return $this->roles->pluck('name')->intersect($roles)->isNotEmpty();
        }
        return $this->roles->contains('name', $roles);
    }

    public function hasAnyRole(array $roles): bool
    {
        return $this->hasRole($roles);
    }

    public function hasPermissionTo(string $permission): bool
    {
        // System Administrator has all permissions
        if ($this->hasRole('System Administrator')) {
            return true;
        }

        // Direct permission
        if ($this->permissions->contains('name', $permission)) {
            return true;
        }

        // Permission via roles
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('name', $permission)) {
                return true;
            }
        }

        return false;
    }

    public function givePermissionTo(string ...$permissions): self
    {
        $permissionIds = Permission::whereIn('name', $permissions)->pluck('id');
        $this->permissions()->syncWithoutDetaching($permissionIds);
        return $this;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return "Admin Panel Index";
    }

    public function users()
    {
        return "Users List";
    }

    public function usersAdd()
    {
        return "Add User";
    }

    public function usersStore(Request $request)
    {
        return "Store User";
    }

    public function usersEdit($user)
    {
        return "Edit User";
    }

    public function usersSave(Request $request)
    {
        return "Save User";
    }

    public function usersDelete($id)
    {
        return "Delete User";
    }

    public function userPermissions()
    {
        return "Permissions";
    }

    public function userPermissionSave(Request $request)
    {
        return "Save Permissions";
    }

    public function usersFinance($id)
    {
        return "User Finance";
    }

    public function usersActivity()
    {
        return "Activity";
    }

    public function usersDashboard()
    {
        return "User Dashboard";
    }

    public function userExport($type)
    {
        return "Export";
    }

    public function dashboardWidgetOrderUpdate(Request $request)
    {
        return "Widget Order";
    }

    public function updateDashboardWidgetStatus($widget)
    {
        return "Widget Status";
    }

    public function usersSearch()
    {
        return "Search";
    }
}

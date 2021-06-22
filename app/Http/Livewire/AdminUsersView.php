<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;

class AdminUsersView extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public array $breadcrumb;

    public function mount(): void
    {
        $this->breadcrumb = [
            'Users' => route('admin.users.show'),
        ];
    }

    public function render()
    {
        $users = User::where('user_type', '=', 'user')->orderBy('created_at', 'DESC')->paginate(15);
        return view('livewire.admin.admin-users-view', ['users' => $users])->layout('layouts.admin', ['pageTitle' => 'Users']);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;

class AdminAgentsView extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public array $breadcrumb;

    public function mount(): void
    {
        $this->breadcrumb = [
            'Agents' => route('admin.agents.show'),
        ];
    }

    public function render()
    {
        $agents = User::where('user_type', '=', 'agent')->orderBy('created_at', 'DESC')->paginate(15);
        return view('livewire.admin.admin-agents-view', ['agents' => $agents])->layout('layouts.admin', ['pageTitle' => 'Agents']);
    }
}

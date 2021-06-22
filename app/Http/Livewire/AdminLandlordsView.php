<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;

class AdminLandlordsView extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public array $breadcrumb;

    public function mount(): void
    {
        $this->breadcrumb = [
            'Landlords' => route('admin.landlords.show'),
        ];
    }

    public function render()
    {
        $landlords = User::where('user_type', '=', 'landlord')->orderBy('created_at', 'DESC')->paginate(15);
        return view('livewire.admin.admin-landlords-view', ['landlords' => $landlords])->layout('layouts.admin', ['pageTitle' => 'Landlords']);
    }
}

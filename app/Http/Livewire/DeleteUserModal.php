<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class DeleteUserModal extends Component
{
    use AuthorizesRequests;

    public int $user_id = -1;

    public string $redirect_route_name;

    public function mount(string $redirect_route_name): void
    {
        $this->redirect_route_name = $redirect_route_name;
    }

    public function delete()
    {
        $this->authorize('forceDelete', $user = User::findOrFail($this->user_id));

        $user->forceDelete();

        session()->flash("banner", "Account deleted successfully.");
        session()->flash("bannerStyle", "success");

        return redirect()->route($this->redirect_route_name);
    }

    public function render()
    {
        return view('livewire.delete-user-modal');
    }
}

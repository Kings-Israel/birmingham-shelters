<?php

namespace App\Http\Livewire;

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class AdminMessagesView extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public array $breadcrumb;

    public function mount(): void
    {
        $this->breadcrumb = [
            'Messages' => route('admin.messages.show'),
        ];
    }

    public function deleteMessage(ContactMessage $message)
    {
        $message->delete();
    }

    public function render()
    {
        $messages = ContactMessage::where('is_read', false)->orderBy('created_at', 'DESC')->paginate(15);
        return view('livewire.admin.admin-messages-view')->with(['messages' => $messages])->layout('layouts.admin', ['pageTitle' => 'Messages']);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SupportingAgency;
use Livewire\WithFileUploads;
use Auth;
use Illuminate\Support\Facades\Storage;

class AdminSupportingAgency extends Component
{
    use WithFileUploads;

    public array $breadcrumb;

    public $agency_name, $agency_description, $agency_image, $iteration = 0;

    protected $listeners = ['resetFields' => '$refresh', 'deleteAgency' => '$refresh'];

    public function mount(): void
    {
        $this->breadcrumb = [
            'Supporting Agency' => route('admin.agencies.show'),
        ];
    }

    public function resetFields()
    {
        $this->agency_name = '';
        $this->agency_description = '';
        $this->agency_image = null;
        // $this->iteration++;
    }

    public function addAgency()
    {
        $rules = [
            'agency_name' => 'required',
            'agency_description' => 'required|string',
            'agency_image' => 'required|image|mimes:png,jpg,jpeg'
        ];

        $messages = [
            'agency_name.required' => 'Please enter the Agency Name',
            'agency_description.required' => 'Please enter a brief description for the agency',
            'agency_image.required' => 'Please upload an image'
        ];

        $this->validate($rules, $messages);

        SupportingAgency::create([
            'user_id' => Auth::user()->id,
            'agency_name' => $this->agency_name,
            'agency_description' => $this->agency_description,
            'agency_image' => pathinfo($this->agency_image->store('images', 'agency'), PATHINFO_BASENAME)
        ]);

        $this->resetFields();

    }

    public function deleteAgency(SupportingAgency $agency)
    {
        Storage::disk('agency')->delete('images/'.$agency->agency_image);
        $agency->delete();
    }

    public function render()
    {
        $agencies = SupportingAgency::orderBy('created_at', 'DESC')->get();
        return view('livewire.admin.admin-supporting-agency', ['agencies' => $agencies])->layout('layouts.admin', ['pageTitle' => 'Supporting Agencies']);
    }
}

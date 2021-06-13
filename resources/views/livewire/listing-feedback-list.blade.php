<div>
    <ul class="list-unstyled">
        @forelse ($this->feedbackList as $feedback)
        <li class="border-bottom p-b-10 m-b-15">
            <article class="d-flex">
                <div class="flex-shrink-0 d-flex align-items-center">
                    <i
                        title="{{ $feedback->is_resolved ? '' : 'Unresolved comment'}}"
                        class="ti-comment {{ $feedback->is_resolved ? 'text-gray-700' : 'text-primary'}}"></i>
                </div>
                <div class="p-l-20">
                    <div class="text-gray-700">
                        <time datetime="{{ $feedback->created_at }}">{{ $feedback->created_at->format("jS F Y") }}</time>
                    </div>
                    <div class="{{ $feedback->is_resolved ? 'text-gray-800': 'text-gray-900' }}">
                        <p>{{ $feedback->message }}</p>
                    </div>
                    <div>
                        @if(Auth::user()->isOfType("landlord"))
                            @if(!$feedback->is_resolved)
                            <button type="button" wire:click="markAsResolved({{ $feedback->id }})" class="btn btn-link p-l-0 p-t-0">Mark as resolved</button>
                            @endif
                        @endif
                    </div>
                </div>
            </article>
        </li>
        @empty
        <li>
            <p>No feedback has been provided yet.</p>
        </li>
        @endforelse
    </ul>
</div>

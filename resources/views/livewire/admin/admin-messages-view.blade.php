<div>
    <x-breadcrumb :items="$breadcrumb" />
    @if (session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error') }}</p>
        </div>
    @elseif (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    <div class="property_block_wrap style-2">
        <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
            <div class="block-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Subject</td>
                            <td>Date Sent</td>
                            <td>View</td>
                            <td>Delete</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $message)
                        <tr class="booking-details-row">
                            <td>{{ $message->message_contact_name }}</td>
                            <td><strong>{{ $message->message_contact_email }}</strong></td>
                            <td>{{ $message->message_contact_subject }}</td>
                            <td><strong>{{ $message->created_at->format('d-m-Y') }}</strong></td>
                            <td>
                                <button class="btn btn-theme-light-2 btn-sm" data-bs-toggle="modal" data-bs-target="#view_message_{{ $message->id }}">
                                    View
                                </button>
                            </td>
                            <td>
                                <button wire:click="deleteMessage({{ $message }})" class="btn btn-primary btn-md">
                                    Delete
                                </button>
                            </td>
                            <div class="modal fade" id="view_message_{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="view_messages_modal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                                    <div class="modal-content">
                                        <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                                        <div class="modal-body">
                                            <h5 class="modal-header-title" style="text-align: center">{{ $message->message_contact_name }}</h5>
                                            <p style="text-align: center">{{ $message->message_contact }}</p>
                                            </div>
                                            <div class="login-form container">
                                                <form action="{{ route('contact.reply') }}" id="contactMessageReplyForm" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input type="hidden" name="inquiry_id" value="{{ $message->id }}">
                                                        <input type="hidden" name="inquiry_sender_email"  value="{{ $message->message_contact_email }}">
                                                        <input type="hidden" name="inquiry_message" value="{{ $message->message_contact }}">
                                                        <label>Enter Reply Here</label>
                                                        <textarea name="message_response" id="message_area" class="form-control message_area">{{ old('message_response') }}</textarea>
                                                        @error('message_response')
                                                            <strong class="error-message">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                    <button type="submit" id="contactMessageReplyButton" class="btn btn-md btn-theme-light-2 rounded">Reply</button>
                                                </form>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="row">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</div>


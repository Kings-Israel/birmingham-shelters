<x-app-dashboard-layout pageTitle="Inquiries">
    <div class="property_block_wrap style-2">
        <div class="property_block_wrap_header">
            <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo"
                href="javascript:void(0);" aria-expanded="true">
                <h4 class="property_block_title">
                    <a href="{{ route('listing.view.one', $inquiries->id) }}">
                        <i class="ti-angle-left"></i> 
                    </a>
                    Inquiries:
                </h4>
            </a>
        </div>
        <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
            <div class="block-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Phone Number</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inquiries->inquiry as $inquiry)
                        <tr class="inquiry-details-row" @if($inquiry->read_at == null) id="inquiry-not-read" @endif>
                            <td>{{ $inquiry->user_name }}</td>
                            <td><strong>{{ $inquiry->user_email }}</strong></td>
                            <td>{{ $inquiry->user_phone_number }}</td>
                            <td>
                                <button class="btn btn-md btn-theme-light-2 rounded" data-bs-toggle="modal" data-bs-target="#view_message_{{ $inquiry->id }}">View Message</button>
                            </td>
                            <div class="modal fade" id="view_message_{{ $inquiry->id }}" tabindex="-1" role="dialog" aria-labelledby="view_users_modal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                                    <div class="modal-content">
                                        <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                                        <div class="modal-body">
                                            <h5 class="modal-header-title" style="text-align: center">{{ $inquiry->user_name }}</h5>
                                            <p style="text-align: center">{{ $inquiry->listing_message }}</p>
                                            </div>
                                            <div class="login-form container">
                                                @if($inquiry->isRegistered($inquiry->user_email))
                                                    <form method="POST" action="{{ route('listing.inquiry.response') }}">
                                                        @csrf
                                                        <div class="form-group">
                                                            <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
                                                            <label>Enter Reply Here</label>
                                                            <textarea name="message_response" class="form-control">{{ old('message_response') }}</textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-md btn-theme-light-2 rounded">Reply</button>
                                                    </form>
                                                @endif
                                                <a id="replyThroughMail" href="{{ route('listing.reply.mail', $inquiry->id) }}">
                                                    <button type="submit" id="replyThroughMailButton" class="btn btn-md btn-theme-light-2 rounded">Reply Through Mail</button>
                                                </a>
                                                <hr>
                                                <form action="{{ route('listing.inquiry.delete', $inquiry->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-md btn-primary rounded m-2">Delete</button>
                                                </form>
                                                <h5 id="error-message" style="color: red; display: none">Error accessing inquiry</h5>
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
        </div>
    </div>
</x-app-dashboard-layout>
<x-app-dashboard-layout pageTitle="Inquiries">
    <div class="property_block_wrap style-2">
        <div class="property_block_wrap_header">
            <a data-bs-toggle="collapse" data-parent="#dsrp" data-bs-target="#clTwo" aria-controls="clTwo"
                href="javascript:void(0);" aria-expanded="true">
                <h4 class="property_block_title">
                    <a href="{{ route('listing.inquiries.all', $listingInquiry->listing->id) }}">
                        <i class="ti-angle-left"></i>
                    </a>
                    Inquiry Through Mail:
                </h4>
            </a>
        </div>
        <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
            <div class="block-body">
                <h4>Inquiry:</h4>
                <p>{{ $listingInquiry->listing_message }}</p>
                <h4>Response:</h4>
                <form action="{{ route('listing.submit.email.reply') }}" method="post">
                    @csrf
                    <input type="hidden" name="inquiry_id" value="{{ $listingInquiry->id }}">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>To:</label>
                                <input type="email" name="inquiry_reply_email" class="form-control" value="{{ $listingInquiry->user_email }}">
                                <x-input-error for="inquiry_reply_email" />
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Subject:</label>
                                <input type="text" name="inquiry_reply_subject" class="form-control" value="Response to Inquiry on the listing {{ $listingInquiry->listing->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Enter Your Message:</label>
                        <textarea name="inquiry_reply_content" class="form-control h-120">{{ old('inquiry_reply_content') }}</textarea>
                        <x-input-error for="inquiry_reply_content" />
                    </div>

                    <button class="btn btn-theme-light-2 rounded" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function checkIfEmailInString(text) {
                var re = /(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/;
                return re.test(text);
            }

            function checkIfPhoneNumberInString(text) {
                var phoneExp = /(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?/img;
                return phoneExp.test(text)
            }
            $('#listing-inquiry-reply-btn').on('click', function(e) {
                e.preventDefault();
                if (checkIfEmailInString($('#message_response').val())) {
                    $('#listing-inquiry-text-error').text('Do not share emails in the text')
                    return
                }
                if (checkIfPhoneNumberInString($('#message_response').val())) {
                    $('#listing-inquiry-text-error').text('Do not share phone numbers in the text')
                    return
                }

                $('#listing-inquiry-reply').submit()
            })
        </script>
    @endpush
</x-app-dashboard-layout>

<x-app-dashboard-layout pageTitle="Landlord">
    <div class="dashboard-wraper">
        @if (count($listings) <= 0) <h4>Add Your Property to see them here</h4>
            @else
            <h4>My Property</h4>
            @endif
            <div class="row">
                @foreach ($listings as $listing)
                <!-- Single Property -->
                <div class="col-12">
                    <div class="singles-dashboard-list">
                        <div class="sd-list-left">
                            <img src="{!! $listing->coverImageUrl() !!}" class="img-fluid" alt="" />
                        </div>
                        <div class="sd-list-right">
                            <h4 class="listing_dashboard_title"><a href="{{ route('listing.view.one', $listing->id) }}"
                                class="theme-cl">{{ $listing->name }}</a>
                                @if($listing->is_sponsored != null)
                                <span class="badge rounded-pill fw-bold text-success bg-light-success m-l-4">Sponsored</span>
                                @endif 
                            </h4>
                            <div class="action">
                                <a href="JavaScript:Void(0);" data-bs-toggle="modal"
                                    data-bs-target="#delete_listing_{{ $listing->id }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Delete Property" class="delete" style="float: right"><i
                                        class="ti-close"></i></a>
                            </div>
                                <div class="user_dashboard_listed">
                                    Bookings: <strong>{{ $listing->bookings_count }}</strong>
                                </div>
                                <div class="user_dashboard_listed">
                                    Inquiries: <strong>{{ $listing->inquiry_count }}</strong>
                                </div>
                                <div class="user_dashboard_listed">
                                    Occupied Rooms: <strong>{{ $listing->occupied_rooms }}</strong>
                                </div>
                                <div class="user_dashboard_listed">
                                    Available Rooms: <strong>{{ $listing->available_rooms }}</strong>
                                </div>
                                <div class="user_dashboard_listed">
                                    Status: {{ $listing->status->label }}
                                </div>
                            </div>
                        </div>
                </div>
                <!-- Delete Listing Form Modal -->
                <div class="modal fade signup" id="delete_listing_{{ $listing->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="sign-up" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                        <div class="modal-content" id="sign-up">
                            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i
                                    class="ti-close"></i></span>
                            <div class="modal-body">
                                <h4 class="text-center">Are you Sure you Want to delete this listing?
                                </h4>
                                <div class="login-form">
                                    <form method="POST" action="{{ route('listing.delete', $listing->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-md full-width btn-primary rounded">Delete</button>
                                        </div>

                                    </form>
                                    <button type="submit" data-bs-dismiss="modal"
                                        class="btn btn-md full-width btn-theme-light-2 rounded">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
                @endforeach
                
            </div>
    </div>
</x-app-dashboard-layout>

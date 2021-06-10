<div class="col-lg-10 col-md-12">
    <div class="full-search-2 eclip-search italian-search hero-search-radius shadow-hard">
        <div class="hero-search-content">
            <form action="{{ route('listing.search') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-9 col-md-7 col-sm-12 elio">
                        <div class="form-group">
                            <div class="input-with-icon">
                                <input type="text" class="form-control" name="search_location" id="search-location" placeholder="Search for a location" oninput="enteredText()" value="{{ old('search_location') }}">
                                <img src="{{ asset('assets/img/pin.svg') }}" width="20"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-5 col-sm-12">
                        <div class="form-group">
                            <button type="submit" disabled class="btn search-btn black" id="submit-location">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function enteredText() {
            var value = document.getElementById('search-location').value
            if(value != "") {
                document.getElementById('submit-location').removeAttribute('disabled')
            } else {
                document.getElementById('submit-location').setAttribute('disabled', true)
            }
        }
    </script>
@endpush
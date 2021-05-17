<div class="dashboard-wraper">
    <form class="form-submit" wire:submit.prevent="save_changes" method="POST">
        <h4>Personal Information</h4>
        <div class="submit-section">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" class="form-control" name="first_name"
                        wire:model.defer="user.first_name" required>
                    <x-input-error class="m-t-2" for="user.first_name" />
                </div>

                <div class="form-group col-md-6">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" class="form-control" name="last_name"
                        wire:model.defer="user.last_name" required>
                    <x-input-error class="m-t-2" for="user.last_name" />
                </div>

                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" name="email"
                        wire:model.defer="user.email" required>
                    <x-input-error class="m-t-2" for="user.email" />
                </div>

                <div class="form-group col-md-6">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" class="form-control" name="phone_number"
                        wire:model.defer="user.phone_number" placeholder="44 xxxx xxxxxx" required>
                    <x-input-error class="m-t-2" for="user.phone_number" />
                </div>
            </div>

            <div class="row">
                <div class="d-flex justify-content-end align-items-center">
                    @if($show_message)
                        <div wire:poll.2000ms="dismiss_message" class="fs-5 text-black mr-2">Saved.</div>
                    @endif

                    <div>
                        <button type="submit" class="btn btn-theme-light-2">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>

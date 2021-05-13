<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <form class="submit-page" wire:submit.prevent="save_details">
                @if(!$editingMode)
                <div class="alert alert-info" role="alert">
                    The admin will receive an email with a generated password to access their account.
                </div>
                @endif

                <div class="form-submit">
                    <div class="submit-section">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" class="form-control" name="first_name"
                                    wire:model.defer="admin.first_name" required>
                                <x-input-error class="m-t-2" for="admin.first_name" />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" class="form-control" name="last_name"
                                    wire:model.defer="admin.last_name" required>
                                <x-input-error class="m-t-2" for="admin.last_name" />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control" name="email"
                                    wire:model.defer="admin.email" required>
                                <x-input-error class="m-t-2" for="admin.email" />
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" id="phone_number" class="form-control" name="phone_number"
                                    wire:model.defer="admin.phone_number" placeholder="44xxxxxxxxxx" required>
                                <x-input-error class="m-t-2" for="admin.phone_number" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-lg-12 col-md-12 d-flex justify-content-end">
                    <button class="rounded btn btn-theme" type="submit">
                        {{ $this->editingMode ? "Update" : "Add New" }} Admin Account
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

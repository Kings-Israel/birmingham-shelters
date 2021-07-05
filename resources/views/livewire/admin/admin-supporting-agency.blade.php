<div>
    <x-breadcrumb :items="$breadcrumb" />
    <div class="property_block_wrap style-2">
        <div id="clTwo" class="panel-collapse collapse show" aria-expanded="true">
            <div class="block-body">
                <button class="btn btn-theme-light-2 mt-2" style="float: right" data-bs-toggle="modal" data-bs-target="#agency-modal"><i class="ti-plus mr-2"></i>Add Agency</button>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Agency Name</td>
                            <td>Agency Description</td>
                            <td>Image</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agencies as $agency)
                        <tr class="booking-details-row">
                            <td><strong>{{ $agency->agency_name }}</strong></td>
                            <td>{{ $agency->agency_description }}</td>
                            <td>
                                <img src="{{ asset('storage/agency/images/'.$agency->agency_image) }}" style="width: 50px;" class="img-fluid" alt="" />
                            </td>
                            <td>
                                <div class="btn btn-md btn-primary" wire:click="deleteAgency({{ $agency }})">Delete</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div wire:ignore.self class="modal fade" id="agency-modal" tabindex="-1" role="dialog" aria-labelledby="agentmodal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
                        <div class="modal-content" id="agentmodal">
                            <span class="mod-close" data-bs-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                            <div class="modal-body">
                                <h4 class="modal-header-title">Add Agency</h4>
                                <div class="login-form">
                                    <form method="POST" id="login-form" wire:submit.prevent="addAgency">
                                        @csrf
                                        <div class="form-group">
                                            <label>Agency Name</label>
                                            <input type="text" name="agency_name" wire:model="agency_name" id="agency_name" class="form-control" placeholder="Agency Name">
                                            <x-input-error for="agency_name" />
                                        </div>
                
                                        <div class="form-group">
                                            <label>Agency Description</label>
                                            <textarea name="agency_description" id="" wire:model="agency_description" class="form-control"></textarea>
                                            <x-input-error for="agency_description" />
                                        </div>

                                        <div class="form-group">
                                            <label>Agency Image</label>
                                            <input type="file" name="agency_image" wire:model="agency_image" id="agency_image{{$iteration}}" class="form-control">
                                            <x-input-error for="agency_image" />
                                        </div>
                
                                        <div class="form-group">
                                            <button type="submit" id="login-button" class="btn btn-md full-width btn-theme-light-2 rounded">Add</button>
                                        </div>
                
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

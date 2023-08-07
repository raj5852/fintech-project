<form autocomplete="off" action="{{ route('user.update.profile') }}" method="POST" class="edit_profile_form"
    enctype="multipart/form-data">
    @csrf
    <h1>Edit Profile</h1>
    <hr>
    <div class="edit_profile_control custom-padding-for-input">
        <div>
            <div class="form-group input-box-control">
                <span>Name:</span>
                <input type="name" value="{{ Auth::user()->name }}" class="input-control-ibx" name="name">
            </div>
            <div class="form-group input-box-control">
                <span>Email:</span>
                <input type="email" value="{{ Auth::user()->email }}" readonly class="input-control-ibx"
                    name="email">
            </div>

            <div class="form-group input-box-control">
                <span>Image:</span>
                <input type="file" class="input-control-ibx" name="image">
            </div>
        </div>

        <div>
            <div class="form-group input-box-control">
                <label class="form-label">Old Password</label>
                <input id="old-password" type="password" class="input-control-ibx" name="old_password"
                    placeholder="Enter old password">
                <span toggle="#old-password" class="fa fa-fw fa-eye field-icon-profile toggle-password"></span>
            </div>

            <div class="form-group input-box-control">
                <label class="form-label">New Password</label>
                <input id="new-password" type="password" class="input-control-ibx" name="new_password"
                    placeholder="Enter new password">
                <span toggle="#new-password" class="fa fa-fw fa-eye field-icon-profile toggle-password"></span>
            </div>

            <div class="form-group input-box-control">
                <label class="form-label">Confirm Password</label>
                <input id="confirm-password" type="password" class="input-control-ibx" name="confirm_password"
                    placeholder="Enter confirm password">
                <span toggle="#confirm-password" class="fa fa-fw fa-eye field-icon-profile toggle-password"></span>
            </div>
        </div>
    </div>




    <div class="form-group col-lg-6 mt-3">
        <button style="border-radius:10px;padding:8px auto" class="common-btn" type="submit">Update</button>
    </div>
</form>

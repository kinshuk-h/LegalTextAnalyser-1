@extends('dashboard')

@section('dash-ui')
    <script>
        var msg = '{{Session::get('message')}}';
        var exist = '{{Session::has('message')}}';
        if(exist){
        alert(msg);
        }
    </script>

    <article class="content-area">
        <article class="container">
            <section class="block">
                <section class="hero">
                    <p class="panel-heading has-background-info has-text-white mt-1 ml-1 mr-1 mb-0"
                        id="profile">
                        My Profile
                    </p>
                </section>
            </section>
            <section class="box mt-1 mb-0 ml-1 mr-1">
                <form id="profile-details-form" action="/dashboard/profile/details" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="field">
                        <label class="label">Name</label>
                        <p class="control is-expanded has-icons-left">
                            <span class="icon is-small is-left">
                                <i class="fa fas fa-user"></i>
                            </span>
                            <input class="input is-static" type="text" name="name" value="{{old('name',auth()->user()->name) }}" placeholder="Name" readonly>
                        </p>
                        @error('name')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">Registration Number</label>
                        <p class="control is-expanded has-icons-left">
                            <span class="icon is-small is-left">
                                <i class="fa fas fa-id-card"></i>
                            </span>
                            <input class="input is-static" type="text" name="reg_num" value="{{old('reg_num',auth()->user()->reg_num)}}" 
                                placeholder="Registration Number" readonly>
                        </p>
                        @error('reg_num')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">College / University / Department</label>
                        <p class="control is-expanded has-icons-left">
                            <span class="icon is-small is-left">
                                <i class="fa fas fa-university"></i>
                            </span>
                            <input class="input is-static" type="text" name="institution_name" value="{{old('institution_name',auth()->user()->institution_name)}}" 
                                placeholder="College / University / Department" readonly>
                        </p>
                        @error('institution_name')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="field">
                        <label class="label">Designation</label>
                        <p class="control is-expanded">
                        <div class="select is-fullwidth">
                            <select class="is-static" readonly disabled name="designation">
                                <option value="expert">Expert</option>
                                <option value="student" selected>Student</option>
                            </select>
                        </div>
                        </p>
                    </div> --}}
                    <div class="field">
                        <label class="label">Phone Number</label>
                        <p class="control is-expanded has-icons-left">
                            <span class="icon is-small is-left">
                                <i class="fa fas fa-phone"></i>
                            </span>
                            <input class="input is-static" type="tel" name="phone_num" value="{{old('phone_num',auth()->user()->phone_num)}}" placeholder="Mobile Number"
                                readonly>
                        </p>
                        @error('phone_num')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">E-Mail Address</label>
                        <p class="control is-expanded has-icons-left">
                            <span class="icon is-small is-left">
                                <i class="fa fas fa-envelope"></i>
                            </span>
                            <input class="input is-static" type="email" data-readonly="true"
                                name="email" value="{{old('email',auth()->user()->email)}}" placeholder="E-Mail Address" readonly>
                        </p>
                        @error('email')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="field is-grouped is-grouped-right is-grouped-multiline">
                        <div class="control">
                            <button class="button is-primary" id="edit">Edit</button>
                        </div>
                        <div class="control">
                            <input type="reset" class="button is-light is-hidden" id="cancel" value="Cancel">
                        </div>
                        <div class="control">
                            <input type="submit" class="button is-primary is-hidden" id="save" hidden
                                value="Save">
                        </div>
                        <div class="control">
                            <button class="button is-primary js-modal-trigger" id="change_passwd"
                                data-target="password-modal">Change Password</button>
                        </div>
                    </div>
                </form>
            </section>
        </article>
    </article>

    <div class="modal" id="password-modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Change Current Password</p>
                <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <div class="container is-fluid">
                    <form action="/dashboard/profile/password" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="field">
                            <label class="label">Current Password</label>
                            <div class="field has-addons">
                                <div class="control is-expanded has-icons-left">
                                    <span class="icon is-small is-left">
                                        <i class="fa fas fa-key"></i>
                                    </span>
                                    <input class="input" type="password" name="old_password" value="{{old('old_password')}}" 
                                        placeholder="Current (Old) Password" id="old_password" required>
                                </div>
                                <div class="control">
                                    <button class="button" data-visibility data-target="old_password">
                                        <span class="icon is-small">
                                            <i class="fa fas fa-eye"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            @error('old_password')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="label">New Password</label>
                            <div class="field has-addons">
                                <div class="control is-expanded has-icons-left">
                                    <span class="icon is-small is-left">
                                        <i class="fa fas fa-key"></i>
                                    </span>
                                    <input class="input" type="password" name="new_password" value="{{old('new_password')}}"
                                        placeholder="New Password" id="new_password" required>
                                </div>
                                <div class="control">
                                    <button class="button" data-visibility data-target="new_password">
                                        <span class="icon is-small">
                                            <i class="fa fas fa-eye"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            @error('new_password')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="label">Confirm New Password</label>
                            <div class="field has-addons">
                                <div class="control is-expanded has-icons-left">
                                    <span class="icon is-small is-left">
                                        <i class="fa fas fa-key"></i>
                                    </span>
                                    <input class="input" type="password" name="confirm_new_password" value="{{old('confirm_new_password')}}"
                                        placeholder="Confirm New Password" id="confirm_new_password" required>
                                </div>
                                <div class="control">
                                    <button class="button" data-visibility data-target="confirm_new_password">
                                        <span class="icon is-small">
                                            <i class="fa fas fa-eye"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            @error('confirm_new_password')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="field is-grouped is-grouped-right mt-5">
                            <div class="control">
                                <button type="submit" class="button is-primary">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- Essential JavaScripts -->
    <script src="{{ mix('resources/js/modal.js') }}"></script>
    <script src="{{ mix('resources/js/profile.js') }}"></script>
@endsection
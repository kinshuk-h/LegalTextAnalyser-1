@extends('dashboard')

@section('dash-ui')
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
                <form id="profile-details-form" action="/dashboard/profile" method="POST">
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
                    </div>
                </form>
            </section>
        </article>
    </article>

    <!-- Essential JavaScripts -->
    <script src="{{ mix('resources/js/profile.js') }}"></script>
@endsection
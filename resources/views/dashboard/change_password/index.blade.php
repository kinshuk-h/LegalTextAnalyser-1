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
                    <p class="panel-heading has-background-info has-text-white mt-1 ml-1 mr-1 mb-0" id="passwd">
                        Change Password
                    </p>
                </section>
            </section>
            <section class="box mt-1 mb-0 ml-1 mr-1">
                <form action="/dashboard/change-password" method="POST">
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
            </section>
        </article>
    </article>

    <script src="{{ mix('resources/js/login_signup.js') }}"></script>
@endsection

<div class="box box-info padding-1">
    <div class="box-body">
        
    <div>
        <x-label for="name" :value="__('Name')" />

        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
    </div>

    <!-- Id Number -->
    <div>
    <x-label for="id" :value="__('Professional Number')" />

    <x-input id="id" maxlength="9" onkeyup="this.value = this.value.toUpperCase();" onpaste="return false;" ondrop="return false;" autocomplete="off" onkeydown="return /[a-z0-9]/i.test(event.key)"  class="block mt-1 w-full" type="text" name="id" :value="old('id')" required autofocus />
    </div>

    <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
    </div>

    <div class="mt-4">
        <div>
            <x-label for="specialty" :value="__('Specialty')" />

            <x-input id="specialty" class="block mt-1 w-full" onpaste="return false;" ondrop="return false;" autocomplete="off" onkeydown="return /[a-z ]/i.test(event.key)" type="text" name="specialty" :value="old('specialty')" required autofocus />
        </div>

    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-label for="password" :value="__('Password')" />

        <x-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-label for="password_confirmation" :value="__('Confirm Password')" />

        <x-input id="password_confirmation" class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" required />
    </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
    </div>
</div>
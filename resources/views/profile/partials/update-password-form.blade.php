<section>
    <header style="margin-bottom: 24px;">
        <h2 class="text-lg font-medium text-gray-900" style="display: none;">
            {{ __('Update Password') }}
        </h2>

        <p class="text-sm text-gray-600">
            {{ __('Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password" class="form-label">{{ __('Password Saat Ini') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control"
                autocomplete="current-password" />
            @if($errors->updatePassword->get('current_password'))
                <p class="text-error">{{ $errors->updatePassword->get('current_password')[0] }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="update_password_password" class="form-label">{{ __('Password Baru') }}</label>
            <input id="update_password_password" name="password" type="password" class="form-control"
                autocomplete="new-password" />
            @if($errors->updatePassword->get('password'))
                <p class="text-error">{{ $errors->updatePassword->get('password')[0] }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation"
                class="form-label">{{ __('Konfirmasi Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="form-control" autocomplete="new-password" />
            @if($errors->updatePassword->get('password_confirmation'))
                <p class="text-error">{{ $errors->updatePassword->get('password_confirmation')[0] }}</p>
            @endif
        </div>

        <div style="display: flex; align-items: center; gap: 16px;">
            <button type="submit" class="btn-primary">{{ __('Simpan Password') }}</button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-success">{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
<section>
    <header style="margin-bottom: 24px;">
        <p class="text-sm text-gray-600">
            {{ __("Update data profil dan alamat email Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="avatar" class="form-label">{{ __('Foto Profil') }}</label>
            <div style="display: flex; align-items: center; gap: 16px;">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar"
                        style="width: 64px; height: 64px; border-radius: 50%; object-fit: cover;">
                @endif
                <input id="avatar" name="avatar" type="file" class="form-control" accept="image/*"
                    style="padding: 8px;" />
            </div>
            @if($errors->get('avatar'))
                <p class="text-error">{{ $errors->get('avatar')[0] }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="name" class="form-label">{{ __('Nama Lengkap') }}</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}"
                required autofocus autocomplete="name" />
            @if($errors->get('name'))
                <p class="text-error">{{ $errors->get('name')[0] }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}"
                required autocomplete="username" />
            @if($errors->get('email'))
                <p class="text-error">{{ $errors->get('email')[0] }}</p>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div style="margin-top: 8px;">
                    <p class="text-sm text-gray-800">
                        {{ __('Email Anda belum diverifikasi.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Link verifikasi baru telah dikirim ke email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div style="display: flex; align-items: center; gap: 16px;">
            <button type="submit" class="btn-primary">{{ __('Simpan Perubahan') }}</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-success">{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
<section>
    <header>
        <h2 class="h4">
            {{ __('Informasi Profil Pengguna') }}
        </h2>

        <p class="mt-2 text-muted">
            {{ __('Ubah data diri anda.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Nama') }}</label>
            <input id="name" name="name" type="text" class="form-control"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">{{ __('Username') }}</label>
            <input id="username" name="username" type="text" class="form-control"
                value="{{ old('username', $user->username) }}" required autocomplete="username">
            @error('username')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control"
                value="{{ old('email', $user->email) }}" required autocomplete="email">
            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-muted">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-link p-0">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success mt-1">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">{{ __('Nomor HP') }}</label>
            <input id="phone_number" name="phone_number" type="text" class="form-control"
                value="{{ old('phone_number', $user->phone_number) }}">
            @error('phone_number')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">{{ __('Alamat') }}</label>
            <textarea id="address" name="address" class="form-control" rows="3">{{ old('address', $user->address) }}</textarea>
            @error('address')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">{{ __('Foto Profil') }}</label>
            <input id="photo" name="photo" type="file" class="form-control">
            @error('photo')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-2">
            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
        </div>

    </form>
</section>

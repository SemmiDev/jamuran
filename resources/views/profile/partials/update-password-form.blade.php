<section>
    <header class="mb-3">
        <h2 class="h4">
            {{ __('Ganti Password') }}
        </h2>
        <p class="text-muted">
            {{ __('Pastikan pilih kata sandi yang kuat.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">{{ __('Password Lama') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control"
                autocomplete="current-password">
            @error('updatePassword.current_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password" class="form-label">{{ __('Password Baru') }}</label>
            <input id="update_password_password" name="password" type="password" class="form-control"
                autocomplete="new-password">
            @error('updatePassword.password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="update_password_password_confirmation"
                class="form-label">{{ __('Konfirmasi Password Baru') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="form-control" autocomplete="new-password">
            @error('updatePassword.password_confirmation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
        </div>
    </form>
</section>

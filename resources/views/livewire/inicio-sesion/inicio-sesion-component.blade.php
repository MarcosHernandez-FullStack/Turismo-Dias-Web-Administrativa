<div class="row">
    <div class="col-sm-6 login-section-wrapper">
        <div class="brand-wrapper">
            <img src="{{ asset('assets/img/turismo-dias-logo.png') }}" style=" width: 60%;height: 100%;" alt="logo"
                class="logo">
        </div>
        <div class="login-wrapper my-auto">
            <h1 class="login-title">Iniciar Sesión</h1>
            <form wire:submit.prevent="login">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        placeholder="email@ejemplo.com" wire:model='email'>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Ingresa tu contraseña" wire:model='password'>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-block login-btn" wire:click="login">Iniciar Sesión</button>
            </form>
        </div>
    </div>
    <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="{{ asset('assets/dist/img/login.jpg') }}" alt="login image" class="login-img">
    </div>
</div>

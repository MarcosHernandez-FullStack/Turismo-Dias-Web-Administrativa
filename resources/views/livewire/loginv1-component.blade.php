<div>
    <h2 class="mb-2 text-center">Iniciar Sesion</h2>
    <p class="text-center">Inicia sesion para conectarte.</p>
    <form wire:submit.prevent="login">
        <div class="row">
            <div class="col-lg-12"> 
                <div class="form-group">
                    <label for="email" class="form-label">Correo</label>
                    <input type="text" class="form-control" id="email" placeholder=" " wire:model='email'>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" aria-describedby="password"
                        placeholder=" " autocomplete="off" wire:model='password'>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-12 d-flex justify-content-between">
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="customCheck1" wire:model='remember'>
                    <label class="form-check-label" for="customCheck1">Recordar</label>
                </div>
                <a href="recoverpw.html">Olvido la contraseña?</a>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary" wire:click="login">Iniciar Sesion</button>
        </div>
    </form>
</div>

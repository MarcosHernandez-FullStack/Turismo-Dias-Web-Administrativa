<div class="row">
    <div class="col-sm-6 login-section-wrapper">
        <div class="brand-wrapper">
            <img src="{{ asset('assets/img/turismo-dias-logo.png') }}" style=" width: 60%;height: 100%;" alt="logo"
                class="logo">
        </div>
        <div class="login-wrapper my-auto">
            <h1 class="login-title">Iniciar Sesión</h1>
            <form action="#!">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        placeholder="email@ejemplo.com">
                </div>
                <div class="form-group mb-4">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Ingresa tu contraseña">
                </div>
                <input name="login" id="login" class="btn btn-block login-btn" type="button"
                    value="Iniciar Sesión">
            </form>
        </div>
    </div>
    <div class="col-sm-6 px-0 d-none d-sm-block">
        <img src="{{ asset('assets/dist/img/login.jpg') }}" alt="login image" class="login-img">
    </div>
</div>

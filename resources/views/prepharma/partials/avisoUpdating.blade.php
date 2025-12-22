@if (config('app.updating'))
    <div class="row">
        <div class="col-12">
            <div class="card system-updating-card">
                <div class="system-updating-inner">
                    <div class="system-updating-icon" aria-hidden="true">
                        <div class="system-updating-spinner"></div>
                    </div>
                    <div>
                        <p class="system-updating-title">
                            Sistema em atualização
                            <span class="system-updating-dots" aria-hidden="true">
                                <span></span><span></span><span></span>
                            </span>
                        </p>
                        <p class="system-updating-text">
                            Algumas funcionalidades podem ficar instáveis por algum tempo.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

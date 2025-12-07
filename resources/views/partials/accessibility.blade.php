<div id="accessibility-controls" aria-hidden="false">
    <style>
        #accessibility-controls {
            position: fixed;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: center;
        }

        .acc-btn {
            width: 46px;
            height: 46px;
            border-radius: 24px;
            background: #136ea7;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
            border: none;
            cursor: pointer;
            font-weight: 700;
        }

        .acc-btn:focus { outline: 3px solid #ffe680; }

        .acc-panel {
            display: none;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
            padding: 8px;
            align-items: center;
        }

        .acc-panel button { margin: 0 4px; }

        body.high-contrast {
            background: #000 !important;
            color: #fff !important;
        }

        body.high-contrast a { color: #ffeb3b !important; }
    </style>

    <div style="display:flex; flex-direction:column; align-items:center;">
        <button id="acc-font-btn" class="acc-btn" aria-label="Control de tamaño de letra">A</button>
        <div id="acc-font-panel" class="acc-panel" role="dialog" aria-hidden="true">
            <button id="acc-decrease" class="acc-btn" title="Disminuir fuente">-</button>
            <button id="acc-reset" class="acc-btn" title="Restablecer fuente">A</button>
            <button id="acc-increase" class="acc-btn" title="Aumentar fuente">+</button>
        </div>
    </div>

    <button id="acc-contrast-btn" class="acc-btn" aria-pressed="false" aria-label="Alternar contraste">☼</button>

    <script>
        (function(){
            const panel = document.getElementById('acc-font-panel');
            const btn = document.getElementById('acc-font-btn');
            const inc = document.getElementById('acc-increase');
            const dec = document.getElementById('acc-decrease');
            const rst = document.getElementById('acc-reset');
            const contrastBtn = document.getElementById('acc-contrast-btn');

            const STORAGE_KEY_SIZE = 'epc_font_size';
            const STORAGE_KEY_CONTRAST = 'epc_contrast_on';

            function getSize(){
                const v = localStorage.getItem(STORAGE_KEY_SIZE);
                return v ? parseFloat(v) : 1.0;
            }

            function applySize(scale){
                document.documentElement.style.fontSize = (16 * scale) + 'px';
                localStorage.setItem(STORAGE_KEY_SIZE, scale);
            }

            function changeSize(delta){
                let s = getSize();
                s = Math.min(2.0, Math.max(0.75, +(s + delta).toFixed(2)));
                applySize(s);
            }

            function resetSize(){
                document.documentElement.style.fontSize = '';
                localStorage.removeItem(STORAGE_KEY_SIZE);
            }

            try{ if(localStorage.getItem(STORAGE_KEY_SIZE)) applySize(getSize()); }catch(e){/* ignore */}

            btn.addEventListener('click', function(e){
                const visible = panel.style.display === 'flex';
                panel.style.display = visible ? 'none' : 'flex';
                panel.setAttribute('aria-hidden', visible ? 'true' : 'false');
            });

            inc.addEventListener('click', function(){ changeSize(0.1); });
            dec.addEventListener('click', function(){ changeSize(-0.1); });
            rst.addEventListener('click', function(){ resetSize(); });

            function setContrast(on){
                document.body.classList.toggle('high-contrast', !!on);
                contrastBtn.setAttribute('aria-pressed', !!on);
                localStorage.setItem(STORAGE_KEY_CONTRAST, !!on ? '1' : '0');
            }

            contrastBtn.addEventListener('click', function(){
                const isOn = document.body.classList.contains('high-contrast');
                setContrast(!isOn);
            });

            try{
                if(localStorage.getItem(STORAGE_KEY_CONTRAST) === '1') setContrast(true);
            }catch(e){}

            document.addEventListener('click', function(e){
                if(!btn.contains(e.target) && !panel.contains(e.target)){
                    panel.style.display = 'none';
                    panel.setAttribute('aria-hidden', 'true');
                }
            });
        })();
    </script>
</div>

{{-- ═══════════════ CALCULATOR MODAL ═══════════════ --}}
<div id="calculator"></div>

<style>
/* ── Calc Modal Overlay ── */
.calc-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 2000;
    background: rgba(8, 22, 54, 0.55);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    align-items: center;
    justify-content: center;
    padding: 16px;
    animation: calcFadeIn 0.22s ease;
}
.calc-modal-overlay.is-open { display: flex; }
@keyframes calcFadeIn {
    from { opacity: 0; }
    to   { opacity: 1; }
}

/* ── Calc Modal Box ── */
.calc-modal {
    background: #fff;
    border-radius: 28px;
    width: 100%;
    max-width: 780px;
    max-height: 90vh;
    overflow-y: auto;
    scrollbar-width: none;       /* Firefox */
    -ms-overflow-style: none;    /* IE/Edge */
    box-shadow: 0 32px 80px rgba(10,82,158,0.22);
    animation: calcSlideUp 0.28s cubic-bezier(0.34, 1.4, 0.64, 1);
    position: relative;
}
.calc-modal::-webkit-scrollbar { display: none; } /* Chrome/Safari */
@keyframes calcSlideUp {
    from { opacity: 0; transform: translateY(28px) scale(0.97); }
    to   { opacity: 1; transform: translateY(0)   scale(1); }
}

/* Header */
.calc-modal__header {
    background: linear-gradient(135deg, #0a529e 0%, #1976d2 100%);
    border-radius: 28px 28px 0 0;
    padding: 26px 32px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.calc-modal__header-left { display: flex; align-items: center; gap: 14px; }
.calc-modal__icon {
    width: 46px; height: 46px;
    background: rgba(255,255,255,0.18);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.calc-modal__title {
    color: #fff;
    font-size: 1.25rem;
    font-weight: 800;
    margin: 0;
}
.calc-modal__subtitle {
    color: rgba(255,255,255,0.72);
    font-size: 0.82rem;
    margin: 2px 0 0;
}
.calc-modal__close {
    width: 44px; height: 44px;
    background: rgba(255,255,255,0.18);
    border: 1.5px solid rgba(255,255,255,0.28);
    outline: none;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    color: #fff;
    font-size: 18px;
    line-height: 1;
    transition: background 0.2s, border-color 0.2s;
    flex-shrink: 0;
}
.calc-modal__close:hover { background: rgba(255,255,255,0.30); border-color: rgba(255,255,255,0.50); }

/* Body */
.calc-modal__body { padding: 28px 32px 32px; }

/* Step label */
.calc-step-label {
    font-size: 0.72rem;
    font-weight: 800;
    letter-spacing: 1.8px;
    text-transform: uppercase;
    color: #0a529e;
    margin-bottom: 8px;
}

/* Product select */
.calc-select {
    width: 100%;
    appearance: none;
    -webkit-appearance: none;
    background: #f0f5ff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='none' stroke='%230a529e' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' viewBox='0 0 24 24'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E") no-repeat right 16px center;
    border: 1.5px solid rgba(10,82,158,0.15);
    border-radius: 14px;
    padding: 14px 44px 14px 18px;
    font-size: 1rem;
    font-weight: 600;
    color: #1a2340;
    cursor: pointer;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.calc-select:focus {
    outline: none;
    border-color: #0a529e;
    box-shadow: 0 0 0 4px rgba(10,82,158,0.10);
}

/* Dimensions row */
.calc-dims {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-top: 6px;
}
.calc-input-wrap { position: relative; }
.calc-input-wrap label {
    display: block;
    font-size: 0.74rem;
    font-weight: 700;
    color: #6b7a9a;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
}
.calc-input-wrap input {
    width: 100%;
    border: 1.5px solid rgba(10,82,158,0.15);
    border-radius: 14px;
    padding: 13px 16px 13px 44px;
    font-size: 1rem;
    font-weight: 600;
    color: #1a2340;
    background: #f9fbff;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.calc-input-wrap input:focus {
    outline: none;
    border-color: #0a529e;
    box-shadow: 0 0 0 4px rgba(10,82,158,0.10);
    background: #fff;
}
.calc-input-wrap input::placeholder { color: #b0bcd4; font-weight: 500; }
.calc-input-wrap svg {
    position: absolute;
    bottom: 14px;
    left: 14px;
    color: #0a529e;
    pointer-events: none;
}

/* Calc btn */
.calc-submit-btn {
    width: 100%;
    margin-top: 20px;
    background: linear-gradient(115deg, #0a529e, #1976d2);
    color: #fff;
    border: none;
    border-radius: 14px;
    padding: 15px 20px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    box-shadow: 0 8px 24px rgba(10,82,158,0.28);
    transition: transform 0.2s, box-shadow 0.2s;
}
.calc-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 32px rgba(10,82,158,0.36);
}
.calc-submit-btn:active { transform: translateY(0); }

/* Divider */
.calc-divider {
    border: none;
    border-top: 1.5px solid #f0f3fa;
    margin: 22px 0;
}

/* Results heading */
.calc-results-heading {
    font-size: 0.72rem;
    font-weight: 800;
    letter-spacing: 1.8px;
    text-transform: uppercase;
    color: #0a529e;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.calc-results-heading::after {
    content: "";
    flex: 1;
    height: 1.5px;
    background: #e8f0fd;
    border-radius: 2px;
}

/* Result row */
.calc-modal .calc-result-row {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 10px 14px;
    border-radius: 12px;
    margin-bottom: 6px;
    background: #f9fbff;
    transition: background 0.15s;
}
.calc-modal .calc-result-row:hover { background: #eef4ff; }
.calc-result-thumb {
    width: 44px; height: 44px;
    border-radius: 10px;
    object-fit: contain;
    background: #fff;
    border: 1px solid #e8f0fd;
    flex-shrink: 0;
    padding: 3px;
}
.calc-result-name {
    flex: 1;
    font-size: 0.9rem;
    font-weight: 600;
    color: #1a2340;
}
.calc-result-qty {
    font-size: 1rem;
    font-weight: 800;
    color: #0a529e;
    background: rgba(10,82,158,0.09);
    border-radius: 8px;
    padding: 4px 12px;
    min-width: 52px;
    text-align: center;
}

/* Area badge shown after calc */
.calc-area-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(10,82,158,0.09);
    color: #0a529e;
    font-size: 0.82rem;
    font-weight: 700;
    border-radius: 20px;
    padding: 5px 14px;
    margin-bottom: 16px;
}

/* Empty state */
.calc-empty {
    text-align: center;
    padding: 36px 20px;
    color: #9aabca;
}
.calc-empty svg { margin-bottom: 12px; opacity: 0.5; }
.calc-empty p { font-size: 0.9rem; margin: 0; }

@media (max-width: 575px) {
    .calc-modal__body { padding: 20px 18px 24px; }
    .calc-modal__header { padding: 20px 18px; }
    .calc-dims { grid-template-columns: 1fr; }
}
</style>

{{-- Modal markup --}}
<div class="calc-modal-overlay" id="calcModalOverlay">
    <div class="calc-modal" id="calcModal" role="dialog" aria-modal="true" aria-labelledby="calcModalTitle">

        {{-- Header --}}
        <div class="calc-modal__header">
            <div class="calc-modal__header-left">
                <div class="calc-modal__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="8" y1="10" x2="16" y2="10"/><line x1="8" y1="14" x2="12" y2="14"/></svg>
                </div>
                <div>
                    <div class="calc-modal__title" id="calcModalTitle">@lang('main.calculator')</div>
                    <div class="calc-modal__subtitle">@lang('main.width') × @lang('main.height') → @lang('main.calc')</div>
                </div>
            </div>
            <button class="calc-modal__close" id="calcModalClose" aria-label="Close">&#x2715;</button>
        </div>

        {{-- Body --}}
        <div class="calc-modal__body">

            {{-- Step 1: Product --}}
            <div class="calc-step-label">01 &mdash; @lang('main.clip-in') / @lang('main.vinil') / @lang('main.lay-in')</div>
            <select class="calc-select select_potolok">
                <option value="clip-in-6060">@lang('main.clip-in') 60×60</option>
                <option value="clip-in-3030">@lang('main.clip-in') 30×30</option>
                <option value="lay-in-6060">@lang('main.lay-in') 60×60</option>
                <option value="winil6060">@lang('main.vinil') 60×60</option>
                <option value="winil60120">@lang('main.vinil') 60×120</option>
            </select>

            {{-- Step 2: Dimensions --}}
            <div style="margin-top: 20px;">
                <div class="calc-step-label">02 &mdash; @lang('main.width') &amp; @lang('main.height') (m²)</div>
                <div class="calc-dims">
                    <div class="calc-input-wrap">
                        <label>@lang('main.width') (m)</label>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M21 3H3v4h18V3z"/><path d="M3 7v14"/><path d="M21 7v14"/><line x1="9" y1="12" x2="15" y2="12"/></svg>
                        <input type="number" min="0.1" step="0.1" class="calc-input ini" placeholder="e.g. 5.0">
                    </div>
                    <div class="calc-input-wrap">
                        <label>@lang('main.height') (m)</label>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M3 21h4V3H3v18z"/><path d="M7 3h14"/><path d="M7 21h14"/><line x1="12" y1="9" x2="12" y2="15"/></svg>
                        <input type="number" min="0.1" step="0.1" class="calc-input uzynlygy" placeholder="e.g. 4.0">
                    </div>
                </div>
            </div>

            {{-- Calculate button --}}
            <button type="button" class="calc-submit-btn calculate_btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                @lang('main.calc')
            </button>

            {{-- Divider --}}
            <hr class="calc-divider" id="calcDivider" style="display:none;">

            {{-- Results --}}
            <div id="calcResults">
                <div class="calc-empty">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="8" y1="6" x2="16" y2="6"/><line x1="8" y1="10" x2="16" y2="10"/><line x1="8" y1="14" x2="12" y2="14"/></svg>
                    <p>@lang('main.width') × @lang('main.height') giriziň we hasaplaň</p>
                </div>
            </div>

            {{-- Keep old hidden area for JS compatibility --}}
            <div class="calculator_area_inner d-none" id="nav-tabContent"></div>

        </div>
    </div>
</div>



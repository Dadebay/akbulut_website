


<style>
    .contact-section {
        position: relative;
        padding: 80px 0;
        background: url('{{ asset('images/background.jpg') }}') center center / cover no-repeat;
        overflow: hidden;
    }
    .contact-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(5, 25, 60, 0.88) 0%, rgba(10, 82, 158, 0.75) 100%);
        z-index: 0;
    }
    .contact-section > .container {
        position: relative;
        z-index: 1;
    }
    .contact-section-title {
        font-size: 2rem;
        font-weight: 700;
        color: #fff;
        letter-spacing: 1px;
        margin-bottom: 14px;
    }
    .contact-section-subtitle {
        color: rgba(255,255,255,0.7);
        font-size: 1rem;
        margin-bottom: 48px;
    }
    .contact-card {
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        overflow: hidden;
        height: 100%;
    }
    .contact-map-iframe {
        width: 100%;
        height: 480px;
        border: 0;
        display: block;
    }
    .contact-map-label {
        background: rgba(255,255,255,0.08);
        padding: 16px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        color: #fff;
        font-size: 0.92rem;
        border-top: 1px solid rgba(255,255,255,0.1);
    }
    .contact-map-label svg { flex-shrink: 0; }
    .contact-form-wrapper {
        padding: 36px 32px;
    }
    .contact-form-wrapper h3 {
        color: #fff;
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 6px;
    }
    .contact-form-wrapper p {
        color: rgba(255,255,255,0.6);
        font-size: 0.9rem;
        margin-bottom: 28px;
    }
    .contact-input-group {
        position: relative;
        margin-bottom: 20px;
    }
    .contact-input-group svg {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255,255,255,0.45);
        pointer-events: none;
    }
    .contact-input-group textarea ~ svg {
        top: 18px;
        transform: none;
    }
    .contact-input-group input,
    .contact-input-group textarea {
        width: 100%;
        background: rgba(255, 255, 255, 0.09);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 12px;
        color: #fff;
        padding: 14px 16px 14px 44px;
        font-size: 0.95rem;
        transition: border-color 0.25s, background 0.25s;
        outline: none;
        resize: none;
    }
    .contact-input-group input::placeholder,
    .contact-input-group textarea::placeholder {
        color: rgba(255,255,255,0.4);
    }
    .contact-input-group input:focus,
    .contact-input-group textarea:focus {
        border-color: rgba(255,255,255,0.5);
        background: rgba(255, 255, 255, 0.13);
    }
    .contact-submit-btn {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #0a529e 0%, #1271cc 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.15s;
        margin-top: 8px;
    }
    .contact-submit-btn:hover { opacity: 0.88; transform: translateY(-1px); }
    .contact-submit-btn:active { transform: translateY(0); }

    /* ── Success Popup ── */
    #contactSuccessOverlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.55);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
    }
    #contactSuccessOverlay.show { display: flex; }
    .contact-success-box {
        background: #fff;
        border-radius: 20px;
        padding: 44px 40px 36px;
        max-width: 420px;
        width: 90%;
        text-align: center;
        position: relative;
        animation: popIn 0.3s ease;
    }
    @keyframes popIn {
        from { opacity: 0; transform: scale(0.85); }
        to   { opacity: 1; transform: scale(1); }
    }
    .contact-success-icon {
        width: 68px;
        height: 68px;
        background: linear-gradient(135deg, #0a529e, #1271cc);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
    }
    .contact-success-icon svg { color: #fff; }
    .contact-success-box h4 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 10px;
    }
    .contact-success-box p {
        font-size: 0.93rem;
        color: #555;
        margin-bottom: 4px;
        line-height: 1.6;
    }
    .contact-success-close {
        margin-top: 24px;
        padding: 11px 36px;
        background: linear-gradient(135deg, #0a529e, #1271cc);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: opacity 0.2s;
    }
    .contact-success-close:hover { opacity: 0.85; }

    @media (max-width: 991px) {
        .contact-map-iframe { height: 300px; }
        .contact-form-wrapper { padding: 28px 22px; }
        .contact-section { padding: 50px 0; }
    }
</style>

<section id="contact" class="contact-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="contact-section-title">@lang('main.contact_us_header')</h2>
            <p class="contact-section-subtitle">@lang('main.type_message')</p>
        </div>

        <div class="row g-4 align-items-stretch">

            {{-- Left: OpenStreetMap --}}
            <div class="col-lg-6">
                <div class="contact-card">
                    <iframe
                        class="contact-map-iframe"
                        src="https://maps.google.com/maps?q=37.9563845,58.4241547&z=18&t=h&output=embed"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <div class="contact-map-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <a href="https://www.google.com/maps/place/Ak+bulut+%22HJ%22/@37.9565135,58.4239424,448m/data=!3m1!1e3!4m6!3m5!1s0x3f6fffea54fa4265:0x9e8711703cd46699!8m2!3d37.9563845!4d58.4241547!16s%2Fg%2F11h0bhhg48?entry=ttu" target="_blank" style="color:inherit;text-decoration:none;">G. Kuliyev st. 29, Ashgabat, Turkmenistan</a>
                    </div>
                </div>
            </div>

            {{-- Right: Contact Form --}}
            <div class="col-lg-6">
                <div class="contact-card">
                    <div class="contact-form-wrapper">
                        <h3>@lang('main.contact_us_header')</h3>
                        <p>@lang('main.type_message')</p>

                        <form class="contact_form" id="contactForm" novalidate>
                            <div class="contact-input-group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <input type="text" name="contact_name" id="contact_name" placeholder="@lang('main.name')" autocomplete="off" required>
                            </div>

                            <div class="contact-input-group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <input type="tel" name="contact_phone" id="contact_phone" placeholder="@lang('main.phone')" autocomplete="off" required>
                            </div>

                            <div class="contact-input-group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                <textarea name="text_body" id="text_body" rows="5" placeholder="@lang('main.type_message')" required></textarea>
                            </div>

                            <button type="submit" class="contact-btn contact-submit-btn">
                                @lang('main.send')
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Success Popup (3 languages) --}}
<div id="contactSuccessOverlay">
    <div class="contact-success-box">
        <div class="contact-success-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <h4>@lang('main.message_sent')</h4>
        <p>@lang('main.contact_24h')</p>
        <button class="contact-success-close" onclick="closeContactSuccess()">OK</button>
    </div>
</div>

<script>
    function closeContactSuccess() {
        document.getElementById('contactSuccessOverlay').classList.remove('show');
    }
    document.getElementById('contactSuccessOverlay').addEventListener('click', function(e) {
        if (e.target === this) closeContactSuccess();
    });
</script>

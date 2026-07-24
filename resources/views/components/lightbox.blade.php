<div id="lightbox"
     class="hidden"
     style="position:fixed;inset:0;background:rgba(0,0,0,0.95);z-index:1000;align-items:center;justify-content:center;padding:20px;">
    <button id="lightbox-close"
            style="position:absolute;top:20px;right:24px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.15);border-radius:4px;color:#fff;width:40px;height:40px;font-size:1.2rem;cursor:pointer;display:flex;align-items:center;justify-content:center;">✕</button>
    <img id="lightbox-img"
         src=""
         alt="{{ __('common.site_name') }}"
         style="max-width:90vw;max-height:85vh;object-fit:contain;border-radius:4px;box-shadow:0 40px 80px rgba(0,0,0,0.8);">
    <p id="lightbox-caption"
       style="position:absolute;bottom:20px;left:50%;transform:translateX(-50%);color:rgba(255,255,255,0.6);font-size:0.85rem;font-family:'Space Grotesk',sans-serif;text-align:center;max-width:500px;"></p>
</div>

<?php
?>

<!-- Font Awesome CDN for WhatsApp Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Simple WhatsApp Button - Direct Redirect -->
<a href="https://wa.me/27810032073?text=Hi%20MFC%20Support,%20I%20need%20help%20from%20your%20website" target="_blank" class="whatsapp-float-btn">
    <i class="fab fa-whatsapp whatsapp-float-icon"></i>
    <span class="whatsapp-tooltip">Chat with us on WhatsApp</span>
</a>

<style>
/* WhatsApp Float Button */
.whatsapp-float-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background: #25D366;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    z-index: 9998;
    animation: pulse 2s infinite;
    text-decoration: none;
}

@keyframes pulse {
    0% {
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    50% {
        box-shadow: 0 2px 20px rgba(37, 211, 102, 0.4);
    }
    100% {
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
}

.whatsapp-float-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    animation: none;
}

.whatsapp-float-icon {
    font-size: 28px;
    color: white;
}

.whatsapp-tooltip {
    position: absolute;
    right: 70px;
    background: #333;
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 14px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
}

.whatsapp-tooltip::after {
    content: '';
    position: absolute;
    left: 100%;
    top: 50%;
    transform: translateY(-50%);
    border: 6px solid transparent;
    border-left-color: #333;
}

.whatsapp-float-btn:hover .whatsapp-tooltip {
    opacity: 1;
}

/* Responsive Design */
@media (max-width: 768px) {
    .whatsapp-float-btn {
        width: 50px;
        height: 50px;
        bottom: 15px;
        right: 15px;
    }
    
    .whatsapp-float-icon {
        font-size: 24px;
    }
    
    .whatsapp-tooltip {
        font-size: 12px;
        right: 60px;
    }
}
</style>

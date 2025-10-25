// Custom Dropdown Handler
document.querySelectorAll('.custom-dropdown').forEach(drop => {
    const opener = drop.querySelector('.dropdown-opener');
    const menu = drop.querySelector('.dropdown-menu-custom');
    const span = opener.querySelector('span');
    const hiddenInput = drop.querySelector("input[name='who']");

    // open/close
    opener.addEventListener('click', e => {
        e.stopPropagation();
        menu.classList.toggle('d-none');
        opener.classList.toggle('open');
        opener.classList.toggle('active');
    });

    // handle selection
    drop.querySelectorAll('.item').forEach(item => {
        item.addEventListener('click', e => {
            e.stopPropagation();

            // remove old selection
            drop.querySelectorAll('.item').forEach(i => {
                i.classList.remove('selected');
                i.querySelector('.tick').classList.add('d-none');
            });

            // set new selection
            item.classList.add('selected');
            item.querySelector('.tick').classList.remove('d-none');
            const selectedText = item.textContent.trim();
            span.textContent = selectedText;
            // span.classList.remove('placeholder');
            span.classList.add('selected');

            // update hidden input value
            hiddenInput.value = selectedText;

            // clear any validation errors
            clearFieldError(drop.parentElement);

            // close menu
            menu.classList.add('d-none');
            opener.classList.remove('open');
            opener.classList.add('active');
        });
    });

    // click outside closes menu
    document.addEventListener('click', e => {
        if (!drop.contains(e.target)) {
            menu.classList.add('d-none');
            opener.classList.remove('open');
        }
    });
});

// Form Validation and Submission
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form data
            const formData = new FormData(this);
            const data = {
                name: formData.get('name'),
                email: formData.get('email'),
                phone_number: formData.get('phone_number'),
                service_needed: formData.get('service_needed'),
                message: formData.get('message'),
                consent: formData.get('consent')
            };

            // Validate form
            if (validateForm(data)) {
                submitForm(data);
            }
        });
    }
});

// Form validation function
function validateForm(data) {
    let isValid = true;

    // Clear all previous errors
    clearAllErrors();

    // Validate name (required)
    const nameInput = document.querySelector("input[name='name']");
    if (nameInput) {
        const nameField = nameInput.parentElement;
        if (!data.name || data.name.trim() === '') {
            showFieldError(nameField, 'Please enter your name');
            isValid = false;
        } else if (data.name.trim().length < 2) {
            showFieldError(nameField, 'Name must be at least 2 characters long');
            isValid = false;
        }
    }

    // Validate email (required)
    const emailInput = document.querySelector("input[name='email']");
    if (emailInput) {
        const emailField = emailInput.parentElement;
        if (!data.email || data.email.trim() === '') {
            showFieldError(emailField, 'Please enter your email');
            isValid = false;
        } else if (!isValidEmail(data.email)) {
            showFieldError(emailField, 'Please enter a valid email address');
            isValid = false;
        }
    }

    // Validate phone number (required)
    const phoneInput = document.querySelector("input[name='phone_number']");
    if (phoneInput) {
        const phoneField = phoneInput.parentElement;
        if (!data.phone_number || data.phone_number.trim() === '') {
            showFieldError(phoneField, 'Please enter your phone number');
            isValid = false;
        }
    }

    // Validate service needed (required)
    const serviceInput = document.querySelector("input[name='service_needed']");
    if (serviceInput) {
        const serviceField = serviceInput.parentElement;
        if (!data.service_needed || data.service_needed.trim() === '') {
            showFieldError(serviceField, 'Please enter the service you need');
            isValid = false;
        }
    }

    // Validate message (required)
    const messageInput = document.querySelector("textarea[name='message']");
    if (messageInput) {
        const messageField = messageInput.parentElement;
        if (!data.message || data.message.trim() === '') {
            showFieldError(messageField, 'Please enter your message');
            isValid = false;
        } else if (data.message.trim().length < 10) {
            showFieldError(messageField, 'Message must be at least 10 characters long');
            isValid = false;
        }
    }

    // Validate consent checkbox (required)
    const consentInput = document.querySelector("input[name='consent']");
    if (consentInput) {
        const consentField = consentInput.parentElement.parentElement;
        if (!data.consent) {
            showFieldError(consentField, 'Please accept the consent to continue');
            isValid = false;
        }
    }

    return isValid;
}

// Email validation helper
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Show field error
function showFieldError(field, message) {
    const errorMsg = field.querySelector('.error-msg');
    if (errorMsg) {
        errorMsg.textContent = message;
        errorMsg.classList.remove('d-none');
    }

    // Add error styling to input
    const input = field.querySelector('input, textarea, .dropdown-opener');
    if (input) {
        input.classList.add('border-danger');
    }
}

// Clear field error
function clearFieldError(field) {
    const errorMsg = field.querySelector('.error-msg');
    if (errorMsg) {
        errorMsg.classList.add('d-none');
    }

    // Remove error styling
    const input = field.querySelector('input, textarea, .dropdown-opener');
    if (input) {
        input.classList.remove('border-danger');
    }
}

// Clear all errors
function clearAllErrors() {
    document.querySelectorAll('.error-msg').forEach(error => {
        error.classList.add('d-none');
    });

    document.querySelectorAll('.border-danger').forEach(input => {
        input.classList.remove('border-danger');
    });
}

// Submit form function
async function submitForm(data) {
    const submitBtn = document.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;

    // Hide all messages first
    hideAllMessages();

    try {
        // Show loading state with spinner
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
            Submitting...
        `;

        // Create FormData for PHP submission
        const formData = new FormData();
        formData.append('name', data.name);
        formData.append('email', data.email);
        formData.append('phone_number', data.phone_number);
        formData.append('service_needed', data.service_needed);
        formData.append('message', data.message);
        formData.append('consent', data.consent ? '1' : '0');

        // Submit to actual PHP endpoint
        const response = await fetch('phpmailer/sendmail.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();

        if (response.ok && result.success) {
            // Show success message
            showSuccessMessage();
            resetForm();
        } else {
            throw new Error(result.message || 'Network response was not ok');
        }

    } catch (error) {
        console.error('Error:', error);
        // Show error message
        showErrorMessage();
    } finally {
        // Reset button state
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }
}


// Show success message
function showSuccessMessage() {
    hideAllMessages();
    const successMsg = document.querySelector('.message.success');
    if (successMsg) {
        successMsg.classList.add('show');
        successMsg.style.display = 'flex';

        // Auto-hide after 5 seconds
        setTimeout(() => {
            successMsg.classList.remove('show');
            successMsg.style.display = 'none';
        }, 5000);
    }
}

// Show error message
function showErrorMessage() {
    hideAllMessages();
    const errorMsg = document.querySelector('.message.failed');
    if (errorMsg) {
        errorMsg.classList.add('show');
        errorMsg.style.display = 'flex';

        // Auto-hide after 5 seconds
        setTimeout(() => {
            errorMsg.classList.remove('show');
            errorMsg.style.display = 'none';
        }, 5000);
    }
}


// Hide all messages
function hideAllMessages() {
    document.querySelectorAll('.message').forEach(msg => {
        msg.classList.remove('show');
        msg.style.display = 'none';
    });
}

// Reset form
function resetForm() {
    const form = document.getElementById('contactForm');
    form.reset();

    // Clear all errors
    clearAllErrors();
}

// Message close handlers
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.close-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const message = this.closest('.message');
            if (message) {
                message.classList.add('d-none');
                message.classList.remove('d-flex');
                message.style.display = 'none';
            }
        });
    });
});

// Real-time validation (optional)
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('blur', function() {
            const field = this.parentElement;
            const value = this.value.trim();

            // Clear previous error
            clearFieldError(field);

            // Validate on blur
            if (this.hasAttribute('required') && !value) {
                return; // Will be caught by form validation
            }

            // Specific field validation
            if (this.name === 'email' && value && !isValidEmail(value)) {
                showFieldError(field, 'Please enter a valid email address');
            }

            if (this.name === 'name' && value && value.length < 2) {
                showFieldError(field, 'Name must be at least 2 characters long');
            }

            if (this.name === 'phone_number' && value && value.length < 5) {
                showFieldError(field, 'Please enter a valid phone number');
            }

            if (this.name === 'service_needed' && value && value.length < 2) {
                showFieldError(field, 'Please specify the service you need');
            }

            if (this.name === 'message' && value && value.length < 10) {
                showFieldError(field, 'Message must be at least 10 characters long');
            }
        });
    });
});
// ======================
// Toggle Accordion
// ======================
$("#toggle-button").click(function () {
    $(".toggle-more-accordion").slideToggle(500);
    $(this).find(".see-more, .see-less").toggleClass("d-none");
});


// ======================
// Leaflet Map
// ======================

const map = L.map('map', {
    crs: L.CRS.Simple,
    minZoom: -0.5,
    maxZoom: -0.5,
    zoom: 1.2,
    center: [500, 1200],
    attributionControl: false,
    zoomSnap: 0.1,
    zoomControl: false,
    dragging: false,
    scrollWheelZoom: false,
    doubleClickZoom: false,
    touchZoom: false,
    tap: false // ✅ Fix mobile double tap issue
});

const imageUrl = 'assets/images/contact.svg';
const imageWidth = 1920;
const imageHeight = 1080;
const imageBounds = [[0, 0], [imageHeight, imageWidth]];
L.imageOverlay(imageUrl, imageBounds).addTo(map);
map.setView([600, 1250], 0);

function createSvgIcon() {
    const markerSvg = `
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 14 12" fill="none">
      <path d="M10.3711 11.4214H3.99869L0.8125 5.8683L3.99869 0.40625H10.3711L13.4662 5.8683L10.3711 11.4214Z" fill="#8C462F"/>
    </svg>`;
    return L.divIcon({
        className: 'custom-marker',
        html: markerSvg,
        iconSize: [40, 40],
        iconAnchor: [20, 20]
    });
}

const locations = [
    {
        coords: [550, 1215],
        title: "Dubai, UAE",
        icon: "assets/images/icons/location-pin.svg",
        goTo: "assets/images/icons/redirect.svg",
        address: "Essa Saleh, al Gurg building - office 203 16th St - Al Hamriya - Dubai - United Arab Emirates",
        mapsUrl: "https://maps.app.goo.gl/JpkpTVSpDnm4agRMA?g_st=iwb"
    },

];

locations.forEach(loc => {
    const popupContent = `
      <div class="custom-popup">
        <div class="d-flex align-items-center justify-content-between w-100">
          <h6 class="d-flex mb-0 align-items-center gap-2 text-dark-100 font-headline fw-medium">
            <img src="${loc.icon}" alt="${loc.title}" width="16" height="16"/>
            ${loc.title}
          </h6>
          <a href="${loc.mapsUrl}" target="_blank" rel="noopener noreferrer">
            <img src="${loc.goTo}" width="16" height="16"/>
          </a>
        </div>
        <p class="text-dark-200 font-geist fw-normal small">${loc.address}</p>
      </div>
    `;

    const popupOptions = {
        offset: L.point(-11, -12),
        closeButton: false,
        autoPan: true, // ✅ ensures popup is fully visible
        autoPanPadding: [50, 50], // ✅ adds padding when auto-panning
        className: 'custom-leaflet-popup'
    };

    const marker = L.marker(loc.coords, { icon: createSvgIcon() })
        .addTo(map)
        .bindPopup(popupContent, popupOptions);

    // Desktop hover
    if (window.innerWidth > 768) {
        marker.on("mouseover", () => marker.openPopup());
        marker.on("mouseout", () => {
            const popupEl = marker.getPopup().getElement();

            if (popupEl) {
                popupEl.addEventListener("mouseenter", () => {
                    marker.openPopup();
                });

                popupEl.addEventListener("mouseleave", () => {
                    marker.closePopup();
                });
            }

            setTimeout(() => {
                if (!popupEl.matches(":hover")) {
                    marker.closePopup();
                }
            }, 100);
        });
    } else {
        // Mobile → open on click
        marker.on("click", () => {
            marker.openPopup();
        });
    }
});

// ======================
// Close Button Messages
// ======================
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll(".close-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            const message = this.closest(".message");
            if (message) {
                message.classList.add("hide");
                setTimeout(() => message.remove(), 300);
            }
        });
    });
});

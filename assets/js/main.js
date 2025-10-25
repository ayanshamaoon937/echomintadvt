// Enable hover open for dropdown-mega on large screens
(function(){
  const mql = window.matchMedia('(min-width: 992px)');
  function bindHover(){
    const megaItems = document.querySelectorAll('.dropdown-mega');
    megaItems.forEach(function(item){
      const toggle = item.querySelector('[data-bs-toggle="dropdown"]');
      const menu = item.querySelector('.dropdown-menu');
      if(!toggle || !menu) return;
      let hideTimer;
      
      function show(){
        if(!mql.matches) return;
        clearTimeout(hideTimer);
        
        // Add show classes for smooth transition
        toggle.classList.add('show');
        menu.classList.add('show');
        item.classList.add('show'); // Add show class to dropdown-mega for chevron rotation
        toggle.setAttribute('aria-expanded', 'true');
        
        // Ensure menu is visible immediately
        menu.style.display = 'block';
        
        // Trigger opacity transition
        requestAnimationFrame(() => {
          menu.style.opacity = '1';
        });
      }
      
      function hide(){
        if(!mql.matches) return;
        hideTimer = setTimeout(function(){
          // Start fade out
          menu.style.opacity = '0';
          
          // Remove classes after transition
          setTimeout(() => {
            toggle.classList.remove('show');
            menu.classList.remove('show');
            item.classList.remove('show'); // Remove show class from dropdown-mega
            toggle.setAttribute('aria-expanded', 'false');
            menu.style.display = 'none';
          }, 200); // Match CSS transition duration
        }, 300); // Increased delay to prevent instant closing
      }
      
      // Show on hover over the dropdown item (nav-link area)
      item.addEventListener('mouseenter', show);
      item.addEventListener('mouseleave', hide);
      
      // Keep open while hovering over the dropdown menu itself
      menu.addEventListener('mouseenter', show);
      menu.addEventListener('mouseleave', hide);
      
      // Also show when hovering directly over the toggle link
      toggle.addEventListener('mouseenter', show);
      
      // Prevent default Bootstrap dropdown behavior on desktop
      toggle.addEventListener('click', function(e) {
        if(mql.matches) {
          e.preventDefault();
          // Allow navigation to services.php if it's a link
          if(toggle.getAttribute('href') && toggle.getAttribute('href') !== '#') {
            window.location.href = toggle.getAttribute('href');
          }
        }
      });
    });
  }
  bindHover();
})();

// Debug Bootstrap loading
console.log('Bootstrap check:', typeof bootstrap !== 'undefined' ? 'loaded' : 'not loaded');

// Mobile offcanvas nested collapse: close siblings when one opens
(function(){
  document.addEventListener('show.bs.collapse', function(e){
    const target = e.target;
    const parentList = target.closest('.list-group');
    if(!parentList) return;
    parentList.querySelectorAll('.collapse.show').forEach(function(openEl){
      if(openEl !== target){
        const bsCollapse = bootstrap.Collapse.getInstance(openEl) || new bootstrap.Collapse(openEl, {toggle:false});
        bsCollapse.hide();
      }
    });
  });
})();

// Footer year
(function(){
  var y = document.getElementById('year');
  if(y){ y.textContent = new Date().getFullYear(); }
})();

// Navigation Active State Handler
(function(){
  function setActiveNavigation() {
    // Get current page path
    const currentPath = window.location.pathname;
    const currentPage = currentPath.split('/').pop().replace('.php', '') || 'index';
    
    // Remove all existing active classes
    document.querySelectorAll('.nav-link, .dropdown-item, .list-group-item').forEach(function(link) {
      link.classList.remove('active');
    });
    
    // Desktop navigation
    const desktopNavLinks = document.querySelectorAll('#mainNavbar .nav-link');
    const desktopDropdownItems = document.querySelectorAll('#mainNavbar .dropdown-item');
    
    // Mobile navigation
    const mobileNavLinks = document.querySelectorAll('#mobileNav .list-group-item');
    
    // Set active state for main navigation items
    desktopNavLinks.forEach(function(link) {
      const href = link.getAttribute('href');
      if (href) {
        const linkPage = href.replace('.php', '').replace('/', '');
        if (linkPage === currentPage || (currentPage === 'index' && linkPage === 'index')) {
          link.classList.add('active');
        }
      }
    });
    
    // Set active state for mobile main navigation items
    mobileNavLinks.forEach(function(link) {
      const href = link.getAttribute('href');
      if (href && !link.hasAttribute('data-bs-toggle')) {
        const linkPage = href.replace('.php', '').replace('/', '');
        if (linkPage === currentPage || (currentPage === 'index' && linkPage === 'index')) {
          link.classList.add('active');
        }
      }
    });
    
    // Check if current page is a service page
    let isServicePage = false;
    let activeServiceFound = false;
    
    // Set active state for service dropdown items (desktop)
    desktopDropdownItems.forEach(function(item) {
      const href = item.getAttribute('href');
      if (href) {
        const linkPage = href.replace('.php', '').replace('/', '');
        if (linkPage === currentPage) {
          item.classList.add('active');
          isServicePage = true;
          activeServiceFound = true;
          
          // Also set the Services dropdown toggle as active
          const servicesDropdown = document.querySelector('#mainNavbar .dropdown-toggle[href*="services"]');
          if (servicesDropdown) {
            servicesDropdown.classList.add('active');
          }
        }
      }
    });
    
    // Set active state for service items in mobile menu
    const mobileServiceLinks = document.querySelectorAll('#mobileNav .collapse .list-group-item');
    mobileServiceLinks.forEach(function(item) {
      const href = item.getAttribute('href');
      if (href) {
        const linkPage = href.replace('.php', '').replace('/', '');
        if (linkPage === currentPage) {
          item.classList.add('active');
          isServicePage = true;
          
          // Expand the parent collapse section
          const parentCollapse = item.closest('.collapse');
          if (parentCollapse) {
            parentCollapse.classList.add('show');
            
            // Find and mark the parent category as active
            const parentToggle = document.querySelector(`[href="#${parentCollapse.id}"]`);
            if (parentToggle) {
              parentToggle.classList.add('active');
            }
          }
        }
      }
    });
    
    // If on services.php page, mark Services nav item as active
    if (currentPage === 'services') {
      const servicesNavLink = document.querySelector('#mainNavbar .nav-link[href*="services"]');
      if (servicesNavLink) {
        servicesNavLink.classList.add('active');
      }
      
      const mobileServicesLink = document.querySelector('#mobileNav .list-group-item[href*="services"]');
      if (mobileServicesLink) {
        mobileServicesLink.classList.add('active');
      }
    }
  }
  
  // Run on page load
  document.addEventListener('DOMContentLoaded', setActiveNavigation);
  
  // Also run immediately if DOM is already loaded
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setActiveNavigation);
  } else {
    setActiveNavigation();
  }
})();



// Hero Slider Initialization
$(document).ready(function() {
    const heroSwiper = new Swiper('.heroSwiper', {
        // Center mode configuration
        centeredSlides: true,
        slidesPerView: 'auto',
        spaceBetween: 30,
        loop: true,
        
        // Center mode specific settings
        centeredSlidesBounds: true,
        
        // Responsive breakpoints
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
                centeredSlides: true,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
                centeredSlides: true,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
                centeredSlides: true,
            }
        },
        
        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        
        // Pagination
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        
        // Autoplay
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        
        // Effect
        effect: 'slide',
        
        // Speed
        speed: 600,
        
        // Events
        on: {
            init: function () {
                // Add active class to center slide
                this.slides.forEach((slide, index) => {
                    if (index === this.activeIndex) {
                        slide.classList.add('swiper-slide-active');
                    }
                });
            },
            slideChange: function () {
                // Update active class on slide change
                this.slides.forEach(slide => {
                    slide.classList.remove('swiper-slide-active');
                });
                this.slides[this.activeIndex].classList.add('swiper-slide-active');
            }
        }
    });
});


/**
 * Red-Knot Consulting - Main JavaScript
 * Dubai Immigration Consultancy Website
 */

(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    
    // Validate selector
    if (!el || el === '#' || el === '') {
      return all ? [] : null;
    }
    
    try {
      if (all) {
        return [...document.querySelectorAll(el)]
      } else {
        return document.querySelector(el)
      }
    } catch (error) {
      console.warn('Invalid selector:', el, error);
      return all ? [] : null;
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Scrolls to an element with header offset
   */
  const scrollto = (el) => {
    let header = select('#header')
    let offset = header.offsetHeight

    if (!header.classList.contains('header-scrolled')) {
      offset -= 16
    }

    let elementPos = select(el).offsetTop
    window.scrollTo({
      top: elementPos - offset,
      behavior: 'smooth'
    })
  }

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      
      // Close other dropdowns
      const allDropdowns = select('.navbar .dropdown', true)
      allDropdowns.forEach(dropdown => {
        if (dropdown !== this.parentElement) {
          dropdown.classList.remove('dropdown-active')
          const menu = dropdown.querySelector('.dropdown-menu')
          if (menu) menu.classList.remove('dropdown-active')
        }
      })
      
      // Toggle current dropdown
      this.parentElement.classList.toggle('dropdown-active')
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Scrollto links
   */
  on('click', '.scrollto', function(e) {
    if (select(this.hash)) {
      e.preventDefault()

      let navbar = select('#navbar')
      if (navbar.classList.contains('navbar-mobile')) {
        navbar.classList.remove('navbar-mobile')
        let navbarToggle = select('.mobile-nav-toggle')
        navbarToggle.classList.toggle('bi-list')
        navbarToggle.classList.toggle('bi-x')
      }
      scrollto(this.hash)
    }
  }, true)

  /**
   * Scroll with offset on page load with hash links in the url
   */
  window.addEventListener("load", () => {
    if (window.location.hash) {
      if (select(window.location.hash)) {
        scrollto(window.location.hash)
      }
    }
  });



  /**
   * Animation on scroll
   */
  function aos_init() {
    AOS.init({
      duration: 1000,
      easing: "ease-in-out",
      once: true,
      mirror: false
    });
  }
  /**
   * Dropdown Navigation - Unified Implementation
   * Works with existing mobile navigation system
   */
  function initDropdownNav() {
    // Desktop dropdown hover is handled by CSS
    // Mobile dropdown click is handled by the existing mobile nav system above
    
    // Just ensure dropdowns work on window resize
    window.addEventListener('resize', function() {
      const dropdowns = select('.navbar .dropdown', true);
      if (dropdowns) {
        dropdowns.forEach(dropdown => {
          const menu = dropdown.querySelector('.dropdown-menu');
          if (menu) {
            // Clear any inline styles on resize
            menu.style.display = '';
            dropdown.classList.remove('dropdown-active');
            menu.classList.remove('dropdown-active');
          }
        });
      }
    });
    
    // Close mobile navigation when clicking dropdown links
    const dropdownLinks = select('.navbar .dropdown-menu a', true);
    if (dropdownLinks) {
      dropdownLinks.forEach(link => {
        link.addEventListener('click', function() {
          const navbar = select('#navbar');
          const mobileToggle = select('.mobile-nav-toggle');
          
          if (navbar && navbar.classList.contains('navbar-mobile')) {
            // Close mobile navigation
            navbar.classList.remove('navbar-mobile');
            if (mobileToggle) {
              mobileToggle.classList.remove('bi-x');
              mobileToggle.classList.add('bi-list');
            }
          }
        });
      });
    }
  }

  window.addEventListener('load', () => {
    aos_init();
    initDropdownNav();
    initSwiper();
  });

  /**
   * Initiate Swiper slider
   */
  function initSwiper() {
    if (typeof Swiper !== 'undefined' && document.querySelector('.slides-3')) {
      new Swiper('.slides-3', {
        speed: 600,
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false
        },
        slidesPerView: 'auto',
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true
        },
        breakpoints: {
          320: {
            slidesPerView: 1,
            spaceBetween: 40
          },
          1200: {
            slidesPerView: 3,
            spaceBetween: 40
          }
        }
      });
    }
  }
  
  // Initialize Swiper after a short delay to ensure it's loaded
  setTimeout(initSwiper, 100);

  /**
   * Language switching functionality
   */
  window.switchLanguage = function(lang) {
    const englishContent = select('#content-en');
    const arabicContent = select('#content-ar');
    const langBtns = select('.lang-btn', true);
    
    // Remove active class from all buttons
    langBtns.forEach(btn => btn.classList.remove('active'));
    
    if (lang === 'ar') {
      // Show Arabic content
      if (arabicContent) {
        arabicContent.style.display = 'block';
        document.documentElement.setAttribute('dir', 'rtl');
        document.documentElement.setAttribute('lang', 'ar');
      }
      if (englishContent) {
        englishContent.style.display = 'none';
      }
      // Add active class to Arabic button
      const arabicBtn = select('.lang-btn[onclick*="ar"]');
      if (arabicBtn) arabicBtn.classList.add('active');
      
      // Store language preference
      localStorage.setItem('preferred-language', 'ar');
    } else {
      // Show English content
      if (englishContent) {
        englishContent.style.display = 'block';
      }
      if (arabicContent) {
        arabicContent.style.display = 'none';
      }
      document.documentElement.setAttribute('dir', 'ltr');
      document.documentElement.setAttribute('lang', 'en');
      
      // Add active class to English button
      const englishBtn = select('.lang-btn[onclick*="en"]');
      if (englishBtn) englishBtn.classList.add('active');
      
      // Store language preference
      localStorage.setItem('preferred-language', 'en');
    }
  }

  /**
   * Load saved language preference
   */
  window.addEventListener('load', () => {
    const savedLang = localStorage.getItem('preferred-language') || 'en';
    switchLanguage(savedLang);
  });

  /**
   * Visa Eligibility Form Handler
   */
  const eligibilityForm = select('#eligibility-form');
  if (eligibilityForm) {
    eligibilityForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(this);
      const data = Object.fromEntries(formData);
      
      // Basic eligibility assessment logic
      let eligibilityScore = 0;
      let recommendations = [];
      
      // Nationality scoring
      const highDemandNationalities = ['india', 'pakistan', 'bangladesh', 'philippines'];
      if (highDemandNationalities.includes(data.nationality)) {
        eligibilityScore += 25;
      } else {
        eligibilityScore += 15;
      }
      
      // Education scoring
      const educationScores = {
        'high-school': 15,
        'diploma': 20,
        'bachelor': 25,
        'master': 30
      };
      eligibilityScore += educationScores[data.education] || 10;
      
      // Experience scoring
      const experienceScores = {
        '0-2': 15,
        '3-5': 20,
        '6-10': 25,
        '10+': 30
      };
      eligibilityScore += experienceScores[data.experience] || 10;
      
      // Field scoring
      const highDemandFields = ['construction', 'hospitality', 'manufacturing'];
      if (highDemandFields.includes(data.field)) {
        eligibilityScore += 30;
        recommendations.push(`High demand for ${data.field} workers in Dubai`);
      } else {
        eligibilityScore += 20;
      }
      
      // Generate recommendations
      if (eligibilityScore >= 80) {
        recommendations.unshift('Excellent visa prospects! You meet most requirements.');
      } else if (eligibilityScore >= 60) {
        recommendations.unshift('Good visa prospects with proper documentation.');
      } else {
        recommendations.unshift('Moderate prospects. Additional qualifications may help.');
      }
      
      // Show results
      showEligibilityResults(data, eligibilityScore, recommendations);
      
      // Send to Telegram (if configured)
      sendFormDataToTelegram('eligibility', data);
    });
  }

  /**
   * Show eligibility assessment results
   */
  function showEligibilityResults(data, score, recommendations) {
    const resultHtml = `
      <div class="eligibility-results mt-4 p-4 border rounded bg-light">
        <h4 class="text-primary">Assessment Results for ${data.name}</h4>
        <div class="score-indicator mb-3">
          <strong>Eligibility Score: ${score}/100</strong>
          <div class="progress mt-2">
            <div class="progress-bar ${score >= 80 ? 'bg-success' : score >= 60 ? 'bg-warning' : 'bg-info'}" 
                 style="width: ${score}%"></div>
          </div>
        </div>
        <div class="recommendations">
          <h5>Recommendations:</h5>
          <ul>
            ${recommendations.map(rec => `<li>${rec}</li>`).join('')}
          </ul>
        </div>
        <div class="next-steps mt-3">
          <p><strong>Next Steps:</strong></p>
          <p>Our team will contact you on ${data.phone} within 24 hours to discuss your application process.</p>
          <a href="https://wa.me/971XXXXXXXXX?text=Hi, I completed the eligibility assessment and scored ${score}/100. Please help me with the next steps." 
             class="btn btn-success btn-sm">
            <i class="fab fa-whatsapp"></i> Chat on WhatsApp Now
          </a>
        </div>
      </div>
    `;
    
    // Insert results after the form
    eligibilityForm.insertAdjacentHTML('afterend', resultHtml);
    
    // Scroll to results
    setTimeout(() => {
      const results = select('.eligibility-results');
      if (results) {
        results.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    }, 100);
  }

  /**
   * Contact Form Handler (Netlify Forms with additional processing)
   */
  const contactForm = select('form[name="contact"]');
  if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
      const formData = new FormData(this);
      const data = Object.fromEntries(formData);
      
      // Send to Telegram as backup
      sendFormDataToTelegram('contact', data);
      
      // Show thank you message
      setTimeout(() => {
        showThankYouMessage();
      }, 1000);
    });
  }

  /**
   * Send form data to Telegram
   */
  async function sendFormDataToTelegram(formType, data) {
    // This would be configured with actual bot token and chat ID
    const botToken = 'YOUR_BOT_TOKEN';
    const chatId = 'YOUR_CHAT_ID';
    
    if (!botToken || botToken === 'YOUR_BOT_TOKEN') {
      console.log('Telegram bot not configured. Form data:', data);
      return;
    }
    
    let message = '';
    
    if (formType === 'eligibility') {
      message = `
🔔 NEW ELIGIBILITY ASSESSMENT
👤 Name: ${data.name}
📱 Phone: ${data.phone}
🌍 Nationality: ${data.nationality}
🎓 Education: ${data.education}
💼 Experience: ${data.experience}
🏢 Field: ${data.field}
⏰ Time: ${new Date().toLocaleString()}
      `;
    } else if (formType === 'contact') {
      message = `
🔔 NEW CONTACT FORM SUBMISSION
👤 Name: ${data.name}
📧 Email: ${data.email}
📱 Phone: ${data.phone}
🏢 Service: ${data.service}
📝 Subject: ${data.subject}
💬 Message: ${data.message}
⏰ Time: ${new Date().toLocaleString()}
      `;
    }
    
    try {
      await fetch(`https://api.telegram.org/bot${botToken}/sendMessage`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          chat_id: chatId,
          text: message,
          parse_mode: 'HTML'
        })
      });
    } catch (error) {
      console.error('Failed to send to Telegram:', error);
    }
  }

  /**
   * Show thank you message after form submission
   */
  function showThankYouMessage() {
    const thankYouHtml = `
      <div class="thank-you-message alert alert-success mt-4" role="alert">
        <h4 class="alert-heading">Thank You!</h4>
        <p>Your message has been sent successfully. Our team will contact you within 24 hours.</p>
        <hr>
        <p class="mb-0">
          For immediate assistance, you can also contact us on 
          <a href="https://wa.me/971XXXXXXXXX" class="alert-link">WhatsApp</a>.
        </p>
      </div>
    `;
    
    contactForm.insertAdjacentHTML('afterend', thankYouHtml);
    contactForm.reset();
    
    // Remove thank you message after 10 seconds
    setTimeout(() => {
      const thankYouMsg = select('.thank-you-message');
      if (thankYouMsg) {
        thankYouMsg.remove();
      }
    }, 10000);
  }

  /**
   * Smooth scrolling for anchor links
   */
  document.addEventListener('click', function(e) {
    if (e.target.matches('a[href^="#"]')) {
      e.preventDefault();
      const targetId = e.target.getAttribute('href');
      
      // Skip if href is just "#" or empty
      if (targetId === '#' || targetId === '' || targetId.length <= 1) {
        return;
      }
      
      const targetElement = document.querySelector(targetId);
      
      if (targetElement) {
        const headerHeight = document.querySelector('#header').offsetHeight;
        const targetPosition = targetElement.offsetTop - headerHeight;
        
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
      }
    }
  });

  /**
   * Loading animation
   */
  window.addEventListener('load', () => {
    const preloader = select('#preloader');
    if (preloader) {
      preloader.remove();
    }
  });

  /**
   * Intersection Observer for animations
   */
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate');
      }
    });
  }, observerOptions);

  // Observe elements for animation
  const animateElements = select('.service-item, .process-item, .testimonial-item', true);
  if (animateElements) {
    animateElements.forEach(el => observer.observe(el));
  }

  /**
   * Form validation enhancement
   */
  const forms = select('form', true);
  forms.forEach(form => {
    const inputs = form.querySelectorAll('input, select, textarea');
    
    inputs.forEach(input => {
      // Real-time validation feedback
      input.addEventListener('blur', function() {
        if (this.checkValidity()) {
          this.classList.add('is-valid');
          this.classList.remove('is-invalid');
        } else {
          this.classList.add('is-invalid');
          this.classList.remove('is-valid');
        }
      });
      
      // Clear validation on focus
      input.addEventListener('focus', function() {
        this.classList.remove('is-valid', 'is-invalid');
      });
    });
  });

  /**
   * WhatsApp floating button pulse effect
   */
  const whatsappFloat = select('.whatsapp-float');
  if (whatsappFloat) {
    // Add click tracking
    whatsappFloat.addEventListener('click', function() {
      // Track WhatsApp click (could integrate with analytics)
      if (typeof gtag !== 'undefined') {
        gtag('event', 'click', {
          event_category: 'engagement',
          event_label: 'whatsapp_float'
        });
      }
    });
  }

  /**
   * Auto-fill country code in phone fields
   */
  const phoneInputs = select('input[type="tel"]', true);
  phoneInputs.forEach(input => {
    input.addEventListener('focus', function() {
      if (this.value === '') {
        this.value = '+91'; // Default to India, most common for Dubai immigration
      }
    });
  });

  /**
   * Accessibility improvements
   */
  // Skip to main content link
  const skipLink = document.createElement('a');
  skipLink.href = '#hero';
  skipLink.textContent = 'Skip to main content';
  skipLink.className = 'sr-only sr-only-focusable';
  skipLink.style.cssText = `
    position: absolute;
    top: -40px;
    left: 6px;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0,0,0,0);
    white-space: nowrap;
    border: 0;
  `;
  
  skipLink.addEventListener('focus', function() {
    this.style.cssText = `
      position: absolute;
      top: 6px;
      left: 6px;
      width: auto;
      height: auto;
      padding: 8px 16px;
      margin: 0;
      overflow: visible;
      clip: auto;
      white-space: normal;
      background: var(--uae-blue);
      color: white;
      text-decoration: none;
      border-radius: 4px;
      z-index: 10000;
    `;
  });
  
  skipLink.addEventListener('blur', function() {
    this.style.cssText = `
      position: absolute;
      top: -40px;
      left: 6px;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0,0,0,0);
      white-space: nowrap;
      border: 0;
    `;
  });
  
  document.body.insertBefore(skipLink, document.body.firstChild);

})(); 
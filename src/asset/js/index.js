document.addEventListener("DOMContentLoaded", function () {
  // Function to update tabindex for hidden slides
  function updateTabindexForHiddenSlides() {
    const allSlides = document.querySelectorAll('.my-slider .slide');
    allSlides.forEach(slide => {
      // Assuming 'tns-slide-active' class is added to visible slides by Tiny Slider
      const isVisible = slide.classList.contains('tns-slide-active');
      const focusables = slide.querySelectorAll('a, button, input, textarea, select, details, [tabindex]');
      focusables.forEach(focusable => {
        focusable.setAttribute('tabindex', isVisible ? '0' : '-1');
      });
    });
  }

  // Initialize the slider with Tiny Slider
  let slider = tns({
    container: ".my-slider",
    slideBy: "1",
    speed: 400,
    nav: false,
    autoplay: true,
    controls: false,
    autoplayButtonOutput: false,
    responsive: {
      1600: { items: 4, gutter: 20 },
      1024: { items: 3, gutter: 20 },
      768: { items: 2, gutter: 20 },
      480: { items: 1, gutter: 20 }
    },
    onInit: updateTabindexForHiddenSlides // Call on slider initialization
  });

  // Listen for slide changes to update tabindex
  slider.events.on('indexChanged', updateTabindexForHiddenSlides);

  // Handle subscription status from URL parameters
  var urlParams = new URLSearchParams(window.location.search);
  var subscribe = urlParams.get('subscribe');

  if (subscribe === 'success') {
    var successModal = new bootstrap.Modal(document.getElementById('thankYouModal'), {});
    successModal.show();
  } else if (subscribe === 'exists') {
    var existsModal = new bootstrap.Modal(document.getElementById('alreadySubscribedModal'), {});
    existsModal.show();
  } else if (subscribe === 'failure') {
    var failureModal = new bootstrap.Modal(document.getElementById('failureModal'), {});
    failureModal.show();
  }

  // Explicitly scroll to the subscribe-container if not automatically done by the browser
  if (window.location.hash === '#subscribe') {
    const subscribeSection = document.getElementById('subscribe');
    if (subscribeSection) {
      subscribeSection.scrollIntoView({ behavior: 'smooth' });
    }
  }
});

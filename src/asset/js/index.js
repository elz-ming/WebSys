let slider = tns({
  container: ".my-slider",
  slideBy: "1",
  speed: 400,
  nav: false,
  autoplay: true,
  controls: false,
  autoplayButtonOutput: false,
  responsive: {
    1600: {
      items: 4,
      gutter: 20
    },
    1024: {
      items: 3,
      gutter: 20
    },
    768: {
      items: 2,
      gutter: 20
    },
    480: {
      items: 1,
      gutter: 20
    }
  }
});

document.addEventListener("DOMContentLoaded", function(){
  var urlParams = new URLSearchParams(window.location.search);
  var subscribe = urlParams.get('subscribe');

  if(subscribe === 'success') {
    var successModal = new bootstrap.Modal(document.getElementById('thankYouModal'), {});
    successModal.show();
  } else if(subscribe === 'exists') {
    var existsModal = new bootstrap.Modal(document.getElementById('alreadySubscribedModal'), {});
    existsModal.show();
  } else if(subscribe === 'failure') {
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
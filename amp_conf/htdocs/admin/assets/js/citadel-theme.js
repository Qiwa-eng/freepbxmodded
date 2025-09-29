(function($, window, document) {
  'use strict';

  if (typeof $ === 'undefined') {
    return;
  }

  var $body = $('body');
  var $loader = $('#citadel-loader');
  var root = document.documentElement;
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var parallaxFrame;

  function setParallax(evt) {
    if (parallaxFrame || reduceMotion) {
      return;
    }
    parallaxFrame = window.requestAnimationFrame(function() {
      var x = (evt.clientX / window.innerWidth - 0.5) * 6;
      var y = (evt.clientY / window.innerHeight - 0.5) * 6;
      root.style.setProperty('--fpbx-parallax-x', x.toFixed(2) + 'deg');
      root.style.setProperty('--fpbx-parallax-y', (-y).toFixed(2) + 'deg');
      parallaxFrame = null;
    });
  }

  function hideLoader() {
    if (!$loader.length) {
      return;
    }
    $loader.addClass('citadel-loader-hidden');
    $body.addClass('citadel-loaded');
  }

  function showLoader() {
    if (!$loader.length) {
      return;
    }
    $loader.removeClass('citadel-loader-hidden');
  }

  $(function() {
    if ($loader.length) {
      showLoader();
    }

    var $brand = $('.navbar-brand.citadel-navbar-brand');
    $brand.each(function() {
      var $self = $(this);
      var label = $self.data('brand-label') || $self.attr('title') || document.title;
      if (label && !$self.find('.citadel-brand-wordmark').length) {
        $self.append('<span class="citadel-brand-wordmark">' + label + '</span>');
      }
    });

    if (!reduceMotion && window.matchMedia('(pointer:fine)').matches) {
      document.addEventListener('mousemove', setParallax, { passive: true });
    }

    if ($loader.length) {
      $(window).on('load', function() {
        window.setTimeout(function() {
          hideLoader();
        }, 420);
      });

      $(document).ajaxStart(function() {
        window.clearTimeout($loader.data('citadelTimer'));
        showLoader();
      });

      $(document).ajaxStop(function() {
        var timer = window.setTimeout(hideLoader, 360);
        $loader.data('citadelTimer', timer);
      });

      $loader.on('click', '.citadel-loader__core', function() {
        var link = $(this).data('brand-link');
        if (link && link !== '#') {
          window.open(link, '_blank');
        }
      });
    }
  });

})(window.jQuery, window, document);

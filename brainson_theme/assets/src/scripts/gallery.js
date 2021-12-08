document.addEventListener(
    "DOMContentLoaded",
    () => {
      document.querySelectorAll("[data-gallery]").forEach((gallery) => {
        lightGallery(gallery, {
          counter: false,
          download: false, 
          loop: true,
        });
      });

    },
    false
  );
  
  window.gallery = function () {
    return {
      leftEnd: true,
      rightEnd: false,
      scroll(e) {
        var scrollLeft = e.target.scrollLeft;
        var containerScrollWidth = e.target.scrollWidth;
        var containerWidth = e.target.offsetWidth;
        var elementWidth = e.target.getElementsByClassName(
          "c-scroll-tiles__image-tile"
        )[0].offsetWidth;
  
        if (containerScrollWidth - (containerWidth + scrollLeft) <= 0) {
          this.rightEnd = true;
        } else {
          this.rightEnd = false;
        }
  
        if (scrollLeft <= 0) {
          this.leftEnd = true;
        } else {
          this.leftEnd = false;
        }
      },
      next(e) {
        // element width plus 32px margin
        var elementWidth =
          e.target.parentElement.parentElement.parentElement.getElementsByClassName(
            "c-scroll-tiles__image-tile"
          )[0].offsetWidth + 32;
        e.target.parentElement.parentElement.parentElement.getElementsByClassName(
          "c-scroll-tiles__container"
        )[0].scrollLeft += elementWidth;
      },
      prev(e) {
        // element width plus 32px margin
        var elementWidth =
          e.target.parentElement.parentElement.parentElement.getElementsByClassName(
            "c-scroll-tiles__image-tile"
          )[0].offsetWidth + 32;
        e.target.parentElement.parentElement.parentElement.getElementsByClassName(
          "c-scroll-tiles__container"
        )[0].scrollLeft -= elementWidth;
      },
    };
  };
  
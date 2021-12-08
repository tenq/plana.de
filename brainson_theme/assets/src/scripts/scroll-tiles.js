window.scrolltiles = function () {
    return {
      leftEnd: true,
      rightEnd: false,
      scroll(e) {
        var scrollLeft = e.target.scrollLeft;
        var containerScrollWidth = e.target.scrollWidth;
        var containerWidth = e.target.offsetWidth;
        var elementWidth = e.target.getElementsByClassName(
          "c-scroll-tiles__tile"
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
        // element width plus 16px margin
        var elementWidth = e.target.parentElement.parentElement.parentElement.getElementsByClassName(
          "c-scroll-tiles__tile"
        )[0].offsetWidth + 16;
        e.target.parentElement.parentElement.parentElement.getElementsByClassName(
          "c-scroll-tiles__container"
        )[0].scrollLeft += elementWidth;
  
        
      },
      prev(e) {
        // element width plus 16px margin
        var elementWidth = e.target.parentElement.parentElement.parentElement.getElementsByClassName(
          "c-scroll-tiles__tile"
        )[0].offsetWidth + 16;
        e.target.parentElement.parentElement.parentElement.getElementsByClassName(
          "c-scroll-tiles__container"
        )[0].scrollLeft -= elementWidth;
      },
    };
  };
  

import { tns } from "./../../../node_modules/tiny-slider/src/tiny-slider";

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".slider").forEach((sliderSelector) => {
    var nextButton =
      sliderSelector.parentElement.parentElement.querySelector(".slider__next");
    var prevButton =
      sliderSelector.parentElement.parentElement.querySelector(".slider__prev");

    var slider = tns({
      autoplayButtonOutput: false,
      container: sliderSelector,
      items: 1,
      slideBy: "page",
      autoplay: false,
      mouseDrag: true,
      prevButton: prevButton,
      nextButton: nextButton,
      nav: false,
    });

    var activeColorClass = "opacity-100";
    var inactiveColorClass = "opacity-40";

    var paginationElements =
      sliderSelector.parentElement.parentElement.parentElement.parentElement.parentElement.getElementsByClassName(
        "slider__pagination"
      )[0].children;

    for (let element of paginationElements) {
      element.addEventListener("click", function (ev) {
        slider.pause();
        slider.goTo(ev.target.dataset.index-1);
      });
    }

    slider.events.on("transitionEnd", function (info, eventName) {
      var sliderContainer =
        info.container.parentElement.parentElement.parentElement.parentElement
          .parentElement;
      var paginationElements =
        sliderContainer.getElementsByClassName("slider__pagination")[0]
          .children;

      var currentPaginationElementIndex = info.displayIndex - 1;
      var currentPaginationElement =
        paginationElements[currentPaginationElementIndex];

      for (let element of paginationElements) {
        element.children[0].classList.remove(activeColorClass);
        element.children[0].classList.add(inactiveColorClass);
      }

      currentPaginationElement.children[0].classList.remove(inactiveColorClass);
      currentPaginationElement.children[0].classList.add(activeColorClass);
    });
  });
});

(function () {
  function replaceFeather() {
    if (typeof feather !== "undefined") {
      feather.replace();
    }
  }
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", replaceFeather);
  } else {
    replaceFeather();
  }
})();
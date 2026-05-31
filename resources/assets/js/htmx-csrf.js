(function () {
  document.addEventListener("htmx:configRequest", function (evt) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (csrfToken) {
      evt.detail.headers["X-Csrf-Token"] = csrfToken.getAttribute("content");
    }
  });
}());

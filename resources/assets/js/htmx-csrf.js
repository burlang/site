(function () {
  document.addEventListener("htmx:config:request", function (evt) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (csrfToken) {
      evt.detail.ctx.request.headers["X-Csrf-Token"] = csrfToken.getAttribute("content");
    }
  });
}());

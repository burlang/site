(function () {
  "use strict";

  function getSystemTheme() {
    return window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
  }

  function getStoredTheme() {
    return localStorage.getItem("theme");
  }

  function setTheme(theme, save) {
    document.documentElement.setAttribute("data-theme", theme);
    if (save) {
      localStorage.setItem("theme", theme);
    }
  }

  function initTheme() {
    var stored = getStoredTheme();
    setTheme(stored || getSystemTheme());
  }

  initTheme();

  // Auto-switch only if no stored preference
  window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", function (e) {
    if (!getStoredTheme()) {
      setTheme(e.matches ? "dark" : "light");
    }
  });

  // Export for manual use
  window.toggleTheme = function () {
    var current = document.documentElement.getAttribute("data-theme");
    var newTheme = current === "dark" ? "light" : "dark";
    setTheme(newTheme, true);
  };
})();

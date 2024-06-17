$(document).ready(function () {
  $('.image-responsive-container img').addClass('img-responsive');

  $('button.add-input-letter').on('click', function () {
    let $this = $(this);
    $this.parent('span').siblings('input').sendkeys($this.text());
  });
});

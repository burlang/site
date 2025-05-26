jQuery(function ($) {
  CodeMirror.findModeByName('php').mime = 'text/x-php';
});

function initEditor(el) {
  el = $(el)[0];
  var editor = CodeMirror.fromTextArea(el, {
    mode: 'gfm',
    theme: 'default',
    extraKeys: {
      "Enter": 'newlineAndIndentContinueMarkdownList',
    },
    lineWrapping: true,
    lineNumbers: false,
    matchBrackets: true,
    autoCloseBrackets: true,
    autoCloseTags: true,
    buttons: [
      {
        hotkey: 'Ctrl-B',
        class: 'bold btn btn-default',
        label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bold-icon lucide-bold"><path d="M6 12h9a4 4 0 0 1 0 8H7a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h7a4 4 0 0 1 0 8"/></svg>',
        callback: function (cm) {
          var selection = cm.getSelection();
          cm.replaceSelection('**' + selection + '**');
          if (!selection) {
            var cursorPos = cm.getCursor();
            cm.setCursor(cursorPos.line, cursorPos.ch - 2);
          }
        }
      },
      {
        hotkey: 'Ctrl-I',
        class: 'italic btn btn-default',
        label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-italic-icon lucide-italic"><line x1="19" x2="10" y1="4" y2="4"/><line x1="14" x2="5" y1="20" y2="20"/><line x1="15" x2="9" y1="4" y2="20"/></svg>',
        callback: function (cm) {
          var selection = cm.getSelection();
          cm.replaceSelection('*' + selection + '*');
          if (!selection) {
            var cursorPos = cm.getCursor();
            cm.setCursor(cursorPos.line, cursorPos.ch - 1);
          }
        }
      },
      {
        class: 'block-code btn btn-default',
        label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-code-icon lucide-code"><path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/></svg>',
        callback: function (cm) {
          var language = prompt('Language') || '';

          var selection = cm.getSelection();
          cm.replaceSelection("```" + language + "\n" + selection + "\n```\n");
          if (!selection) {
            var cursorPos = cm.getCursor();
            cm.setCursor(cursorPos.line - 2, 0);
          }
        }
      },
      {
        class: 'quote btn btn-default',
        label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-text-quote-icon lucide-text-quote"><path d="M17 6H3"/><path d="M21 12H8"/><path d="M21 18H8"/><path d="M3 12v6"/></svg>',
        callback: function (cm) {
          cm.replaceSelection("> " + cm.getSelection());
        }
      },
      {
        class: 'ul btn btn-default',
        label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-icon lucide-list"><path d="M3 12h.01"/><path d="M3 18h.01"/><path d="M3 6h.01"/><path d="M8 12h13"/><path d="M8 18h13"/><path d="M8 6h13"/></svg>',
        callback: function (cm) {
          cm.replaceSelection("- " + cm.getSelection());
        }
      },
      {
        class: 'ol btn btn-default',
        label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-ordered-icon lucide-list-ordered"><path d="M10 12h11"/><path d="M10 18h11"/><path d="M10 6h11"/><path d="M4 10h2"/><path d="M4 6h1v4"/><path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1"/></svg>',
        callback: function (cm) {
          cm.replaceSelection("1. " + cm.getSelection());
        }
      },
      {
        class: 'a btn btn-default',
        label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-link-icon lucide-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>',
        callback: function (cm) {
          var selection = cm.getSelection();
          var text = '';
          var link = '';

          if (selection.match(/^https?:\/\//)) {
            link = selection;
          } else {
            text = selection;
          }
          cm.replaceSelection('[' + text + '](' + link + ')');

          var cursorPos = cm.getCursor();
          if (!selection) {
            cm.setCursor(cursorPos.line, cursorPos.ch - 3);
          } else if (link) {
            cm.setCursor(cursorPos.line, cursorPos.ch - (3 + link.length));
          } else {
            cm.setCursor(cursorPos.line, cursorPos.ch - 1);
          }
        }
      },
      {
        class: 'img btn btn-default',
        label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-image-icon lucide-image"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>',
        callback: function (cm) {

          var selection = cm.getSelection();

          if (!selection) {
            var url = prompt('Add image url') || '';
            cm.replaceSelection('![](' + url + ')');

            var cursorPos = cm.getCursor();
            if (url == '') {
              cm.setCursor(cursorPos.line, cursorPos.ch - 1);
            }
          } else {
            cm.replaceSelection('![](' + selection + ')');
          }
        }
      },
      {
        class: 'img btn btn-default',
        label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus-icon lucide-minus"><path d="M5 12h14"/></svg>',
        callback: function (cm) {
          cm.replaceSelection("- - -\n");
        }
      },
      {
        class: 'btn btn-default',
        label: 'Ү',
        callback: function (cm) {
          cm.replaceSelection('Ү');
        }
      },
      {
        class: 'btn btn-default',
        label: 'ү',
        callback: function (cm) {
          cm.replaceSelection('ү');
        }
      },
      {
        class: 'btn btn-default',
        label: 'Һ',
        callback: function (cm) {
          cm.replaceSelection('Һ');
        }
      },
      {
        class: 'btn btn-default',
        label: 'һ',
        callback: function (cm) {
          cm.replaceSelection('һ');
        }
      },
      {
        class: 'btn btn-default',
        label: 'Ө',
        callback: function (cm) {
          cm.replaceSelection('Ө');
        }
      },
      {
        class: 'btn btn-default',
        label: 'ө',
        callback: function (cm) {
          cm.replaceSelection('ө');
        }
      }
    ]
  });
}

$(document).ready(function () {
  if ($('#markdown-editor').length) {
    initEditor($('#markdown-editor'));
  }
});

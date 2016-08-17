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
                label: '<i class="glyphicon glyphicon-bold"></i>',
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
                label: '<i class="glyphicon glyphicon-italic"></i>',
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
                label: 'CODE',
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
                label: '<i class="glyphicon glyphicon-menu-right"></i>',
                callback: function (cm) {
                    cm.replaceSelection("> " + cm.getSelection());
                }
            },
            {
                class: 'ul btn btn-default',
                label: 'UL',
                callback: function (cm) {
                    cm.replaceSelection("- " + cm.getSelection());
                }
            },
            {
                class: 'ol btn btn-default',
                label: 'OL',
                callback: function (cm) {
                    cm.replaceSelection("1. " + cm.getSelection());
                }
            },
            {
                class: 'a btn btn-default',
                label: '<i class="glyphicon glyphicon-link"></i>',
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
                label: '<i class="glyphicon glyphicon-picture"></i>',
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
                label: '<i class="glyphicon glyphicon-resize-small"></i>',
                callback: function (cm) {
                    $('.CodeMirror').css('height', 'auto');
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

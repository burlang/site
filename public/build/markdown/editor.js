(function($) {
    'use strict';

    const EDITOR_CONFIG = {
        mode: 'gfm',
        theme: 'default',
        extraKeys: {
            'Enter': 'newlineAndIndentContinueMarkdownList',
            'Ctrl-B': 'boldSelection',
            'Ctrl-I': 'italicSelection'
        },
        lineWrapping: true,
        lineNumbers: false,
        matchBrackets: true,
        autoCloseBrackets: true,
        autoCloseTags: true
    };

    const MARKDOWN_SYNTAX = {
        bold: { wrap: '**', hotkey: 'Ctrl-B' },
        italic: { wrap: '*', hotkey: 'Ctrl-I' },
        quote: { prefix: '> ' },
        unorderedList: { prefix: '- ' },
        orderedList: { prefix: '1. ' },
        horizontalRule: { insert: '---\n' }
    };

    const SPECIAL_CHARS = [
        { label: 'Ү', char: 'Ү' },
        { label: 'ү', char: 'ү' },
        { label: 'Һ', char: 'Һ' },
        { label: 'һ', char: 'һ' },
        { label: 'Ө', char: 'Ө' },
        { label: 'ө', char: 'ө' }
    ];

    const wrapSelection = (cm, wrapper) => {
        const selection = cm.getSelection();
        const wrappedText = wrapper + selection + wrapper;
        cm.replaceSelection(wrappedText);

        if (!selection) {
            const cursorPos = cm.getCursor();
            cm.setCursor(cursorPos.line, cursorPos.ch - wrapper.length);
        }
    };

    const prefixSelection = (cm, prefix) => {
        const selection = cm.getSelection();

        if (selection.includes('\n')) {
            const lines = selection.split('\n');
            const prefixedLines = lines.map(line => prefix + line);
            cm.replaceSelection(prefixedLines.join('\n'));
        } else {
            cm.replaceSelection(prefix + selection);
        }
    };

    const insertCodeBlock = (cm) => {
        const selection = cm.getSelection();
        const language = selection ? '' : (prompt('Enter language (optional):') || '');

        cm.replaceSelection(`\`\`\`${language}\n${selection}\n\`\`\`\n`);

        if (!selection) {
            const cursorPos = cm.getCursor();
            cm.setCursor(cursorPos.line - 2, 0);
        }
    };

    const insertLink = (cm) => {
        const selection = cm.getSelection();
        let text = '';
        let url = '';

        if (selection.match(/^https?:\/\//)) {
            url = selection;
            text = prompt('Enter link text:') || 'Link';
        } else {
            text = selection || prompt('Enter link text:') || 'Link';
            url = prompt('Enter URL:') || '';
        }

        cm.replaceSelection(`[${text}](${url})`);

        if (!selection && !url) {
            const cursorPos = cm.getCursor();
            cm.setCursor(cursorPos.line, cursorPos.ch - 1);
        }
    };

    const insertImage = (cm) => {
        const selection = cm.getSelection();
        let alt = '';
        let url = '';

        if (selection.match(/^https?:\/\//)) {
            url = selection;
            alt = prompt('Enter image description (optional):') || '';
        } else {
            alt = selection || prompt('Enter image description (optional):') || '';
            url = prompt('Enter image URL:') || '';
        }

        cm.replaceSelection(`![${alt}](${url})`);

        if (!url) {
            const cursorPos = cm.getCursor();
            cm.setCursor(cursorPos.line, cursorPos.ch - 1);
        }
    };

    const createEditorButtons = () => {
        const buttons = [
            {
                hotkey: MARKDOWN_SYNTAX.bold.hotkey,
                class: 'btn btn-default editor-btn editor-btn-bold',
                title: 'Bold (Ctrl+B)',
                html: true,
                label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 12h9a4 4 0 0 1 0 8H7a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h7a4 4 0 0 1 0 8"/></svg>',
                callback: (cm) => wrapSelection(cm, MARKDOWN_SYNTAX.bold.wrap)
            },
            {
                hotkey: MARKDOWN_SYNTAX.italic.hotkey,
                class: 'btn btn-default editor-btn editor-btn-italic',
                title: 'Italic (Ctrl+I)',
                html: true,
                label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" x2="10" y1="4" y2="4"/><line x1="14" x2="5" y1="20" y2="20"/><line x1="15" x2="9" y1="4" y2="20"/></svg>',
                callback: (cm) => wrapSelection(cm, MARKDOWN_SYNTAX.italic.wrap)
            },
            {
                class: 'btn btn-default editor-btn editor-btn-code',
                title: 'Code Block',
                html: true,
                label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m16 18 6-6-6-6"/><path d="m8 6-6 6 6 6"/></svg>',
                callback: insertCodeBlock
            },
            {
                class: 'btn btn-default editor-btn editor-btn-quote',
                title: 'Quote',
                html: true,
                label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 6H3"/><path d="M21 12H8"/><path d="M21 18H8"/><path d="M3 12v6"/></svg>',
                callback: (cm) => prefixSelection(cm, MARKDOWN_SYNTAX.quote.prefix)
            },
            {
                class: 'btn btn-default editor-btn editor-btn-ul',
                title: 'Unordered List',
                html: true,
                label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12h.01"/><path d="M3 18h.01"/><path d="M3 6h.01"/><path d="M8 12h13"/><path d="M8 18h13"/><path d="M8 6h13"/></svg>',
                callback: (cm) => prefixSelection(cm, MARKDOWN_SYNTAX.unorderedList.prefix)
            },
            {
                class: 'btn btn-default editor-btn editor-btn-ol',
                title: 'Ordered List',
                html: true,
                label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 12h11"/><path d="M10 18h11"/><path d="M10 6h11"/><path d="M4 10h2"/><path d="M4 6h1v4"/><path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1"/></svg>',
                callback: (cm) => prefixSelection(cm, MARKDOWN_SYNTAX.orderedList.prefix)
            },
            {
                class: 'btn btn-default editor-btn editor-btn-link',
                title: 'Insert Link',
                html: true,
                label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>',
                callback: insertLink
            },
            {
                class: 'btn btn-default editor-btn editor-btn-image',
                title: 'Insert Image',
                html: true,
                label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>',
                callback: insertImage
            },
            {
                class: 'btn btn-default editor-btn editor-btn-hr',
                title: 'Horizontal Rule',
                html: true,
                label: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>',
                callback: (cm) => cm.replaceSelection(MARKDOWN_SYNTAX.horizontalRule.insert)
            }
        ];

        const specialCharButtons = SPECIAL_CHARS.map(({ label, char }) => ({
            class: 'btn btn-default editor-btn editor-btn-char',
            title: `Insert ${char}`,
            label: label,
            callback: (cm) => cm.replaceSelection(char)
        }));

        return [...buttons, ...specialCharButtons];
    };

    const registerCustomCommands = () => {
        CodeMirror.commands.boldSelection = function(cm) {
            wrapSelection(cm, MARKDOWN_SYNTAX.bold.wrap);
        };

        CodeMirror.commands.italicSelection = function(cm) {
            wrapSelection(cm, MARKDOWN_SYNTAX.italic.wrap);
        };
    };

    const initMarkdownEditor = (element) => {
        if (!element || element.hasAttribute('data-editor-initialized')) {
            return null;
        }

        const $element = $(element);
        const textArea = $element[0];

        registerCustomCommands();

        const editorConfig = {
            ...EDITOR_CONFIG,
            buttons: createEditorButtons()
        };

        const editor = CodeMirror.fromTextArea(textArea, editorConfig);

        editor.on('change', () => {
            textArea.value = editor.getValue();
            $(textArea).trigger('change');
        });

        textArea.setAttribute('data-editor-initialized', 'true');

        return editor;
    };

    window.MarkdownEditor = {
        init: initMarkdownEditor,
        initAll: () => {
            $('.markdown-editor').each(function() {
                initMarkdownEditor(this);
            });
        }
    };

    $(document).ready(() => {
        CodeMirror.findModeByName('php').mime = 'text/x-php';

        $('#markdown-editor').each(function() {
            initMarkdownEditor(this);
        });

        $('.markdown-editor').each(function() {
            initMarkdownEditor(this);
        });
    });

})(jQuery);

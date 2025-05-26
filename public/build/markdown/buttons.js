(function (root, factory) {
    'use strict';

    if (typeof exports === 'object' && typeof module === 'object') {
        module.exports = factory(
            require('codemirror/lib/codemirror'),
            require('codemirror/addon/display/panel')
        );
    } else if (typeof define === 'function' && define.amd) {
        define([
            'codemirror/lib/codemirror',
            'codemirror/addon/display/panel'
        ], factory);
    } else {
        factory(root.CodeMirror);
    }
})(typeof self !== 'undefined' ? self : this, function (CodeMirror) {
    'use strict';

    const PANEL_ELEMENT_CLASS = 'CodeMirror-buttonsPanel';
    const DEFAULT_BUTTON_TYPE = 'button';
    const DEFAULT_TABINDEX = '-1';

    const validateButtonConfig = (config) => {
        if (!config || typeof config !== 'object') {
            throw new Error('Button configuration must be an object');
        }

        if (!config.el && !config.label) {
            throw new Error('Button must have either "el" or "label" property');
        }

        if (!config.el && typeof config.callback !== 'function') {
            throw new Error('Button callback must be a function');
        }

        return true;
    };

    const createButton = (cm, config) => {
        validateButtonConfig(config);

        let buttonNode;

        if (config.el) {
            buttonNode = typeof config.el === 'function'
                ? config.el(cm)
                : config.el;

            if (!buttonNode.hasAttribute('tabindex')) {
                buttonNode.setAttribute('tabindex', DEFAULT_TABINDEX);
            }
        } else {
            buttonNode = document.createElement('button');
            buttonNode.type = DEFAULT_BUTTON_TYPE;
            buttonNode.setAttribute('tabindex', DEFAULT_TABINDEX);

            if (config.html === true) {
                buttonNode.innerHTML = config.label;
            } else {
                buttonNode.textContent = config.label;
            }

            if (config.title) {
                buttonNode.setAttribute('title', config.title);
                buttonNode.setAttribute('aria-label', config.title);
            }

            if (config.class) {
                buttonNode.className = config.class;
            }

            if (config.disabled) {
                buttonNode.disabled = true;
                buttonNode.setAttribute('aria-disabled', 'true');
            }

            const handleClick = (e) => {
                e.preventDefault();
                e.stopPropagation();

                if (!buttonNode.disabled) {
                    cm.focus();

                    try {
                        config.callback(cm, e);
                    } catch (error) {
                        console.error('Button callback error:', error);
                    }
                }
            };

            buttonNode.addEventListener('click', handleClick);

            buttonNode._cleanup = () => {
                buttonNode.removeEventListener('click', handleClick);
            };
        }

        if (config.hotkey) {
            const keyMap = {};
            keyMap[config.hotkey] = (cm) => {
                if (!buttonNode.disabled) {
                    config.callback(cm);
                }
            };
            cm.addKeyMap(CodeMirror.normalizeKeyMap(keyMap));
        }

        return buttonNode;
    };

    const createButtonPanel = (cm, buttons) => {
        const panelNode = document.createElement('div');
        panelNode.className = PANEL_ELEMENT_CLASS;
        panelNode.setAttribute('role', 'toolbar');
        panelNode.setAttribute('aria-label', 'Editor toolbar');

        const buttonElements = buttons.map(config => {
            try {
                const button = createButton(cm, config);
                panelNode.appendChild(button);
                return button;
            } catch (error) {
                console.error('Failed to create button:', error);
                return null;
            }
        }).filter(Boolean);

        panelNode._buttons = buttonElements;

        return panelNode;
    };

    const cleanupPanel = (cm, panel) => {
        if (!panel) return;

        if (panel._buttons) {
            panel._buttons.forEach(button => {
                if (button._cleanup) {
                    button._cleanup();
                }
            });
        }

        try {
            if (panel.parentNode) {
                panel.parentNode.removeChild(panel);
            }
        } catch (error) {
            console.error('Failed to remove panel:', error);
        }
    };

    CodeMirror.defineOption('buttons', [], function (cm, newButtons, oldButtons) {
        const existingPanel = cm.getWrapperElement()
            .querySelector('.' + PANEL_ELEMENT_CLASS);

        if (existingPanel) {
            cleanupPanel(cm, existingPanel);
        }

        if (Array.isArray(newButtons) && newButtons.length > 0) {
            const panel = createButtonPanel(cm, newButtons);
            cm.addPanel(panel);

            cm._buttonsPanel = panel;
        }
    });

    CodeMirror.defineExtension('updateButton', function(index, updates) {
        const panel = this._buttonsPanel;
        if (!panel || !panel._buttons || !panel._buttons[index]) {
            console.warn('Button not found at index:', index);
            return;
        }

        const button = panel._buttons[index];

        if ('disabled' in updates) {
            button.disabled = updates.disabled;
            button.setAttribute('aria-disabled', String(updates.disabled));
        }

        if ('label' in updates && button.tagName === 'BUTTON') {
            button.textContent = updates.label;
        }

        if ('html' in updates && updates.html && button.tagName === 'BUTTON') {
            button.innerHTML = updates.label || '';
        }

        if ('title' in updates) {
            button.setAttribute('title', updates.title);
            button.setAttribute('aria-label', updates.title);
        }

        if ('class' in updates) {
            button.className = updates.class;
        }
    });

    CodeMirror.defineExtension('getButton', function(index) {
        const panel = this._buttonsPanel;
        return panel && panel._buttons ? panel._buttons[index] : null;
    });

    return {
        createButton,
        createButtonPanel,
        PANEL_ELEMENT_CLASS
    };
});

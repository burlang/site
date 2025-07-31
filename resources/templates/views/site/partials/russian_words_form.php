<?php

declare(strict_types=1);

use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 */
?>
<div class="well" id="russian-words-form">
    <h3>
        Русско
        <button class="btn btn-default btn-sm"
            hx-get="<?= Url::to(['site/buryat-words-form']); ?>"
            hx-trigger="click"
            hx-target="#russian-words-form"
            hx-swap="outerHTML">
            <img src="<?= alias('@web/icon/arrow-left-right.svg'); ?>" alt="switch">
        </button>
        Бурятский словарь
    </h3>
    <hr>
    <?php $form = ActiveForm::begin([
        'action' => ['/site/find-russian-words'],
        'method' => 'get',
    ]); ?>
    <input type="search" name="q" placeholder="Введите русское слово" required="required"
        autocomplete="off" class="form-control input-lg" onkeydown="return (event.keyCode!==13);"
        autofocus id="rus-search"
        hx-get="<?= Url::to(['/site/find-russian-words']); ?>"
        hx-trigger="keyup changed delay:500ms, search"
        hx-target="#russian-words">
    <?php ActiveForm::end(); ?>
    <div id="russian-words"></div>
</div>
<style>
    #russian-words {
        transition: opacity 0.3s ease, transform 0.6s ease;
        transform-origin: top;
    }
</style>
<script>
    (function() {
        const SEARCH_INPUT_ID = 'rus-search';
        const RESULTS_CONTAINER_ID = 'russian-words';
        const LOADING_SPINNER_ID = 'loading-spinner';
        

        const spinnerSVG = `<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" style="animation: spin 1s linear infinite;">
                    <circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="2" fill="none" stroke-dasharray="12 6"/>
                </svg>`;

        function getResultsContainer() {
            return document.getElementById(RESULTS_CONTAINER_ID);
        }

        function removeSpinner() {
            const spinner = document.getElementById(LOADING_SPINNER_ID);
            if (spinner) {
                spinner.remove();
            }
        }

        function resetContainerOpacity() {
            const container = getResultsContainer();
            if (container) {
                container.style.opacity = '1';
            }
        }

        function showOverlaySpinner() {
            const container = getResultsContainer();
            const spinner = document.createElement('div');
            spinner.id = LOADING_SPINNER_ID;
            spinner.style.cssText = 'position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000;';
            spinner.innerHTML = spinnerSVG;

            container.style.position = 'relative';
            container.style.opacity = '0.7';
            container.appendChild(spinner);
        }

        function showInlineSpinner() {
            const container = getResultsContainer();
            container.innerHTML = `<div class="alert alert-success mt-20 mb-0 text-center">${spinnerSVG}</div>`;
        }

        function showErrorMessage() {
            const container = getResultsContainer();
            container.innerHTML = '<div class="alert alert-danger mt-20 mb-0">Произошла ошибка при загрузке данных</div>';
        }

        function handleSearchRequest(evt) {
            if (evt.detail.elt.id !== SEARCH_INPUT_ID) return;

            const searchValue = evt.detail.elt.value.trim();
            if (searchValue === '') {
                getResultsContainer().innerHTML = '';
                return;
            }

            const container = getResultsContainer();
            if (container.innerHTML.trim() !== '') {
                showOverlaySpinner();
            } else {
                showInlineSpinner();
            }
        }

        function handleRequestComplete(evt) {
            if (evt.detail.elt.id !== SEARCH_INPUT_ID) return;

            removeSpinner();
            resetContainerOpacity();
        }

        function handleRequestError(evt) {
            if (evt.detail.elt.id !== SEARCH_INPUT_ID) return;

            removeSpinner();
            resetContainerOpacity();
            showErrorMessage();
        }

        document.addEventListener('htmx:beforeRequest', handleSearchRequest);
        document.addEventListener('htmx:afterRequest', handleRequestComplete);
        document.addEventListener('htmx:responseError', handleRequestError);
    })();
</script>
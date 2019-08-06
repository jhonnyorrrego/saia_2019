<?php
if (!empty($_REQUEST['message'])) {
    $html = <<<HTML
        <div class="alert alert-danger" role="alert">
            <p>
                Por favor corrija el siguiente error para poder continuar:<br/><br/>
            </p>
            <p>
                {$_REQUEST['message']}
            </p>
        </div>
HTML;
} else {
    $html = <<<HTML
    <div class="progress-circle-indeterminate m-t-45" style=""></div>
HTML;
}

echo $html;

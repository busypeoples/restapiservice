<h1>Welcome</h1>

<?php
$data = $this->getParam('data');
foreach ($data['data'] as $data => $value) {
    print '<div>' . $data . ' :: ' . $value . '</div>';
}
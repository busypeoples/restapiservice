<?php

$data = $this->getParam('data');

echo '<?xml version="1.0" encoding="utf-8">';
echo "<data>
 <message>
 	{$data['message']}
 </message>
</data>";
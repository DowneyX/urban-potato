<?php

if ($params["message"] != null) {
    echo ('
<div class="my-5 mx-20 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
    <strong class="font-bold">MESSAGE: </strong>
    <span class="block sm:inline">  ' . $params["message"] . '</span>
</div>');
} ?>
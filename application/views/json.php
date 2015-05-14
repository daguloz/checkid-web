<?php

    $this->output->set_header('Content-type: application/json; charset=utf-8');
    if (isset($status))
        $this->output->set_status_header($status);
    echo json_encode($response);
<?php

function session_gan($data)
{
    $ini = get_instance();
    return $ini->session->userdata($data);
}

function get_gan($data)
{
    $ini = get_instance();
    return $ini->input->get($data);
}
function post_gan($data)
{
    $ini = get_instance();
    return $ini->input->post($data);
}
function post_true($data)
{
    $ini = get_instance();
    return $ini->input->post($data, true);
}
function segment_gan($segment)
{
    $ini = get_instance();
    return $ini->uri->segment($segment);
}

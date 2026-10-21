<?php

function convertTanggal($tanggal)
{
    $result = \Illuminate\Support\Carbon::parse($tanggal)->translatedFormat('d/m/Y');
    return $result;
}
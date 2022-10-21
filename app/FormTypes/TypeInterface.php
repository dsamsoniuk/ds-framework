<?php


namespace App\FormTypes;

interface TypeInterface {
    public function valid($value);
    public function parse($value);
    public function getType(): string;
    public function getMessage(): string;
    public function addParams() : array;
}
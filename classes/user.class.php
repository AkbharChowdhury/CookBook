<?php

readonly class User
{
    public function __construct(
        public string $firstname,
        public string $lastname,
        public string $email,
        public string $password,

    ) {}
}
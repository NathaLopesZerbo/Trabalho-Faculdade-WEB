<?php

function redirect(string $location): void
{
    header("Location: {$location}");
    exit;
}

function escape(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function setFlash(string $type, string $message): void
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];
}

function getFlash(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
}

function old(string $field, array $fallback = []): string
{
    return escape($_SESSION['old'][$field] ?? $fallback[$field] ?? '');
}

function storeOldInput(array $input): void
{
    $_SESSION['old'] = $input;
}

function clearOldInput(): void
{
    unset($_SESSION['old']);
}

function setFormErrors(array $errors): void
{
    $_SESSION['errors'] = $errors;
}

function getFormErrors(): array
{
    $errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['errors']);

    return is_array($errors) ? $errors : [];
}

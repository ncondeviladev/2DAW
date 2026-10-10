<?php
// Interfície ja feta, no cal tocar-la
interface Notificable {
    public function enviarNotificacio(string $missatge): string;
}
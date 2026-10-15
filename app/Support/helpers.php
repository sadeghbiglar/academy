<?php

use Morilog\Jalali\Jalalian;

if (! function_exists('jalali_date')) {
    function jalali_date($date, string $format = 'Y/m/d'): ?string
    {
        if (! $date) {
            return null;
        }

        return Jalalian::fromDateTime($date)->format($format);
    }
}

if (! function_exists('miladi_date')) {
    function miladi_date(?string $date, string $format = 'Y-m-d'): ?string
    {
        if (! $date) {
            return null;
        }

        return Jalalian::fromFormat('Y/m/d', $date)
            ->toCarbon()
            ->format($format);
    }
}

if (! function_exists('valid_jalali_date')) {
    function valid_jalali_date(?string $date): bool
    {
        if (! $date || ! preg_match('/^([0-9]{4})\/([0-9]{2})\/([0-9]{2})$/', $date, $matches)) {
            return false;
        }

        $year = (int) $matches[1];
        $month = (int) $matches[2];
        $day = (int) $matches[3];

        if ($month < 1 || $month > 12 || $day < 1) {
            return false;
        }

        try {
            $parsedDate = Jalalian::fromFormat(
                'Y/m/d',
                sprintf('%04d/%02d/01', $year, $month)
            );

            return $day <= $parsedDate->getMonthDays();
        } catch (\Throwable $exception) {
            return false;
        }
    }
}
<?php

namespace drmonkeyninja;

class Average
{
    /**
     * Validate input array
     * @param array $numbers
     */
    private function validate(array $numbers)
    {
        if (empty($numbers)) {
            throw new \InvalidArgumentException("Array tidak boleh kosong.");
        }

        foreach ($numbers as $n) {
            if (!is_numeric($n)) {
                throw new \InvalidArgumentException("Semua elemen array harus numerik.");
            }
        }
    }

    /**
     * Calculate the mean average
     */
    public function mean(array $numbers)
    {
        $this->validate($numbers);
        return array_sum($numbers) / count($numbers);
    }

    /**
     * Calculate the median value
     */
    public function median(array $numbers)
    {
        $this->validate($numbers);

        sort($numbers);
        $size = count($numbers);

        if ($size % 2) {
            return $numbers[$size / 2];
        } else {
            return $this->mean(array_slice($numbers, ($size / 2) - 1, 2));
        }
    }
}

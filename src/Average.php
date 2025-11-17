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

    
    public function mean(array $numbers)
    {
        $this->validate($numbers);
        return array_sum($numbers) / count($numbers);
    }

    
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

    /**
     * Sum of elements
     * @param array $numbers
     * @return float|int
     */
    public function sum(array $numbers)
    {
        $this->validate($numbers);
        return array_sum($numbers);
    }

    /**
     * Count elements
     * @param array $numbers
     * @return int
     */
    public function countElements(array $numbers): int
    {
        $this->validate($numbers);
        return count($numbers);
    }

    /**
     * Mode (most frequent value). If multiple modes exist, returns array of modes.
     * @param array $numbers
     * @return mixed|array
     */
    public function mode(array $numbers)
    {
        $this->validate($numbers);

        $freq = [];
        foreach ($numbers as $n) {
            $key = (string) $n;
            if (!isset($freq[$key])) {
                $freq[$key] = 0;
            }
            $freq[$key]++;
        }

        $max = max($freq);
        $modes = [];
        foreach ($freq as $val => $count) {
            if ($count === $max) {
                $modes[] = is_numeric($val) ? ($val + 0) : $val;
            }
        }

        return count($modes) === 1 ? $modes[0] : $modes;
    }

    /**
     * Minimum value
     */
    public function minValue(array $numbers)
    {
        $this->validate($numbers);
        return min($numbers);
    }

    /**
     * Maximum value
     */
    public function maxValue(array $numbers)
    {
        $this->validate($numbers);
        return max($numbers);
    }
}

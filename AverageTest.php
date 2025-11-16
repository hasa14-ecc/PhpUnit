<?php
require_once __DIR__ . '/../src/Average.php';

use drmonkeyninja\Average;
use PHPUnit\Framework\TestCase;

class AverageTest extends TestCase
{
    protected Average $Average;

    protected function setUp(): void
    {
        $this->Average = new Average();
    }

    /**
     * Test calculation of mean (benar, harus PASS)
     */
    public function testCalculationOfMean(): void
    {
        $numbers = [3, 7, 6, 1, 5];
        $this->assertEquals(4.4, $this->Average->mean($numbers));
    }

    /**
     * Test median (harus PASS)
     */
    public function testCalculationOfMedian(): void
    {
        $numbers = [3, 7, 6, 1, 5];
        $this->assertEquals(5, $this->Average->median($numbers));
    }

    // ----------------------------------------------------
    // Tambahan test cases valid (semua harus pass)
    // ----------------------------------------------------

    public function testMeanWithDecimalNumbers(): void
    {
        $numbers = [2.5, 3.5, 4.0];
        $this->assertEquals(3.33, round($this->Average->mean($numbers), 2));
    }

    public function testMedianWithEvenNumberOfElements(): void
    {
        $numbers = [4, 1, 3, 2];
        $this->assertEquals(2.5, $this->Average->median($numbers));
    }

    public function testMeanWithSingleElement(): void
    {
        $numbers = [10];
        $this->assertEquals(10, $this->Average->mean($numbers));
    }

    public function testMedianWithEmptyArray(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->Average->median([]);
    }

    public function testMeanWithNonNumericValues(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->Average->mean([1, "abc", 3]);
    }

    // ----------------------------------------------------
    // ❌ Test baru yang AKAN GAGAL (bukan disalahkan)
    // ----------------------------------------------------

    public function testMedianWithStringNumbers(): void
    {
        $numbers = ["1", "5", "3"];

        // Seharusnya developer ingin hasil 3
        // Tapi Average.php TIDAK memvalidasi string numeric
        // Hasilnya tidak terjamin → TEST AKAN GAGAL
        $this->assertEquals(3, $this->Average->median($numbers));
    }
}

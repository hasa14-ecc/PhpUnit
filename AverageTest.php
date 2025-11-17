<?php
require_once __DIR__ . '/../src/Average.php';

use drmonkeyninja\Average;
use PHPUnit\Framework\TestCase;

class AverageTest extends TestCase
{
    protected Average $average;

    protected function setUp(): void
    {
        $this->average = new Average();
    }

    // === TEST MEAN ===
    public function testCalculationOfMean(): void
    {
        $numbers = [3, 7, 6, 1, 5];
        $this->assertEquals(4.4, $this->average->mean($numbers));
    }

    public function testMeanWithDecimalNumbers(): void
    {
        $numbers = [2.5, 3.5, 4.0];
        $this->assertEqualsWithDelta(3.333, $this->average->mean($numbers), 0.001);
    }

    public function testMeanWithSingleElement(): void
    {
        $this->assertEquals(10, $this->average->mean([10]));
    }

    // === TEST MEDIAN ===
    public function testCalculationOfMedian(): void
    {
        $numbers = [3, 7, 6, 1, 5];
        $this->assertEquals(5, $this->average->median($numbers));
    }

    public function testMedianWithEvenNumberOfElements(): void
    {
        $numbers = [4, 1, 3, 2];
        $this->assertEquals(2.5, $this->average->median($numbers));
    }

    // === TEST SUM ===
    public function testSum(): void
    {
        $numbers = [1, 2, 3, 4, 5];
        $this->assertEquals(15, $this->average->sum($numbers));
    }

    public function testSumWithDecimals(): void
    {
        $numbers = [1.5, 2.5, 3.0];
        $this->assertEquals(7.0, $this->average->sum($numbers));
    }

    // === TEST COUNT ELEMENTS ===
    public function testCountElements(): void
    {
        $numbers = [10, 20, 30];
        $this->assertEquals(3, $this->average->countElements($numbers));
    }

    public function testCountElementsWithSingleItem(): void
    {
        $this->assertEquals(1, $this->average->countElements([42]));
    }

    // === TEST MODE ===
    public function testModeSingleMode(): void
    {
        $numbers = [1, 2, 2, 3, 4];
        $this->assertEquals(2, $this->average->mode($numbers));
    }

    public function testModeMultipleModes(): void
    {
        $numbers = [1, 1, 2, 2, 3];
        $this->assertEquals([1, 2], $this->average->mode($numbers));
        $this->assertIsArray($this->average->mode($numbers));
    }

    public function testModeWithDecimals(): void
    {
        $numbers = [1.5, 1.5, 2.0, 3.0];
        $this->assertEquals(1.5, $this->average->mode($numbers));
    }

    // === TEST MIN VALUE ===
    public function testMinValue(): void
    {
        $numbers = [5, 1, 9, 3];
        $this->assertEquals(1, $this->average->minValue($numbers));
    }

    public function testMinValueWithNegative(): void
    {
        $numbers = [-5, -1, 0, 3];
        $this->assertEquals(-5, $this->average->minValue($numbers));
    }

    // === TEST MAX VALUE ===
    public function testMaxValue(): void
    {
        $numbers = [5, 1, 9, 3];
        $this->assertEquals(9, $this->average->maxValue($numbers));
    }

    public function testMaxValueWithDecimals(): void
    {
        $numbers = [1.1, 2.2, 3.3, 2.9];
        $this->assertEquals(3.3, $this->average->maxValue($numbers));
    }

    // === TEST EXCEPTION: EMPTY ARRAY ===
    public function testEmptyArrayThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Array tidak boleh kosong.");
        $this->average->mean([]);
    }

    // === TEST EXCEPTION: NON-NUMERIC ===
    public function testNonNumericThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Semua elemen array harus numerik.");
        $this->average->sum([1, "abc", 3]);
    }
}

<?php

/**
 * Это интерфейс реализации
 */
interface IPrinter
{
	public function printHeader($textHeader);
	public function printBody($textBody);
}

class PdfPrinter implements IPrinter
{
	public function printHeader($textHeader) {
		echo 'This is your header (' . $textHeader. ') in the pdf file<br />';
	}

	public function printBody($textBody) {
		echo 'This is your text body (' . $textBody. ') in the pdf file<br />';
	}
}

class ExcelPrinter implements IPrinter
{
	public function printHeader($textHeader) {
		echo 'This is your header (' . $textHeader. ') in the xls file<br />';
	}

	public function printBody($textBody) {
		echo 'This is your text body (' . $textBody. ') in the xls file<br />';
	}
}

/**
 * Это интерфейс абстракции
 */
abstract class Report
{
	protected $printer;

	public function __construct(IPrinter $printer) {
		$this->printer = $printer;
	}

	public function printHeader($textHeader) {
		$this->printer->printHeader($textHeader);
	}

	public function printBody($textBody) {
		$this->printer->printBody($textBody);
	}
}

class WeeklyReport extends Report
{
	public function print(array $text) {
		$this->printHeader($text['header']);
		$this->printBody($text['body']);
	}
}

$report = new WeeklyReport(new ExcelPrinter());
// This is your header (my header for excel) in the xls file</ br>This is your text body (my body for excel) in the xls file<br />
$report->print(['header' => 'my header for excel', 'body' => 'my body for excel']);

$report = new WeeklyReport( new PdfPrinter());
// This is your header (my header for pdf) in the pdf file</ br>This is your text body (my body for pdf) in the pdf file<br />
$report->print(['header' => 'my header for pdf', 'body' => 'my body for pdf']);
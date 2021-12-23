<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class OverviewController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('subscriptionCheck');
	}
	
	public function overview() {
		$chart = Chart::multi('bar', 'material')
				// Setup the chart settings
				->title("My Cool Chart")
				// A dimension of 0 means it will take 100% of the space
				->dimensions(0, 400) // Width x Height
				// This defines a preset of colors already done:)
				->template("material")
				// You could always set them manually
				// ->colors(['#2196F3', '#F44336', '#FFC107'])
				// Setup the diferent datasets (this is a multi chart)
				->dataset('Invoices', [5,20,100])
				->dataset('Expenses', [15,30,80])
				// Setup what the values mean
				->labels(['One', 'Two', 'Three']);
		
		return view('finances.overview.overview', compact('chart'));
	}
}

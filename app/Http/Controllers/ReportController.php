<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ReportController extends Controller
{
    public function downloadReport()
    {
        $userId = Auth::user()->getAuthIdentifier();
        $orders = Order::query()->where("user_id",$userId)->get();

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();

        for($i=0,$j=1;$i<count($orders);$i++,$j++){
            $activeWorksheet->setCellValue('A'.$j, $orders[$i]->car->brand);
            $activeWorksheet->setCellValue('B'.$j, $orders[$i]->car->model);
            $activeWorksheet->setCellValue('C'.$j,$orders[$i]->price);
            $activeWorksheet->setCellValue('D'.$j,$orders[$i]->created_at);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('report.xlsx');
        return response()->download(public_path("report.xlsx"));
    }
}
